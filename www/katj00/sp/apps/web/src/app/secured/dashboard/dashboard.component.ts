import {ChangeDetectionStrategy, Component} from '@angular/core';
import {GetUserGQL, GetUserQuery, GetProjectTreeGQL, GetProjectTreeQuery} from "@project-management/data-access";
import {combineLatestWith, endWith, map, Observable, startWith} from "rxjs";
import {RxState} from "@rx-angular/state";
import '@project-management/ui';


interface DashboardState {
  isLoading: boolean;
  user: GetUserQuery['me'];
  projectTree: GetProjectTreeQuery['projectTree']
}


@Component({
  selector: 'pm-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss'],
  providers: [RxState],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class DashboardComponent {

  isLoading$ = this._state.select('isLoading');
  user$ = this._state.select('user');
  projectTree$ = this._state.select('projectTree');
  // loaded$ = this.user$.pipe(combineLatestWith([this.projectTree$]));


  constructor(private getUser: GetUserGQL, private projectTree: GetProjectTreeGQL, private _state: RxState<DashboardState>) {
    this._state.set({isLoading: true});
    const userResponse$ = this.getUser.watch().valueChanges.pipe(
      map(({data, loading}) => ({user: data.me, isLoading: loading})));
    const projecTreeRepsonse$ = this.projectTree.watch().valueChanges.pipe(
      map(({data, loading}) => ({projectTree: data.projectTree, isLoading: loading}))
    )
    this._state.connect(userResponse$);
    this._state.connect(projecTreeRepsonse$);
  }

}
