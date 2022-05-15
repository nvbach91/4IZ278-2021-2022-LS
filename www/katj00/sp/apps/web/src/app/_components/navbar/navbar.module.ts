import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {NavbarComponent} from './navbar.component';
import {TuiButtonModule} from "@taiga-ui/core";
import {TuiAvatarModule} from "@taiga-ui/kit";
import {LetModule, PushModule} from "@rx-angular/template";


@NgModule({
  declarations: [
    NavbarComponent
  ],
  exports: [
    NavbarComponent
  ],
  imports: [
    CommonModule,
    TuiButtonModule,
    TuiAvatarModule,
    LetModule,
    PushModule
  ]
})
export class NavbarModule {
}
