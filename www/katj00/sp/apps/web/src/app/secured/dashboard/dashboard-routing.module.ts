import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {DashboardComponent} from "./dashboard.component";
import {ProjectComponent} from './project/project.component';

const routes: Routes = [
  {
    path: '', component: DashboardComponent, children: [
      {path: ':repoOwner/:repoName', component: ProjectComponent}
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DashboardRoutingModule {
}
