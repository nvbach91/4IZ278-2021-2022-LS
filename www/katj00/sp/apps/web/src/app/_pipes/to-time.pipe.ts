import {Pipe, PipeTransform} from '@angular/core';

@Pipe({
  name: 'toTime'
})
export class ToTimePipe implements PipeTransform {

  transform(value: number, type?: 'digital'): string {
    const timestamp = value / 1000;
    const hours = Math.floor(timestamp / 3600);
    const minutes = Math.floor((timestamp % 3600) / 60);
    const seconds = Math.floor((timestamp%3600)%60);
    if(type === 'digital') {
      return `${this.addZero(hours)}:${this.addZero(minutes)}:${this.addZero(seconds)}`;
    }
    return `${hours}h ${minutes}min`
  }

  addZero(value: number) {
    return value.toString().length > 1 ? value : `0${value}`
  }

}
