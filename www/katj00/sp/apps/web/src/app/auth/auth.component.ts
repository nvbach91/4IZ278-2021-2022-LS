import {ChangeDetectionStrategy, Component} from '@angular/core';
import {faGithub} from "@fortawesome/free-brands-svg-icons";
import {AuthService} from "../_services";
import {RxState} from "@rx-angular/state";
import {BehaviorSubject} from "rxjs";

@Component({
  selector: 'pm-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.scss'],
  providers: [RxState],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class AuthComponent {
  userName!: string;
  githubIcon = faGithub;
  loginInProgress$ = new BehaviorSubject(false);

  constructor(
    private _state: RxState<{ loginInProgress: boolean }>,
    private _auth: AuthService
  ) {
    this._state.connect('loginInProgress', this.loginInProgress$);
  }

  loginCode() {
    this.loginInProgress$.next(true);
    this._auth.login();
  }

  logout(): void {
    this._auth.logout();
  }
}
