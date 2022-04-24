@extends('auth.template')

@section('title')
    {{ __('pages.auth.register') }}
@endsection

@section('card')
    <div class="card">
        <div class="card-body">
            <h1 class="h5 card-title">{{ __('register.title') }}</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="firstname" class="form-label">{{ __('models.user.firstname') }}</label>
                    <input type="text" id="firstname" class="form-control" name="firstname" required autocomplete="given-name">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">{{ __('models.user.lastname') }}</label>
                    <input type="text" id="lastname" class="form-control" name="lastname" required autocomplete="family-name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('models.user.email') }}</label>
                    <input type="email" id="email" class="form-control" name="email" required autocomplete="email" value="{{ $emailPrefill }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('models.user.phone') }}</label>
                    <input type="tel" id="phone" class="form-control" name="phone" required autocomplete="tel">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('models.user.password') }}</label>
                    <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="password-confirmation" class="form-label">{{ __('models.user.password_confirm') }}</label>
                    <input type="password" id="password-confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('register.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
