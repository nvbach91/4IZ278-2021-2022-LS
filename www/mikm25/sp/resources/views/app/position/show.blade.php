@php

use App\Models\Position;
use App\Enums\PositionTabEnum;

/**
 * @var Position $position
 * @var PositionTabEnum $activeTab
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.positions.show', ['positionName' => $position->title_name]) }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.positions.show') }}
@endsection

@section('app-content')
    <div class="row mb-3">
        <div class="col">
            <h1 class="mb-0">{{ $position->name }}</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ $activeTab->isEqual(\App\Enums\PositionTabEnum::detail()) ? 'active' : '' }}"
                       href="{{ route('app.positions.show', ['position' => $position->id, 'tab' => \App\Enums\PositionTabEnum::detail()->getValue()]) }}">
                        {{ __('positions.detail.tabs.detail') }}
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link {{ $activeTab->isEqual(\App\Enums\PositionTabEnum::statistics()) ? 'active' : '' }}"
                       href="{{ route('app.positions.show', ['position' => $position->id, 'tab' => \App\Enums\PositionTabEnum::statistics()->getValue()]) }}">
                        {{ __('positions.detail.tabs.statistics') }}
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link {{ $activeTab->isEqual(\App\Enums\PositionTabEnum::applications()) ? 'active' : '' }}"
                       href="{{ route('app.positions.show', ['position' => $position->id, 'tab' => \App\Enums\PositionTabEnum::applications()->getValue()]) }}">
                        {{ __('positions.detail.tabs.applications') }}
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link"
                       href="{{ route('app.positions.edit', ['position' => $position->id]) }}">
                        <i class="bi bi-pen"></i>
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link text-danger"
                       data-bs-toggle="modal"
                       data-bs-target="#position-delete-modal"
                       data-bs-form-action="{{ route('app.positions.delete', ['position' => $position->id]) }}"
                       href="#">
                        <i class="bi bi-trash"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @yield('position-content')
    @include('app.position.modals.delete')
@endsection