@php

use App\Models\Company;

/**
 * @var list<Company> $companies
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.companies.index') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.companies.index') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th class="text-nowrap">{{ __('models.id') }}</th>
                        <th class="text-nowrap">{{ __('models.company.name') }}</th>
                        <th class="text-nowrap">{{ __('models.company.size') }}</th>
                        <th class="text-nowrap">{{ __('models.company.url') }}</th>
                        <th class="text-nowrap">{{ __('models.company.contact_email') }}</th>
                        <th class="text-nowrap">{{ __('models.company.positions_count') }}</th>
                        <th class="text-nowrap">{{ __('tables.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td class="text-nowrap">{{ $company->id }}</td>
                            <td class="text-nowrap">{{ $company->name }}</td>
                            <td class="text-nowrap">{{ !empty($company->size) ? $company->size->getTranslatedSize() : '-' }}</td>
                            <td class="text-nowrap">
                                @if(!empty($company->url))
                                    <a href="{{ $company->url }}" target="_blank"
                                       title="{{ $company->url }}">
                                        {{ __('common.link') }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-nowrap">
                                @if(!empty($company->contact_email))
                                    <a href="mailto:{{ $company->contact_email }}" title="{{ $company->contact_email }}">
                                        {{ $company->contact_email }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-nowrap">{{ $company->positions_count }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('app.companies.show', ['company' => $company->id]) }}"
                                   class="btn btn-sm btn-primary">
                                    {{ __('common.buttons.detail') }}
                                </a>
                                <a href="{{ route('app.companies.edit', ['company' => $company->id]) }}"
                                   class="btn btn-sm btn-light ms-1">
                                    {{ __('common.buttons.edit') }}
                                </a>
                                <a href="#" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal"
                                   data-bs-target="#company-delete-modal" data-bs-form-action="{{ route('app.companies.delete', ['company' => $company->id]) }}">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                {{ __('companies.index.empty') }}
                                <a href="{{ route('app.companies.create') }}" class="btn btn-sm btn-primary">
                                    {{ __('companies.buttons.create') }}
                                </a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $companies->links() }}
    @include('app.company.modals.delete')
@endsection