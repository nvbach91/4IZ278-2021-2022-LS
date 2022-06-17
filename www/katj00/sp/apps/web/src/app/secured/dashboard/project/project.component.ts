import {Component} from '@angular/core';
import {RxState, selectSlice} from "@rx-angular/state";
import {
  FetchProjectGQL, FetchProjectQuery, GetStatsGQL, GetStatsQuery,
} from "@project-management/data-access";
import {ActivatedRoute, Router} from "@angular/router";
import {Apollo} from "apollo-angular";
import {map, Observable, pluck} from "rxjs";
import {CacheService} from "../../../_services";
import ProjectGrid from "../../../../projectGrid.json";
import {getDateRange, stringAccess} from "../../../_helpers";
import {DateTime} from "luxon";

interface ProjectState {
  projectInfo: FetchProjectQuery['projectInfo'],
  stats: GetStatsQuery,
  loading: boolean
}

interface IProjectGrid {
  title: string,
  order: number,
  cards: {
    title: string,
    value: string,
    typeValue?: string,
    link: string | null,
    date: string | null,
    dateView?: "range",
    dateFormat?: string,
    type: string
  }[]
}

@Component({
  selector: 'pm-project',
  templateUrl: './project.component.html',
  styleUrls: ['./project.component.scss'],
  providers: [RxState]
})
export class ProjectComponent {

  viewModel$: Observable<ProjectState> = this._state.select(
    selectSlice(['projectInfo', 'stats', 'loading']),
    map(({projectInfo, stats, loading}) => ({
      projectInfo,
      stats,
      loading
    }))
  );
  projectGrid: IProjectGrid[] = ProjectGrid;
  stringAccessor = stringAccess;

  constructor(private _apollo: Apollo,
              private _fetchProject: FetchProjectGQL,
              private _getStatsGQL: GetStatsGQL,
              private _state: RxState<ProjectState>,
              private _route: ActivatedRoute,
              private _router: Router,
              private _cacheService: CacheService) {
    _route.params.subscribe(params => {
      this.setupComponent(Object.values(params));
    });
  }

  private setupComponent(params: string[]) {
    this._state.set({loading: true});
    const cachedProject = this._cacheService.selectedProject(params.join('/'));
    if (!cachedProject) {
      this._state.set({});
      this._router.navigate(['/']);
      return;
    }
    const todayRef = DateTime.now();
    const today = getDateRange(todayRef, 'day');
    const week = getDateRange(todayRef, 'week');
    const month = getDateRange(todayRef, 'month');
    const year = getDateRange(todayRef, 'year');
    const yesterday = getDateRange(todayRef.minus({day: 1}), 'day');
    const lastWeek = getDateRange(todayRef.minus({week: 1}), 'week');
    const lastMonth = getDateRange(todayRef.minus({month: 1}), 'month');

    const initResponse$ = this._fetchProject.watch({
      today,
      week,
      month,
      year,
      yesterday,
      lastWeek,
      lastMonth,
      id: cachedProject.findProject.id
    }, {
      initialFetchPolicy: "cache-and-network",
      fetchPolicy: "cache-and-network"
    }).valueChanges;
    this._state.connect('loading', initResponse$.pipe(pluck('loading')));
    this._state.connect('projectInfo', initResponse$.pipe(pluck('data', 'projectInfo')));
    this._state.connect('stats', initResponse$.pipe(pluck('data'), map(({projectInfo, ...stats}) => stats)));
  }
}
