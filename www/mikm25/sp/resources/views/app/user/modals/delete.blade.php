@php

use App\Models\User;

/**
 * @var User $user
 */

@endphp

<div class="modal fade {{ session()->get('show-delete-modal', false) ? 'show-on-load' : '' }}" id="user-delete-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('users.modals.delete.title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">{{ __('users.modals.delete.text') }}</p>

                <form action="#" method="post" id="user-delete-form" class="mt-3">
                    {{ csrf_field() }}
                    @method('delete')
                    @include('common.forms.errors', ['name' => 'user_delete'])
                    @if($user->is_from_github)
                        <label for="name" class="form-label">
                            {{ __('users.modals.delete.name') }}
                            @include('common.forms.required')
                        </label>
                        <input type="text" id="name" name="name" class="form-control @error('name', 'user_delete') is-invalid @enderror" required placeholder="{{ $user->full_name }}">
                        @include('common.forms.error', ['field' => 'name', 'name' => 'user_delete'])
                    @else
                        <label for="password" class="form-label">
                            {{ __('users.modals.delete.password') }}
                            @include('common.forms.required')
                        </label>
                        <input type="password" id="password" name="password" class="form-control @error('password', 'user_delete') is-invalid @enderror" required>
                        @include('common.forms.error', ['field' => 'password', 'name' => 'user_delete'])
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('common.buttons.close') }}</button>
                <button type="submit" form="user-delete-form"
                        class="btn btn-danger">{{ __('common.buttons.delete') }}</button>
            </div>
        </div>
    </div>
</div>