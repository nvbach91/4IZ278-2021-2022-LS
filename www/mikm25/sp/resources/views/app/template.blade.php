@extends('base')

@push('head')
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
@endpush