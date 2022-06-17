import {ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot} from "@angular/router";
import {AuthService} from "../_services";
import {map, Observable, tap} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class LoggedInGuard implements CanActivate {
  constructor(
    private authService: AuthService,
    private router: Router
  ) {
  }

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean> {
    return this.authService.isAuthenticated$.pipe(map((result) => !result), tap(result => {
      if (!result) {
        this.router.navigate(['/'])
      }
    })
  )
    ;
  }
}


