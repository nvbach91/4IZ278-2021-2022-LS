import {ChangeDetectionStrategy, Component, HostBinding, Input} from '@angular/core';
import {RxState} from "@rx-angular/state";


@Component({
  selector: 'pm-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.scss'],
  providers: [RxState],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class CardComponent {
  @HostBinding('class') @Input() size!: string;
}

