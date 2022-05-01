@extends('templates.auth')

@section('title')
    {{ __('pages.auth.forgotten_password') }}
@endsection

@section('card')
    <div class="card">
        <div class="card-header">
            {{ __('pages.auth.forgotten_password') }}
        </div>
        <div class="card-body">
            <form action="{{ route('auth.forgotten-password.send') }}" method="post">
                @include('common.status')
                @include('common.forms.errors')
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="email" class="form-label">
                        {{ __('models.user.email') }}
                        @include('common.forms.required')
                    </label>
                    <input type="email" value="{{ old('email') }}" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" required autocomplete="email">
                    @include('common.forms.error', ['field' => 'email'])
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
                        {{ __('common.buttons.send') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
