@component('mail::message')
# {{ __('mails.common.greeting') }}

{{ __('mails.user.password_reset.line1', ['supportEmail' => config('app.support_email')]) }}

{{ __('mails.common.ending') }}<br>
{{ config('app.name') }}
@endcomponent
