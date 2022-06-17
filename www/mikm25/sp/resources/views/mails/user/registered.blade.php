@component('mail::message')
# {{ __('mails.common.greeting') }}

{{ __('mails.user.registered.line1', ['appName' => config('app.name')]) }}

@component('mail::button', ['url' => $verificationLink])
{{ __('mails.user.registered.action') }}
@endcomponent

{{ __('mails.common.ending') }}<br>
{{ config('app.name') }}
@endcomponent
