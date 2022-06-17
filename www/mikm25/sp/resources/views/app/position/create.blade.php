@php

use App\Models\Branch;
use App\Models\Company;

/**
 * @var list<Branch> $branches
 * @var list<Company> $companies
 */

@endphp

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
            @include('app.position.form', [
                'branches' => $branches,
                'companies' => $companies
            ])
        </div>
    </div>
@endsection