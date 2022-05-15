import {ChangeDetectionStrategy, Component, Input, OnInit} from '@angular/core';
import {GetUserQuery, User} from "@project-management/data-access";
import {RxState} from "@rx-angular/state";
import {Observable} from "rxjs";

interface NavbarState {
  user: GetUserQuery['me'];
}


@Component({
  selector: 'pm-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss'],
  providers: [RxState],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class NavbarComponent {

  @Input()
  set user(user$: Observable<GetUserQuery['me']>) {
    this._state.connect('user', user$);
  }

  // user$: Observable<GetUserQuery['me']> = this._state.select("user");

  constructor(private _state: RxState<NavbarState>) {
  }


}
