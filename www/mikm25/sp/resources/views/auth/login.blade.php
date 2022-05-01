@extends('templates.auth')

@section('title')
    {{ __('pages.auth.login') }}
@endsection

@section('card')
    <div class="card">
        <div class="card-header">
            {{ __('pages.auth.login') }}
        </div>
        <div class="card-body">
            <form action="{{ route('auth.login.submit') }}" method="post">
                @include('common.status')
                @include('common.forms.errors')
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="email" class="form-label">
                        {{ __('models.user.email') }}
                        @include('common.forms.required')
                    </label>
                    <input type="email" value="{{ old('email', $emailHint) }}" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" required autocomplete="email">
                    <small class="text-muted">
                        {{ __('login.verification_link_help') }} <a href="{{ route('auth.email-verification.form') }}">{{ __('common.click_here') }}</a>
                    </small>
                    @include('common.forms.error', ['field' => 'email'])
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">
                        {{ __('models.user.password') }}
                        @include('common.forms.required')
                    </label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required
                           autocomplete="current-password">
                    @include('common.forms.error', ['field' => 'password'])
                </div>

                <div class="d-flex mb-3 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember_me" value="0" id="remember-me">
                        <label class="form-check-label" for="remember-me">
                            {{ __('login.remember_me') }}
                        </label>
                    </div>

                    <a href="{{ route('auth.forgotten-password.form') }}">{{ __('login.forgotten_password') }}</a>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('landing-page') }}" class="btn btn-light">
                            <i class="bi bi-house"></i>
                        </a>
                        <a href="{{ route('auth.register') }}" class="btn btn-light">
                            {{ __('pages.auth.register') }}
                        </a>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('login.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
