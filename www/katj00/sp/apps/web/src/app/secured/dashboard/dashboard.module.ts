import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DashboardRoutingModule } from './dashboard-routing.module';
import { DashboardComponent } from './dashboard.component';
import { SidebarModule } from '../../_components/sidebar/sidebar.module';
import { NavbarModule } from '../../_components/navbar/navbar.module';
import { LetModule, PushModule } from '@rx-angular/template';
import { TuiLoaderModule } from '@taiga-ui/core';
import { ProjectComponent } from './project/project.component';
import { ActivityLogComponent } from './activity-log/activity-log.component';

@NgModule({
  declarations: [
    DashboardComponent,
    ProjectComponent,
    ActivityLogComponent
  ],
  imports: [
    CommonModule,
    DashboardRoutingModule,
    SidebarModule,
    NavbarModule,
    LetModule,
    TuiLoaderModule,
    PushModule,
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
})
export class DashboardModule {}
