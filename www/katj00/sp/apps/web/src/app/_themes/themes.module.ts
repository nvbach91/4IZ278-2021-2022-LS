import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {DarkThemeComponent} from './dark/dark.component';
import {LightThemeComponent} from './light/light.component';

@NgModule({
  declarations: [LightThemeComponent, DarkThemeComponent],
  imports: [CommonModule],
  exports: [LightThemeComponent, DarkThemeComponent]
})
export class ThemesModule {}
