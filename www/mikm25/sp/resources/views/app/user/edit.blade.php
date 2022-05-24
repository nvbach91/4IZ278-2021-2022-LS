@php

use App\Models\User;

/**
 * @var User $user
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.users.edit') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.users.edit') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            @include('app.user.form', ['user' => $user])
        </div>
    </div>
@endsection