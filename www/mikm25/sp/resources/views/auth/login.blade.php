@extends('auth.template')

@section('title')
    {{ __('pages.auth.login') }}
@endsection

@section('card')
    <div class="card">
        <div class="card-body">
            <h1 class="h5 card-title">{{ __('pages.auth.login') }}</h1>
            <form action="{{ route('auth.login.submit') }}" method="post">
                @include('common.status')
                @include('common.forms.errors')
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('models.user.email') }}</label>
                    <input type="email" value="{{ old('email', $emailHint) }}" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" required autocomplete="email">
                    @include('common.forms.error', ['field' => 'email'])
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('models.user.password') }}</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required
                           autocomplete="current-password">
                    @include('common.forms.error', ['field' => 'password'])
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('auth.register') }}" class="btn btn-secondary">
                        {{ __('pages.auth.register') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('login.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
