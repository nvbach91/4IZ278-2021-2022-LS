import {Injectable} from '@angular/core';
import {ActivatedRouteSnapshot, CanActivate, Router, RouterOutlet, RouterStateSnapshot} from '@angular/router';
import {Observable} from 'rxjs';
import {tap} from 'rxjs/operators';
import {AuthService} from "../_services";


@Injectable()
export class AuthGuard implements CanActivate {
  constructor(
    private _authService: AuthService,
    private _router: Router
  ) {
  }

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot,
  ): Observable<boolean> {
    return this._authService.canActivateProtectedRoutes$
      .pipe(tap(x => {
        if (!x) {
          this._router.navigateByUrl('/auth');
        }
        console.log('You tried to go to ' + state.url + ' and this guard said ' + x)
      }));
  }
}
