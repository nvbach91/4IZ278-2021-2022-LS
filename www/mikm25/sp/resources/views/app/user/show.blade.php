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
                <li class="nav-item ms-2">
                    <a class="nav-link"
                       href="{{ route('app.users.edit', ['user' => $user->id]) }}">
                        <i class="bi bi-pen"></i>
                    </a>
                </li>
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
    <div class="row mb-2">
        <div class="col-lg-6 col-sm-12 mb-sm-2">
            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>{{ __('models.id') }}</td>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <td>{{ __('models.user.firstname') }}</td>
                    <td>
                        {{ $user->firstname }}
                    </td>
                </tr>
                <tr>
                    <td>{{ __('models.user.lastname') }}</td>
                    <td>
                        {{ $user->lastname }}
                    </td>
                </tr>
                <tr>
                    <td>{{ __('models.user.email') }}</td>
                    <td>
                        @if($user->is_email_verified)
                            {{ $user->email }}
                        @else
                            <span class="text-muted">{{ $user->email }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('models.user.email_verified_at') }}</td>
                    <td>
                        @if($user->is_email_verified)
                            {{ $user->email_verified_at->format('j. n. Y H:i:s') }}
                        @else
                            <button type="submit" class="btn btn-primary btn-sm" form="resend-verification-link-form">
                                {{ __('users.buttons.resend_verification_link') }}
                            </button>
                            <form class="d-none" action="{{ route('app.users.resend-verification-link', ['user' => $user->id]) }}"
                                  method="post" id="resend-verification-link-form">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('models.user.phone') }}</td>
                    <td>
                        {{ $user->phone_number ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td>{{ __('models.user.github') }} <i class="bi bi-github"></i></td>
                    <td>
                        {{ $user->github ? __('common.yes') : __('common.no') }}
                    </td>
                </tr>
                <tr>
                    <td>{{ __('models.user.last_logged_at') }}</td>
                    <td>
                        {{ $user->last_logged_at->format('j. n. Y H:i:s') }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('app.user.modals.delete', ['user' => $user])
@endsection