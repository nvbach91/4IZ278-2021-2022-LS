@extends('base')

@push('head')
    <link rel="stylesheet" href="{{ mix('/css/auth.css') }}">
@endpush

@push('scripts')
    <script src="{{ mix('/js/auth.js') }}"></script>
@endpush