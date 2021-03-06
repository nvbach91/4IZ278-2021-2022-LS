@extends('templates.auth')

@section('title')
    {{ __('pages.auth.register') }}
@endsection

@section('card')
    <div class="card">
        <div class="card-header">
            {{ __('pages.auth.register') }}
        </div>
        <div class="card-body">
            <form action="{{ route('auth.register.submit') }}" method="post">
                @include('common.status')
                @include('common.forms.errors')
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="firstname" class="form-label">
                        {{ __('models.user.firstname') }}
                        @include('common.forms.required')
                    </label>
                    <input type="text" value="{{ old('firstname') }}" id="firstname"
                           class="form-control @error('firstname') is-invalid @enderror"
                           name="firstname" required
                           maxlength="255"
                           autocomplete="given-name">
                    @include('common.forms.error', ['field' => 'firstname'])
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">
                        {{ __('models.user.lastname') }}
                        @include('common.forms.required')
                    </label>
                    <input type="text" value="{{ old('lastname') }}" id="lastname"
                           class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                           required
                           maxlength="255"
                           autocomplete="family-name">
                    @include('common.forms.error', ['field' => 'lastname'])
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">
                        {{ __('models.user.email') }}
                        @include('common.forms.required')
                    </label>
                    <input type="email" value="{{ old('email', $emailHint) }}" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           maxlength="255"
                           name="email" required autocomplete="email">
                    @include('common.forms.error', ['field' => 'email'])
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        {{ __('models.user.phone') }}
                    </label>
                    <input type="tel" value="{{ old('phone') }}" id="phone"
                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                           maxlength="255"
                           autocomplete="tel">
                    @include('common.forms.error', ['field' => 'phone'])
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">
                        {{ __('models.user.password') }}
                        @include('common.forms.required')
                    </label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required
                           autocomplete="new-password">
                    <small class="text-muted">
                        {{ __('register.password_hint', ['min' => 9]) }}
                    </small>
                    @include('common.forms.error', ['field' => 'password'])
                </div>
                <div class="mb-3">
                    <label for="password-confirmation"
                           class="form-label">
                        {{ __('models.user.password_confirm') }}
                        @include('common.forms.required')
                    </label>
                    <input type="password" id="password-confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation"
                           required autocomplete="new-password">
                    @include('common.forms.error', ['field' => 'password_confirmation'])
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('landing-page') }}" class="btn btn-light">
                            <i class="bi bi-house"></i>
                        </a>
                        <a href="{{ route('auth.login') }}" class="btn btn-light">
                            {{ __('pages.auth.login') }}
                        </a>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('register.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
