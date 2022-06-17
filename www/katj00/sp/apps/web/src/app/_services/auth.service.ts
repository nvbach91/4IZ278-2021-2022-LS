import {Injectable} from '@angular/core';
import {ActivatedRoute, Router, RouterStateSnapshot, RoutesRecognized, UrlTree} from '@angular/router';
import {OAuthErrorEvent, OAuthService} from 'angular-oauth2-oidc';
import {BehaviorSubject, combineLatest, Observable, tap} from 'rxjs';
import {filter, map} from 'rxjs/operators';
import {authConfig} from "../_config";

@Injectable({providedIn: 'root'})
export class AuthService {


  private isAuthenticatedSubject$ = new BehaviorSubject<boolean>(false);
  public isAuthenticated$ = this.isAuthenticatedSubject$.asObservable();

  private isDoneLoadingSubject$ = new BehaviorSubject<boolean>(false);
  public isDoneLoading$ = this.isDoneLoadingSubject$.asObservable();

  /**
   * Publishes `true` if and only if (a) all the asynchronous initial
   * login calls have completed or errorred, and (b) the user ended up
   * being authenticated.
   *
   * In essence, it combines:
   *
   * - the latest known state of whether the user is authorized
   * - whether the ajax calls for initial log in have all been done
   */
  public canActivateProtectedRoutes$: Observable<boolean> = combineLatest([
    this.isAuthenticated$,
    this.isDoneLoading$
  ]).pipe(map(values => values.every(b => b)));

  private navigateToLoginPage() {
    // TODO: Remember current URL
    this.router.navigate(['/auth']);
  }

  private navigateUser(loggedIn: boolean) {
    if (loggedIn) {
      this.router.navigateByUrl('/');
    } else {
      this.navigateToLoginPage()
    }
  }

  constructor(
    private oauthService: OAuthService,
    private router: Router,
    private route: ActivatedRoute
  ) {
    // Useful for debugging:
    window.addEventListener('storage', (event) => {
      if ((event.key === 'auth_data_updated' && event.newValue !== null) || event.key === null) {
        console.log('Auth data has been updated in localStorage');
        this.isAuthenticatedSubject$.next(this.oauthService.hasValidAccessToken());
        this.navigateUser(this.oauthService.hasValidAccessToken());
      }
    });
    this.oauthService.events.subscribe(event => {
      if (event instanceof OAuthErrorEvent) {
        console.error('OAuthErrorEvent Object:', event);
      } else {
        console.warn('OAuthEvent Object:', event);
      }
    });

    this.oauthService.events
      .subscribe(_ => {
        this.isAuthenticatedSubject$.next(this.oauthService.hasValidAccessToken());
      });

    this.oauthService.events
      .pipe(filter(e => ['token_received'].includes(e.type)))
      .subscribe(e => {
        this.router.navigateByUrl('/')
      });

    // this.oauthService.events
    //   .pipe(filter(e => ['session_terminated', 'session_error'].includes(e.type)))
    //   .subscribe(e => this.navigateToLoginPage());
  }


  public runInitialLogin(): Promise<void> {
    if (location.hash) {
      console.log('Encountered hash fragment, plotting as table...');
      console.table(location.hash.substring(1).split('&').map(kvp => kvp.split('=')));
    }

    // 0. LOAD CONFIG:
    // First we have to check to see how the IdServer is
    // currently configured:
    return Promise.resolve(this.oauthService.configure(authConfig))

      // For demo purposes, we pretend the previous call was very slow
      // 1. HASH LOGIN:
      // Try to log in via hash fragment after redirect back
      // from IdServer from initImplicitFlow:
      .then(() => this.oauthService.tryLoginCodeFlow())
      .then(() => {
        if (this.oauthService.hasValidAccessToken()) {
          return Promise.resolve(true);
        } else {
          return Promise.resolve(false);
        }
      })

      .then(() => {
        this.isDoneLoadingSubject$.next(true);

        // Check for the strings 'undefined' and 'null' just to be sure. Our current
        // login(...) should never have this, but in case someone ever calls
        // initImplicitFlow(undefined | null) this could happen.
        // if (this.oauthService.state && this.oauthService.state !== 'undefined' && this.oauthService.state !== 'null') {
        //   let stateUrl = this.oauthService.state;
        //   if (stateUrl.startsWith('/') === false) {
        //     stateUrl = decodeURIComponent(stateUrl);
        //   }
        //   console.log(`There was state of ${this.oauthService.state}, so we are sending you to: ${stateUrl}`);
        //   this.router.navigateByUrl(stateUrl);
        // }
      })
      .catch(() => this.isDoneLoadingSubject$.next(true));
  }

  public login(targetUrl?: string) {
    sessionStorage.setItem('flow', 'code');
    this.oauthService.initCodeFlow(targetUrl || this.router.url);
  }

  public logout() {
    this.oauthService.logOut();
  }

  public hasValidToken() {
    return this.oauthService.hasValidAccessToken();
  }

  // These normally won't be exposed from a service like this, but
  // for debugging it makes sense.
  public get accessToken() {
    return this.oauthService.getAccessToken();
  }

  public get refreshToken() {
    return this.oauthService.getRefreshToken();
  }

  public get identityClaims() {
    return this.oauthService.getIdentityClaims();
  }

  public get idToken() {
    return this.oauthService.getIdToken();
  }

  public get logoutUrl() {
    return this.oauthService.logoutUrl;
  }
}
