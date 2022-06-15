import {
  AfterViewInit,
  ChangeDetectionStrategy,
  Component,
  ElementRef,
  Input,
  ViewChild,
  ViewEncapsulation
} from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {Observable} from "rxjs";
import {GetProjectTreeQuery} from "@project-management/data-access";
import {RxState} from "@rx-angular/state";
import {Title} from "@angular/platform-browser";

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
  private _mobile = false;

  @Input()
  set mobile(value: boolean | string) {
    this._mobile =
      value === 'true' || value.toString() === 'true' || value === '';
  }

  get mobile(): string {
    return this._mobile.toString();
  }

  @Input()
  set projectTree(projectTree: GetProjectTreeQuery['projectTree']) {
    this._state.set({projectTree: projectTree});
  }

  @ViewChild('activeRouteIcon', {static: true}) routeIcon!: ElementRef<HTMLElement>;

  projectTree$ = this._state.select('projectTree');


  constructor(private _titleService: Title, private _state: RxState<SidebarState>, private _route: ActivatedRoute, private _router: Router, private _root: ElementRef<HTMLElement>) {
  }

  ngAfterViewInit() {
    this._route.firstChild?.params.subscribe((params) => {
      this._titleService.setTitle(`PM | ${params['repoOwner']}/${params['repoName']}`);
      const ref: HTMLElement | null = this._root.nativeElement.querySelector(`li[data-name="${params['repoOwner']}/${params['repoName']}"`);
      const refParent: HTMLElement | null = this._root.nativeElement.querySelector(`ul`);
      if (!ref || !refParent) return;
      const child = ref.getBoundingClientRect();
      const parent = refParent.getBoundingClientRect();
      this.routeIcon.nativeElement.style.top = `${child.top - parent.top}px`;
    });
  }
}
