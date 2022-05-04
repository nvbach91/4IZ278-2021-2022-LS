<?php

use App\Models\Company;

/**
 * @var list<Company> $companies
 */

?>

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
            <table class="table table-borderless table-responsive">
                <thead>
                <tr>
                    <th>{{ __('models.id') }}</th>
                    <th>{{ __('models.company.name') }}</th>
                    <th>{{ __('models.company.size') }}</th>
                    <th>{{ __('models.company.url') }}</th>
                    <th>{{ __('models.company.contact_email') }}</th>
                    <th>{{ __('models.company.positions_count') }}</th>
                    <th>{{ __('tables.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ !empty($company->size) ? $company->size->getTranslatedSize() : null }}</td>
                        <td>
                            @if(!empty($company->url))
                                <a href="{{ $company->url }}" target="_blank"
                                   title="{{ $company->url }}">
                                    {{ __('common.link') }}
                                </a>
                            @endif
                        </td>
                        <td>{{ $company->contact_email }}</td>
                        <td>{{ $company->positions_count }}</td>
                        <td>
                            <a href="{{ route('app.companies.show', ['company' => $company->id]) }}"
                               class="btn btn-sm btn-primary">
                                {{ __('common.buttons.detail') }}
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
    {{ $companies->links() }}
@endsection