@component('mail::message')
# {{ __('mails.common.greeting') }}

{{ __('mails.user.registered_without_verification.line1', ['appName' => config('app.name')]) }}

{{ __('mails.common.ending') }}<br>
{{ config('app.name') }}
@endcomponent
