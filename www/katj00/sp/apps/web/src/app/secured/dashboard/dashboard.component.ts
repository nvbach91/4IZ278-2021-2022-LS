import {ChangeDetectionStrategy, Component, OnDestroy} from '@angular/core';
import {
  GetUserGQL,
  GetUserQuery,
  GetProjectTreeGQL,
  GetProjectTreeQuery,
  StartWorkGQL,
  ContinueWorkGQL,
  PauseWorkGQL,
  EndWorkGQL,
  StartWorkMutation,
  PauseWorkMutation,
  ContinueWorkMutation,
  EndWorkMutation,
  Log,
  Activity,
  GetProjectInfoQuery,
  GetProjectInfoGQL,
  SynchronizeGQL,
} from "@project-management/data-access";
import {interval, map, Observable, of, pluck, switchMap, takeUntil, takeWhile, tap} from "rxjs";
import {RxState, selectSlice} from "@rx-angular/state";
import '@project-management/ui';
import {BreakpointObserver, Breakpoints, BreakpointState} from "@angular/cdk/layout";
import {ActivatedRoute, ChildActivationEnd, EventType, Router} from "@angular/router";
import {CacheService} from "../../_services";
import {RxEffects} from "@rx-angular/state/effects";
import {ApolloCache} from "@apollo/client";

interface DashboardState {
  user: GetUserQuery['me'];
  projectTree: GetProjectTreeQuery['projectTree'],
  responsive: BreakpointState,
  selectedProject: string,
  projectInfo: GetProjectInfoQuery['projectInfo'] | any;
}

