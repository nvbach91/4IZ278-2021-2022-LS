import {Component, ViewEncapsulation} from '@angular/core';
import {AbstractTuiThemeSwitcher} from "@taiga-ui/cdk";

@Component({
  selector: 'pm-dark-theme',
  template: ``,
  styleUrls: ['./dark.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class DarkThemeComponent extends AbstractTuiThemeSwitcher{
}
