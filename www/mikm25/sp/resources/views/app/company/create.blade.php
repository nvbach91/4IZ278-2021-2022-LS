@extends('templates.app')

@section('title')
    {{ __('pages.app.companies.create') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.companies.create') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            @include('app.company.form')
        </div>
    </div>
@endsection