@Component({
  selector: 'pm-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss'],
  providers: [RxState, RxEffects],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class DashboardComponent implements OnDestroy {
  private intervalEffectID: { id: string | undefined, subscription: number }[] = [];

  get sidebarVisible(): boolean {
    return this._sidebarVisible;
  }

  set sidebarVisible(value: boolean) {
    this._sidebarVisible = value;
  }

  get logVisible(): boolean {
    return this._logVisible;
  }

  set logVisible(value: boolean) {
    this._logVisible = value;
  }

  viewModel$: Observable<DashboardState> = this._state.select(
    selectSlice(['user', 'projectTree', 'projectInfo', 'responsive', 'selectedProject']),
    map(({user, projectTree, projectInfo, responsive, selectedProject}) => ({
      user,
      projectTree,
      projectInfo,
      responsive,
      selectedProject
    }))
  );

  inProgress$ = this._state.select(map(({projectInfo}) => this.checkKeys(projectInfo) > 0 ? projectInfo.status?.inProgress : false));
  private _logVisible = false;
  private _sidebarVisible = false;
  private intervalEffect$ = interval(1000).pipe(switchMap(() => this.inProgress$), takeWhile((value) => !!value));

  constructor(private _state: RxState<DashboardState>,
              private _effects: RxEffects,
              private _responsive: BreakpointObserver,
              private _route: ActivatedRoute,
              private _router: Router,
              private _cacheService: CacheService,
              private _getUserGQL: GetUserGQL,
              private _projectTreeGQL: GetProjectTreeGQL,
              private _startWorkGQL: StartWorkGQL,
              private _pauseWorkGQL: PauseWorkGQL,
              private _continueWorkGQL: ContinueWorkGQL,
              private _endWorkGQL: EndWorkGQL,
              private _getProjectGQL: GetProjectInfoGQL,
              private _synchronizeGQL: SynchronizeGQL
  ) {

    const userResponse$ = this._getUserGQL.watch().valueChanges.pipe(pluck('data', 'me'));
    const projectTreeResponse$ = this._projectTreeGQL.watch({}, {
      initialFetchPolicy: "cache-and-network",
      fetchPolicy: "cache-and-network",
      nextFetchPolicy: "cache-first"
    }).valueChanges.pipe(pluck('data'));
    this._state.connect('user', userResponse$);
    this._state.connect(projectTreeResponse$);
    this._state.connect('responsive', this._responsive.observe([Breakpoints.Small, Breakpoints.HandsetPortrait]));
    this._state.set({projectInfo: {}, selectedProject: "No project selected!"})
    this._router.events.subscribe((event) => {
      if (event instanceof ChildActivationEnd) {
        this.setupComponent();
      }
    });
  }


  ngOnDestroy() {
    if (!this.intervalEffectID) return;
    this.intervalEffectID.map((value) => this._effects.unregister(value.subscription));
  }

  startWork(id: string | undefined) {
    if (!id) return;
    return this._startWorkGQL.mutate({id}, {
      update: (proxy, {data}) => this.update(proxy, data?.startWork, id),
    }).subscribe();
  }

  pauseWork(id: string | undefined) {
    if (!id) return;
    return this._pauseWorkGQL.mutate({id}, {
      update: (proxy, {data}) => this.update(proxy, data?.pauseWork, id),
    }).subscribe();
  }

  continueWork(id: string | undefined) {
    if (!id) return;
    return this._continueWorkGQL.mutate({id}, {
      update: (proxy, {data}) => this.update(proxy, data?.continueWork, id),
    }).subscribe();
  }

  endWork(id: string | undefined) {
    if (!id) return;
    return this._endWorkGQL.mutate({id}, {
      update: (proxy, {data}) => this.update(proxy, data?.endWork, id),
    }).subscribe();
  }

  update(proxy: ApolloCache<any>,
         data: StartWorkMutation['startWork'] | PauseWorkMutation['pauseWork'] | ContinueWorkMutation['continueWork'] | EndWorkMutation['endWork'] | null | undefined,
         id: string
  ) {
    if (data) {
      const {work, ...used} = data;
      if (data.type === "START") {
        proxy.modify({
          id: proxy.identify({__typename: 'Log', id: work.project.id}),
          fields: {
            log(cachedStatus: Log[]) {
              return [{id: work.id, date: new Date(), activities: {used}}, ...cachedStatus];
            }
          }
        });
      } else {
        proxy.modify({
          id: proxy.identify({__typename: "ActivityLog", id: data.work.id}),
          fields: {
            activities(cachedStatus: Activity[]) {
              console.log({data, cachedStatus})
              return [used, ...cachedStatus];
            }
          }
        });
      }
      const inProgress = data.type === 'START' || data.type === 'CONTINUE';
      const intervalID = this.intervalEffectID.findIndex(({id}) => data.work.project.id === id)
      if (intervalID > -1 && !inProgress) {
        this._effects.unregister(this.intervalEffectID[intervalID].subscription);
        this.intervalEffectID = this.intervalEffectID.splice(intervalID, 1);
      }
      if (inProgress) {
        this.intervalEffectID.push({
          id: data.work.project.id,
          subscription: this._effects.register(this.intervalEffect$, () => this._cacheService.updateTimestamp(data.work.project.name))
        });
      }
      proxy.modify({
        id: proxy.identify({__typename: "ProjectInfo", name: data.work.project.name}),
        fields: {
          status(cachedStatus) {
            return {
              ...cachedStatus,
              timeSpent: data.type === 'END' ? 0 : cachedStatus.timeSpent,
              inProgress,
              lastAction: data.type
            }
          }
        }
      });

    }
  }

  synchronize() {
    this._synchronizeGQL.mutate().subscribe(() => location.reload());
  }

  logout() {
    localStorage.clear();
    location.reload();
  }

  checkKeys(projectInfo: any) {
    return Object.keys(projectInfo).length;
  }

  private setupComponent() {
    if (this._route.firstChild) {
      const refetchData$: Observable<Partial<DashboardState>> = this._route.firstChild.params.pipe(switchMap((params) => {
        const name = Object.values(params).join('/');
        this.intervalEffectID.push({
          id: this._state.get().projectInfo?.id,
          subscription: this._effects.register(this.intervalEffect$, () => this._cacheService.updateTimestamp(name))
        });
        return this._getProjectGQL.watch({name}, {
          initialFetchPolicy: "cache-and-network", fetchPolicy: "cache-and-network"
        }).valueChanges.pipe(pluck('data'), map(({projectInfo}) => ({
          selectedProject: name, projectInfo
        })));
      }));
      this._state.connect(refetchData$);
    }
  }
}
