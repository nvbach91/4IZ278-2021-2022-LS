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
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3 mb-lg-0">
                @include('app.common.dashboard', ['dashboard' => $dashboard])
            </div>
        @endforeach
    </div>
@endsection