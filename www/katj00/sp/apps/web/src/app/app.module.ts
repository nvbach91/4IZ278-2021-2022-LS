import {CUSTOM_ELEMENTS_SCHEMA, NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';

import {CoreModule} from "./core.module";
import {TuiDialogModule, TuiModeModule, TuiRootModule, TuiThemeNightModule} from "@taiga-ui/core";
import {FontAwesomeModule} from "@fortawesome/angular-fontawesome";
import {GraphQLModule} from './graphql.module';
import {HttpClientModule} from '@angular/common/http';
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {ThemesModule} from "./_themes/themes.module";

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    CoreModule.forRoot(),
    TuiRootModule,
    TuiThemeNightModule,
    TuiModeModule,
    FontAwesomeModule,
    GraphQLModule,
    HttpClientModule,
    ThemesModule,
    TuiDialogModule

  ],
  providers: [],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
  bootstrap: [AppComponent]
})
export class AppModule {
}
