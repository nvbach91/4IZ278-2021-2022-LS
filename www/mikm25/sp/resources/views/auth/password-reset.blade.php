@extends('templates.auth')

@section('title')
    {{ __('pages.auth.password_reset') }}
@endsection

@section('card')
    <div class="card">
        <div class="card-header">
            {{ __('pages.auth.password_reset') }}
        </div>
        <div class="card-body">
            <form action="{{ route('auth.password-reset.reset', ['token' => $token]) }}" method="post">
                @include('common.status')
                @include('common.forms.errors')
                {{ csrf_field() }}

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
                    <a href="{{ route('auth.login') }}" class="btn btn-secondary">
                        {{ __('pages.auth.login') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('common.buttons.change') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
