import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DashboardRoutingModule } from './dashboard-routing.module';
import { DashboardComponent } from './dashboard.component';
import { SidebarModule } from '../../_components/sidebar/sidebar.module';
import { NavbarModule } from '../../_components/navbar/navbar.module';
import { LetModule, PushModule } from '@rx-angular/template';
import {
  TuiButtonModule, TuiDialogModule, TuiErrorModule, TuiHintControllerModule, TuiHintModule,
  TuiLoaderModule,
  TuiScrollbarModule, TuiTextfieldControllerModule,
} from '@taiga-ui/core';
import { ProjectComponent } from './project/project.component';
import { ActivityLogComponent } from './activity-log/activity-log.component';
import { ViewportPrioModule } from '@rx-angular/template/experimental/viewport-prio';
import { CardModule } from '../../_components/card/card.module';
import { LogRowComponent } from './activity-log/log-row/log-row.component';
import {TuiCalendarRangeModule, TuiFieldErrorPipeModule, TuiTextAreaModule} from "@taiga-ui/kit";
import {ForModule} from "@rx-angular/template/experimental/for";
import {ButtonModule} from "../../_components/button/button.module";
import {PipesModule} from "../../_pipes/pipes.module";
import {CommentDialogComponent} from "./comment-dialog/comment-dialog.component";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {TuiAutoFocusModule} from "@taiga-ui/cdk";

@NgModule({
  declarations: [
    DashboardComponent,
    ProjectComponent,
    ActivityLogComponent,
    LogRowComponent,
    CommentDialogComponent
  ],
  imports: [
    CommonModule,
    DashboardRoutingModule,
    SidebarModule,
    NavbarModule,
    LetModule,
    TuiLoaderModule,
    PushModule,
    TuiScrollbarModule,
    ViewportPrioModule,
    TuiButtonModule,
    CardModule,
    TuiCalendarRangeModule,
    ForModule,
    ButtonModule,
    PipesModule,
    TuiHintModule,
    TuiHintControllerModule,
    TuiTextAreaModule,
    FormsModule,
    TuiAutoFocusModule,
    TuiTextfieldControllerModule,
    TuiDialogModule,
    ReactiveFormsModule,
    TuiErrorModule,
    TuiFieldErrorPipeModule
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
})
export class DashboardModule {}
