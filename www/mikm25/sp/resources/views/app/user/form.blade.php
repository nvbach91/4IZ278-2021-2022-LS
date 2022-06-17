@php

    use App\Models\User;

    /**
     * @var User $user
     */

@endphp

<form action="{{ route('app.users.update', ['user' => $user->id]) }}" method="post">
    @include('common.forms.errors')
    {{ csrf_field() }}
    @method('patch')

    <h2>{{ __('users.sections.general') }}</h2>
    <div class="row g-3 mb-3">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="user-firstname" class="form-label">
                {{ __('models.user.firstname') }}
                @include('common.forms.required')
            </label>
            <input type="text" id="user-firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}"
                   maxlength="255" autocomplete="off"
                   class="form-control @error('firstname') is-invalid @enderror" required>
            @include('common.forms.error', ['field' => 'firstname'])
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="user-lastname" class="form-label">
                {{ __('models.user.lastname') }}
                @include('common.forms.required')
            </label>
            <input type="text" id="user-lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                   maxlength="255" autocomplete="off"
                   class="form-control @error('lastname') is-invalid @enderror" required>
            @include('common.forms.error', ['field' => 'lastname'])
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="user-phone" class="form-label">
                {{ __('models.user.phone') }}
            </label>
            <input type="tel" id="user-phone" name="phone" value="{{ old('phone', $user->phone_number) }}"
                   maxlength="255" autocomplete="off"
                   class="form-control @error('phone') is-invalid @enderror">
            @include('common.forms.error', ['field' => 'phone'])
        </div>
        @if(! $user->is_from_github)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="user-email" class="form-label">
                    {{ __('models.user.email') }}
                </label>
                <input type="email" id="user-email" name="email" value="{{ old('email', $user->email) }}"
                       maxlength="255" autocomplete="off"
                       class="form-control @error('email') is-invalid @enderror">
                @include('common.forms.error', ['field' => 'email'])
            </div>
        @endif
    </div>

    @if(! $user->is_from_github)
        <h2>{{ __('users.sections.password') }}</h2>
        <div class="row g-3 mb-3">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="user-new-password" class="form-label">
                    {{ __('models.user.new_password') }}
                </label>
                <input type="password" id="user-new-password" name="new_password" value="{{ old('new_password') }}" autocomplete="off"
                       class="form-control @error('new_password') is-invalid @enderror">
                @include('common.forms.error', ['field' => 'new_password'])
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="user-new-password-confirmation" class="form-label">
                    {{ __('models.user.password_confirm') }}
                </label>
                <input type="password" id="user-new-password-confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}"
                       autocomplete="off"
                       class="form-control @error('new_password_confirmation') is-invalid @enderror">
                @include('common.forms.error', ['field' => 'new_password_confirmation'])
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between">
                <a href="{{ route('app.users.show', ['user' => $user->id]) }}" class="btn btn-light">
                    {{ __('common.buttons.detail') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ __('common.buttons.save') }}
                </button>
            </div>
        </div>
    </div>
</form>