import {AfterViewInit, ChangeDetectionStrategy, Component, ElementRef, Input, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {Observable} from "rxjs";
import {GetProjectTreeQuery} from "@project-management/data-access";
import {RxState} from "@rx-angular/state";

interface SidebarState {
  projectTree: GetProjectTreeQuery['projectTree']
}

@Component({
  selector: 'pm-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss'],
  providers: [RxState],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class SidebarComponent implements AfterViewInit {
  @Input()
  set projectTree(projectTree$: Observable<GetProjectTreeQuery['projectTree']>) {
    this._state.connect('projectTree', projectTree$);
  }

  @ViewChild('activeRouteIcon', {static: true}) routeIcon!: ElementRef<HTMLElement>;

  projectTree$ = this._state.select('projectTree');


  constructor(private _state: RxState<SidebarState>, private _router: ActivatedRoute, private _root: ElementRef<HTMLElement>) {
  }

  ngAfterViewInit() {
    this._router.firstChild?.params.subscribe((params) => {
      const ref: HTMLElement | null = this._root.nativeElement.querySelector(`li[data-name="${params['repoOwner']}/${params['repoName']}"`);
      const refParent: HTMLElement | null = this._root.nativeElement.querySelector(`ul`);
      if (!ref || !refParent) return;
      const child = ref.getBoundingClientRect();
      const parent = refParent.getBoundingClientRect();
      this.routeIcon.nativeElement.style.top = `${child.top - parent.top}px`;
    });
  }
}
