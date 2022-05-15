import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AuthRoutingModule } from './auth-routing.module';
import { AuthComponent } from './auth.component';
import {TuiButtonModule} from "@taiga-ui/core";
import {FontAwesomeModule} from "@fortawesome/angular-fontawesome";
import {LetModule, PushModule} from "@rx-angular/template";


@NgModule({
  declarations: [
    AuthComponent
  ],
    imports: [
        CommonModule,
        AuthRoutingModule,
        TuiButtonModule,
        FontAwesomeModule,
        LetModule,
        PushModule
    ]
})
export class AuthModule { }
