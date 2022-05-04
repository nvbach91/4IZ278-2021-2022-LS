<?php

use App\Models\Branch;
use App\Models\Company;

/**
 * @var list<Branch> $branches
 * @var list<Company> $companies
 */

?>

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
            <form action="{{ route('app.positions.store') }}" method="post">
                @include('common.forms.errors')
                {{ csrf_field() }}

                <h2>{{ __('positions.detail.sections.general') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="name" class="form-label">
                            {{ __('models.position.name') }}
                            @include('common.forms.required')
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror" maxlength="255" required>
                        @include('common.forms.error', ['field' => 'name'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="workplace-address" class="form-label">
                            {{ __('models.position.workplace_address') }}
                            @include('common.forms.required')
                        </label>
                        <input type="text" id="workplace-address" name="workplace_address"
                               value="{{ old('workplace_address') }}"
                               maxlength="255"
                               class="form-control @error('workplace_address') is-invalid @enderror" required>
                        @include('common.forms.error', ['field' => 'workplace_address'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="branch" class="form-label">
                            {{ __('models.position.branch') }}
                            @include('common.forms.required')
                        </label>
                        <select name="branch" id="branch" class="form-select @error('branch') is-invalid @enderror"
                                required>
                            <option value="" {{ empty(old('branch')) ? 'selected' : '' }}>{{ __('positions.selects.branch_empty') }}</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch') == $branch->id ? 'selected' : '' }}>{{ $branch->translated_name }}</option>
                            @endforeach
                        </select>
                        @include('common.forms.error', ['field' => 'branch'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="position-tags" class="form-label">
                            {{ __('models.position.tags') }}
                        </label>
                        <select name="tags[]" id="position-tags" class="form-select @error('tags') is-invalid @enderror"
                                data-max="5" data-selected="{{ implode(',', old('tags', [])) }}" data-allow-new="true"
                                data-allow-clear="true" multiple>
                            @foreach(old('tags', []) as $tag)
                                <option value="{{ $tag }}">{{ $tag }}</option>
                            @endforeach
                        </select>
                        @include('common.forms.error', ['field' => 'tags'])
                    </div>
                </div>

                <h2>{{ __('positions.detail.sections.validity') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="valid-from" class="form-label">
                            {{ __('models.position.valid_from') }}
                        </label>
                        <input type="date" id="valid-from" name="valid_from" value="{{ old('valid_from') }}"
                               class="form-control @error('valid_from') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'valid_from'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="valid-until" class="form-label">
                            {{ __('models.position.valid_until') }}
                        </label>
                        <input type="date" id="valid-until" name="valid_until" value="{{ old('valid_until') }}"
                               class="form-control @error('valid_to') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'valid_until'])
                    </div>
                </div>

                <h2>{{ __('positions.detail.sections.salary') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="salary-from" class="form-label">
                            {{ __('models.position.salary_from') }}
                        </label>
                        <input type="number" id="salary-from" name="salary_from" value="{{ old('salary_from') }}"
                               class="form-control @error('salary_from') is-invalid @enderror" step="1000" min="0">
                        @include('common.forms.error', ['field' => 'salary_from'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="salary-to" class="form-label">
                            {{ __('models.position.salary_to') }}
                        </label>
                        <input type="number" id="salary-to" name="salary_to" value="{{ old('salary_to') }}"
                               class="form-control @error('salary_to') is-invalid @enderror" step="1000" min="0">
                        @include('common.forms.error', ['field' => 'salary_to'])
                    </div>
                </div>

                <h2>{{ __('positions.detail.sections.company') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company" class="form-label">
                            {{ __('models.position.company') }}
                        </label>
                        <select name="company" id="company" class="form-select @error('company') is-invalid @enderror">
                            <option value="" {{ empty(old('company')) ? 'selected' : '' }}>{{ __('positions.selects.company_empty') }}</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected' : '' }}>{{ $company->select_name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">
                            {{ __('positions.create.company_hint') }}
                            <a href="{{ route('app.companies.create') }}">
                                {{ __('common.buttons.create') }}
                            </a>
                        </small>
                        @include('common.forms.error', ['field' => 'company'])
                    </div>
                </div>

                <h2>{{ __('positions.detail.sections.content') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="external-url" class="form-label">
                            {{ __('models.position.external_url') }}
                        </label>
                        <input type="url" id="external-url" name="external_url" value="{{ old('external_url') }}"
                               maxlength="255"
                               class="form-control @error('external_url') is-invalid @enderror">
                        <small class="text-muted">
                            {{ __('positions.create.external_url_hint') }}
                        </small>
                        @include('common.forms.error', ['field' => 'external_url'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="min-practice-length" class="form-label">
                            {{ __('models.position.min_practice_length') }}
                        </label>
                        <input type="number" id="min-practice-length" name="min_practice_length"
                               value="{{ old('min_practice_length') }}"
                               class="form-control @error('min_practice_length') is-invalid @enderror" step="1" min="0">
                        @include('common.forms.error', ['field' => 'min_practice_length'])
                    </div>
                    <div class="col-12">
                        <label for="content" class="form-label">
                            {{ __('models.position.content') }}
                            @include('common.forms.required')
                        </label>
                        <textarea name="content" id="content"
                                  class="@error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                        @include('common.forms.error', ['field' => 'content'])
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('common.buttons.create') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @include('common.forms.tinymce', ['id' => 'content'])
@endpush