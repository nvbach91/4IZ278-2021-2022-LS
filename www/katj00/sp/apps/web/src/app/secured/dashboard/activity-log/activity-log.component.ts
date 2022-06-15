import {Component} from '@angular/core';
import {GetActivityLogGQL, GetActivityLogQuery} from "@project-management/data-access";
import {map, Observable, pluck, Subject, switchMap} from "rxjs";
import {RxState, selectSlice} from "@rx-angular/state";
import {ActivatedRoute, Router} from '@angular/router';
import {CacheService} from "../../../_services";
import {tuiCreateDefaultDayRangePeriods} from "@taiga-ui/kit";
import {TuiDay, TuiDayRange} from "@taiga-ui/cdk";
import {DateTime} from "luxon";
import {TuiScrollbarComponent} from "@taiga-ui/core";

interface ActivityLogState {
  activityLog: GetActivityLogQuery['activityLog'],
  datePicker: TuiDayRange | null,
  displayPicker: boolean
}

@Component({
  selector: 'pm-activity-log',
  templateUrl: './activity-log.component.html',
  styleUrls: ['./activity-log.component.scss'],
  providers: [RxState]
})
export class ActivityLogComponent {
  items = tuiCreateDefaultDayRangePeriods();


  viewModel$: Observable<ActivityLogState> = this._state.select(
    selectSlice(['activityLog', 'datePicker', 'displayPicker']),
    map(({activityLog, datePicker, displayPicker}) => {
      if (datePicker) {
        const fromDate = DateTime.fromJSDate(datePicker.from.toUtcNativeDate()).startOf('day').toUTC().toMillis();
        const toDate = DateTime.fromJSDate(datePicker.to.toUtcNativeDate()).endOf('day').toUTC().toMillis();
        return {
          activityLog: {
            ...activityLog,
            log: activityLog.log.filter((work) => {
              const workDate = DateTime.fromJSDate(new Date(work?.date)).toUTC().toMillis();
              return fromDate <= workDate && workDate <= toDate
            })
          },
          datePicker,
          displayPicker
        }
      } else {
        return {activityLog, datePicker, displayPicker};
      }
    }));
  datePickerValue$ = new Subject<TuiDayRange | null>();
  constructor(private _route: ActivatedRoute,
              private _router: Router,
              private _state: RxState<ActivityLogState>,
              private _getActivityLog: GetActivityLogGQL,
              private _cacheService: CacheService) {
    this._state.connect('datePicker', this.datePickerValue$);
    if (this._route.firstChild) {
      const refetchData$ = this._route.firstChild.params.pipe(switchMap((params) => {
        const name = Object.values(params).join('/');
        const date = new Date();
        const tuiDate = new TuiDay(date.getFullYear(), date.getMonth(), date.getDate());
        this.datePickerValue$.next(new TuiDayRange(tuiDate, tuiDate));
        return this._getActivityLog.watch({name}, {
          initialFetchPolicy: "cache-and-network",
          fetchPolicy: "cache-and-network"
        }).valueChanges.pipe(pluck('data'), map(({activityLog}) => ({
          activityLog,
          displayPicker: false
        })));

      }));
      this._state.connect(refetchData$);
    }

  }

  displayPicker() {
    this._state.set('displayPicker', ({displayPicker}) => (!displayPicker))
  }

  hidePicker() {
    this._state.set({displayPicker: false});
  }

  deleteWork(id: string | undefined) {
    console.log(id);
  }

  filterLog($event: TuiDayRange | null, scrollbar: TuiScrollbarComponent) {
    this.datePickerValue$.next($event);
    scrollbar.browserScrollRef.nativeElement.scrollTop = 0;
  }
}
