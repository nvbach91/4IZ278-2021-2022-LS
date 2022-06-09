@php

use App\Models\Company;

/**
 * @var Company $company
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.companies.show', ['companyName' => $company->title_name]) }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.companies.show') }}
@endsection

@section('app-content')
    <div class="row mb-3">
        <div class="col">
            <h1 class="mb-0">{{ $company->name }}</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <ul class="nav nav-pills">
                <li class="nav-item ms-2">
                    <a class="nav-link"
                       href="{{ route('app.companies.edit', ['company' => $company->id]) }}">
                        <i class="bi bi-pen"></i>
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link text-danger"
                       data-bs-toggle="modal"
                       data-bs-target="#company-delete-modal"
                       data-bs-form-action="{{ route('app.companies.delete', ['company' => $company->id]) }}"
                       href="#">
                        <i class="bi bi-trash"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-lg-6 col-sm-12 mb-sm-2">
            <div class="card bg-light border-0">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td colspan="2"><b>{{ __('companies.sections.general') }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('models.id') }}</td>
                            <td>{{ $company->id }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.company.name') }}</td>
                            <td>
                                <a href="{{ route('app.companies.show', ['company' => $company->id]) }}">
                                    {{ $company->name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('models.company.size') }}</td>
                            <td>{{ !empty($company->size) ? $company->size->getTranslatedSize() : '-' }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.company.url') }}</td>
                            <td>
                                @if(!empty($company->url))
                                    <a href="{{ $company->url }}" target="_blank">{{ $company->url }}</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('models.company.address') }}</td>
                            <td>{{ $company->address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.company.contact_email') }}</td>
                            <td>
                                @if(!empty($company->contact_email))
                                    <a href="mailto:{{ $company->contact_email }}">{{ $company->contact_email }}</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>{{ __('companies.sections.statistics') }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('models.company.positions_count') }}</td>
                            <td>{{ $company->positions_count }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('app.company.modals.delete')
@endsection