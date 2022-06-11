@php

use App\Models\PositionApplication;
use App\Models\Position;

/**
 * @var PositionApplication $application
 * @var Position $positon
 */

@endphp

@component('mail::message')
# {{ __('mails.common.greeting') }}

{{ __('mails.position.new_application.line1', ['positionName' => $position->name]) }}

@component('mail::panel')
**{{ __('models.position_application.name') }}**:
<br>
{{ $application->name }}
<br>
<br>
**{{ __('models.position_application.email') }}**:
<br>
{{ $application->email }}
<br>
<br>
@isset($application->phone)
**{{ __('models.position_application.phone') }}**:
<br>
{{ $application->phone }}
<br>
<br>
@endisset
**{{ __('models.position_application.message') }}**:
<br>
{{ __('mails.position.new_application.message') }}
@endcomponent

@component('mail::button', ['url' => $action])
    {{ __('mails.position.new_application.action') }}
@endcomponent

{{ __('mails.common.ending') }}<br>
{{ config('app.name') }}
@endcomponent