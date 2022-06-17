@component('mail::message')
# {{ __('mails.common.greeting') }}

{{ __('mails.user.email_verification.line1') }}

@component('mail::button', ['url' => $verificationLink])
{{ __('mails.user.email_verification.action') }}
@endcomponent

{{ __('mails.common.ending') }}<br>
{{ config('app.name') }}
@endcomponent
