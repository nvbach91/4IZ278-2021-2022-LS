@extends('base')

@push('head')
    <link rel="stylesheet" href="{{ mix('/css/auth.css') }}">
@endpush

@push('scripts')
    <script src="{{ mix('/js/auth.js') }}"></script>
@endpush

@section('content')
    <section class="container-fluid">
        <div class="min-vh-100 row justify-content-center align-items-center">
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 my-3">
                @yield('card')
            </div>
        </div>
    </section>
@endsection