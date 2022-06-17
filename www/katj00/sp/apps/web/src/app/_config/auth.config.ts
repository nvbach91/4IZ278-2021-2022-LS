import {AuthConfig} from 'angular-oauth2-oidc';

export const authConfig: AuthConfig = {
  issuer: 'https://github.com/',
  loginUrl: 'https://github.com/login/oauth/authorize',
  clientId: '1d8d4fcf6b7ee4524b7d',
  redirectUri: window.location.origin,
  tokenEndpoint: 'http://localhost:8080/api/oauth/token',
  responseType: 'code',
  scope: 'repo read:user user:email',
  requireHttps: false,
  useSilentRefresh: false,
  timeoutFactor: 0.25, // For faster testing
  sessionChecksEnabled: true,
  showDebugInformation: true, // Also requires enabling "Verbose" level in devtools
  fallbackAccessTokenExpirationTimeInSec: 31556926
}
