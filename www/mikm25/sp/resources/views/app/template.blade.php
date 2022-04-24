@extends('base')

@push('head')
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
@endpush

@push('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>
@endpush