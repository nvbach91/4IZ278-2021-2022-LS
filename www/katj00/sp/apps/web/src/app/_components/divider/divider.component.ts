import {Component, OnInit, ViewEncapsulation} from '@angular/core';

@Component({
  selector: 'pm-divider',
  template: `<span class="pm-divider">·</span>`,
  styleUrls: ['./divider.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class DividerComponent {
}
