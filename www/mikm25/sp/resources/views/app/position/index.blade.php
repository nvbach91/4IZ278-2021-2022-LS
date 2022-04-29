@extends('templates.app')

@section('title')
    {{ __('pages.app.positions') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.positions') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            TODO seznam pozic
        </div>
    </div>
@endsection