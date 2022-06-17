import {TestBed} from '@angular/core/testing';
import {TuiRootModule} from '@taiga-ui/core';
import {AppComponent} from './app.component';
import {RouterTestingModule} from "@angular/router/testing";

describe('AppComponent', () => {
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TuiRootModule, RouterTestingModule],
      declarations: [AppComponent],
    }).compileComponents();
  });

  it('should create the app', () => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.componentInstance;
    expect(app).toBeTruthy();
  });

  it('should render tui-root', () => {
    const fixture = TestBed.createComponent(AppComponent);
    fixture.detectChanges();
    const compiled = fixture.nativeElement as HTMLElement;
    const element = compiled.querySelector('tui-root');
    expect(!!element).toBeTruthy();
    expect(['onLight', 'onDark'].includes(element?.getAttribute('tuiMode') ?? "")).toBeTruthy()
  })

  it('should render router-outlet', () => {
    const fixture = TestBed.createComponent(AppComponent);
    fixture.detectChanges();
    const compiled = fixture.nativeElement as HTMLElement;
    expect(!!compiled.querySelector('router-outlet')).toBeTruthy();
  });
});
