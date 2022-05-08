@php

use App\Models\Branch;
use App\Models\Company;
use App\Models\Position;

/**
 * @var list<Branch> $branches
 * @var list<Company> $companies
 * @var Position $position
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.positions.edit', ['positionName' => $position->title_name]) }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.positions.edit') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            @include('app.position.form', [
                'position' => $position,
                'branches' => $branches,
                'companies' => $companies,
            ])
        </div>
    </div>
@endsection