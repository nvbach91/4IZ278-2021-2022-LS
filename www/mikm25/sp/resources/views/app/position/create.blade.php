@extends('templates.app')

@section('title')
    {{ __('pages.app.positions.create') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.positions.create') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            TODO vytvoření pozice
        </div>
    </div>
@endsection