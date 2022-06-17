@php

use App\Models\Company;

/**
 * @var Company $company
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.companies.edit', ['companyName' => $company->title_name]) }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.companies.edit') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            @include('app.company.form', ['company' => $company])
        </div>
    </div>
@endsection