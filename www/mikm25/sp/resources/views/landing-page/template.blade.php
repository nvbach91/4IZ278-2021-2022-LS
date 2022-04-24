@extends('base')

@push('head')
    <link rel="stylesheet" href="{{ mix('/css/landing-page.css') }}">
@endpush

@push('scripts')
    <script src="{{ mix('/js/landing-page.js') }}"></script>
@endpush