import {Component, OnInit} from '@angular/core';
import {RxState} from "@rx-angular/state";

interface CardState {
  date: string | null;
  title: string;
  value: string;
  size: 'small' | 'medium' | 'large'
}

@Component({
  selector: 'pm-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.scss'],
  providers: [RxState]
})
export class CardComponent {


  constructor(private _state: RxState<CardState>) {
  }
}
