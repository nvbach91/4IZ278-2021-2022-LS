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
                        <h5 class="card-title mb-4">{{ $dashboard->getTitle() }}</h5>
                        <span class="h2">{{ $dashboard->getCount() ?? '-' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection