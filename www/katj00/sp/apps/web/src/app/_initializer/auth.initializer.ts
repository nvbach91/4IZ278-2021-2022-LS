import {AuthService} from "../_services";

export function authAppInitializer(authService: AuthService): () => Promise<void> {
  return () => authService.runInitialLogin();
}
