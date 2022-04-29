@extends('templates.app')

@section('title')
    {{ __('pages.app.dashboard') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.dashboard') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
            <div class="card border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title mb-4">Nové pozice tento měsíc</h5>
                    <span class="h2">1302</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
            <div class="card border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title mb-4">Počet kliknutí tento měsíc</h5>
                    <span class="h2">345</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
            <div class="card border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title mb-4">Počet reakcí tento měsíc</h5>
                    <span class="h2">12</span>
                </div>
            </div>
        </div>
    </div>
@endsection