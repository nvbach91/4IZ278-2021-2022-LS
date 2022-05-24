@php

use App\Models\User;

/** @var User $user */
$user = auth('web')->user();

@endphp

@if(empty($user->email_verified_at))
    <div class="alert alert-warning">
        {{ __('common.unverified') }}
    </div>
@endif