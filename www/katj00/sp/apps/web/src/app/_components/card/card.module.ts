import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CardComponent } from './card.component';
import {LetModule} from "@rx-angular/template";

@NgModule({
  declarations: [CardComponent],
    imports: [CommonModule, LetModule],
  exports: [CardComponent]
})
export class CardModule {}
