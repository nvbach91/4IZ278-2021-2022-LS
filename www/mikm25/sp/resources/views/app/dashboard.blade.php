@extends('templates.app')

@section('title')
    {{ __('pages.app.dashboard') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.dashboard') }}
@endsection

@section('app-content')
    <div class="row">
        @foreach($dashboards as $dashboard)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
                <div class="card border-0 bg-light">
                    <div class="card-body">
                        <h5 class="card-title mb-2">{{ $dashboard->getTitle() }}</h5>
                        @if($dashboard instanceof \App\View\Models\Dashboards\Concerns\HasPreviousValue)
                            <div class="d-flex align-items-center">
                                <span class="h2 mb-0">{{ $dashboard->getCount() ?? '-' }}</span>
                                <span class="h5 ms-1 mb-0">
                                    @if($dashboard->getPreviousCount() > $dashboard->getCount())
                                        <i class="bi bi-arrow-down-right text-warning"></i>
                                    @elseif($dashboard->getPreviousCount() < $dashboard->getCount())
                                        <i class="bi bi-arrow-up-right text-success"></i>
                                    @endif
                                </span>
                            </div>
                            <small class="text-muted">{{ $dashboard->getPreviousText() }} <b>{{ $dashboard->getPreviousCount() }}</b></small>
                        @else
                            <span class="h2">{{ $dashboard->getCount() ?? '-' }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection