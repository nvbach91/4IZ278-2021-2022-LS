import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SidebarComponent } from './sidebar.component';
import {RouterModule} from "@angular/router";
import {ForModule} from "@rx-angular/template/experimental/for";
import {TuiScrollbarModule} from "@taiga-ui/core";
import {ScrollingModule} from "@angular/cdk/scrolling";
import {LetModule} from "@rx-angular/template";



@NgModule({
    declarations: [
        SidebarComponent
    ],
    exports: [
        SidebarComponent
    ],
  imports: [
    CommonModule,
    RouterModule,
    ForModule,
    TuiScrollbarModule,
    ScrollingModule,
    LetModule
  ]
})
export class SidebarModule { }
