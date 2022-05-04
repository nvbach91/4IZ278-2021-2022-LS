<?php

use App\Models\Company;

/**
 * @var Company $company
 */

?>

@extends('templates.app')

@section('title')
    {{ __('pages.app.companies.show', ['companyName' => $company->title_name]) }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.companies.show') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            TODO DETAIL SPOLEČNOSTI
        </div>
    </div>
@endsection