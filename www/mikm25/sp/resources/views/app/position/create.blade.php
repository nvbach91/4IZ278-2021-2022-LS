<?php

use App\Models\Branch;

/**
 * @var list<Branch> $branches
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
                @include('common.status')
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
                        <label for="tags" class="form-label">
                            {{ __('models.position.tags') }}
                        </label>
                        <select name="tags[]" id="tags" class="form-select @error('tags') is-invalid @enderror"
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

                <div class="d-flex align-items-center">
                    <h2>
                        {{ __('positions.detail.sections.company') }}
                    </h2>
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input" {{ old('with_company', false) ? 'checked' : '' }}
                               type="checkbox" role="switch" id="company-checkbox" name="with_company">
                        <label class="form-check-label" for="company-checkbox"></label>
                    </div>
                </div>
                <div class="row g-3 mb-3" id="company-section">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-name" class="form-label">
                            {{ __('models.company.name') }}
                            @include('common.forms.required')
                        </label>
                        <input type="hidden" name="company[id]" value="{{ old('company.id') }}" id="company-id">
                        <input type="text" id="company-name" name="company[name]" value="{{ old('company.name') }}"
                               maxlength="255"
                               class="form-control @error('company.name') is-invalid @enderror" required>
                        <small class="text-muted">
                            {{ __('positions.create.company_hint') }}
                        </small>
                        @include('common.forms.error', ['field' => 'company.name'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-size" class="form-label">
                            {{ __('models.company.size') }}
                        </label>
                        <select name="company[size]" id="company-size"
                                class="form-select @error('company.size') is-invalid @enderror">
                            <option value="" {{ empty(old('company.size')) ? 'selected' : '' }}>{{ __('companies.selects.size_empty') }}</option>
                            @foreach(\App\Models\Attributes\CompanySizeAttribute::getAllSizes() as $key => $size)
                                <option value="{{ $key }}" {{ old('company.size') === $key ? 'selected' : '' }}>{{ $size->getTranslatedSize() }}</option>
                            @endforeach
                        </select>
                        @include('common.forms.error', ['field' => 'company.size'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-url" class="form-label">
                            {{ __('models.company.url') }}
                        </label>
                        <input type="url" id="company-url" name="company[url]" value="{{ old('company.url') }}"
                               maxlength="255"
                               class="form-control @error('company.url') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'company.url'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-address" class="form-label">
                            {{ __('models.company.address') }}
                        </label>
                        <input type="text" id="company-address" name="company[address]"
                               maxlength="255"
                               value="{{ old('company.address') }}"
                               class="form-control @error('company.address') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'company.address'])
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-contact-email" class="form-label">
                            {{ __('models.company.contact_email') }}
                        </label>
                        <input type="email" id="company-contact-email" name="company[contact_email]"
                               maxlength="255"
                               value="{{ old('company.contact_email') }}"
                               class="form-control @error('company.contact_email') is-invalid @enderror">
                        @include('common.forms.error', ['field' => 'company.contact_email'])
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