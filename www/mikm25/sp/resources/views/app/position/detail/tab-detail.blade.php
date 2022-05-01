<?php

use App\Models\Position;

/**
 * @var Position $position
 */

?>

@extends('app.position.detail.template')

@section('position-content')
    <div class="row">
        <div class="col-lg-6 col-sm-12 mb-sm-2">
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <h2 class="mb-1 card-title">{{ __('positions.detail.sections.general') }}</h2>
                    <div>
                        <span>{{ __('models.id') }}: {{ $position->id }}</span>
                    </div>
                    <div>
                        <span>{{ __('models.position.branch') }}: {{ $position->branch->translated_name }}</span>
                    </div>
                    <div>
                        <span>{{ __('models.position.salary_from') }}: {{ $position->salary_from ?? '–' }}</span>
                    </div>
                    <div>
                        <span>{{ __('models.position.salary_to') }}: {{ $position->salary_to ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="card border-0 bg-light">
                <div class="card-body">
                    <h2 class="mb-1 card-title">{{ __('positions.detail.sections.company') }}</h2>
                    <div>
                        <span>{{ __('models.id') }}: {{ $position->id }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">

        </div>
    </div>
@endsection
