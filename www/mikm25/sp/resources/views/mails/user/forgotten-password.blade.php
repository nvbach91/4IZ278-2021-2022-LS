@component('mail::message')
# {{ __('mails.common.greeting') }}

{{ __('mails.user.forgotten_password.line1') }}

@component('mail::button', ['url' => $resetLink])
{{ __('mails.user.forgotten_password.action') }}
@endcomponent

{{ __('mails.common.ending') }}<br>
{{ config('app.name') }}
@endcomponent
