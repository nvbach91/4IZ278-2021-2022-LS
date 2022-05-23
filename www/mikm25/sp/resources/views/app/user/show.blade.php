@php

use App\Models\User;

/**
 * @var User $user
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.users.profile') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.users.profile') }}
@endsection

@section('app-content')
    <div class="row mb-3">
        <div class="col">
            <h1 class="mb-0">{{ $user->full_name }}</h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <ul class="nav nav-pills">
                {{--                <li class="nav-item ms-2">--}}
                {{--                    <a class="nav-link"--}}
                {{--                       href="{{ route('app.companies.edit', ['company' => $company->id]) }}">--}}
                {{--                        <i class="bi bi-pen"></i>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="nav-item ms-2">
                    <a class="nav-link text-danger"
                       data-bs-toggle="modal"
                       data-bs-target="#user-delete-modal"
                       href="#">
                        <i class="bi bi-trash"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @include('app.user.modals.delete', ['user' => $user])
@endsection