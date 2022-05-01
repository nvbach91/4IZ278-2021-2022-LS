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
                <h2>{{ __('positions.detail.sections.general') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="name" class="form-label">
                            {{ __('models.position.name') }}
                            @include('common.forms.required')
                        </label>
                        <input type="text" id="name" name="name" class="form-control" maxlength="255" required>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="workplace-address" class="form-label">
                            {{ __('models.position.workplace_address') }}
                            @include('common.forms.required')
                        </label>
                        <input type="text" id="workplace-address" name="workplace_address" class="form-control" required>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="branch" class="form-label">
                            {{ __('models.position.branch') }}
                            @include('common.forms.required')
                        </label>
                        <select name="branch" id="branch" class="form-control" required>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->translated_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h2>{{ __('positions.detail.sections.validity') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="valid-from" class="form-label">
                            {{ __('models.position.valid_from') }}
                        </label>
                        <input type="date" id="valid-from" name="valid_from" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="valid-until" class="form-label">
                            {{ __('models.position.valid_until') }}
                        </label>
                        <input type="date" id="valid-until" name="valid_until" class="form-control">
                    </div>
                </div>

                <h2>{{ __('positions.detail.sections.salary') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="salary-from" class="form-label">
                            {{ __('models.position.salary_from') }}
                        </label>
                        <input type="number" id="salary-from" name="salary_from" class="form-control" step="1000">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="salary-to" class="form-label">
                            {{ __('models.position.salary_to') }}
                        </label>
                        <input type="number" id="salary-to" name="salary_to" class="form-control" step="1000">
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <h2>
                        {{ __('positions.detail.sections.company') }}
                    </h2>
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input" checked type="checkbox" role="switch" id="company-checkbox">
                        <label class="form-check-label" for="company-checkbox"></label>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-name" class="form-label">
                            {{ __('models.company.name') }}
                            @include('common.forms.required')
                        </label>
                        <input type="text" id="company-name" name="company[name]" class="form-control" required>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-size" class="form-label">
                            {{ __('models.company.size') }}
                        </label>
                        <input type="text" id="company-size" name="company[size]" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-url" class="form-label">
                            {{ __('models.company.url') }}
                        </label>
                        <input type="url" id="company-url" name="company[url]" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-address" class="form-label">
                            {{ __('models.company.address') }}
                        </label>
                        <input type="text" id="company-address" name="company[address]" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="company-contact-email" class="form-label">
                            {{ __('models.company.contact_email') }}
                        </label>
                        <input type="email" id="company-contact-email" name="company[contact_email]" class="form-control">
                    </div>
                </div>

                <h2>{{ __('positions.detail.sections.content') }}</h2>
                <div class="row g-3 mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="external-url" class="form-label">
                            {{ __('models.position.external_url') }}
                        </label>
                        <input type="url" id="external-url" name="external_url" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="min-practice-length" class="form-label">
                            {{ __('models.position.min_practice_length') }}
                        </label>
                        <input type="number" id="min-practice-length" name="min_practice_length" class="form-control" step="1">
                    </div>
                    <div class="col-12">
                        <label for="content" class="form-label">
                            {{ __('models.position.content') }}
                        </label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection