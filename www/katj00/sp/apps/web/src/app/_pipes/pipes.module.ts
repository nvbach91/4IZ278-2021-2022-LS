import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {ToTimePipe} from "./to-time.pipe";



@NgModule({
  declarations: [ToTimePipe],
  imports: [
    CommonModule
  ],
  exports: [ToTimePipe]
})
export class PipesModule { }
