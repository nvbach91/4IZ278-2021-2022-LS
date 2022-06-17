@extends('base')

@push('head')
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
@endpush

@section('content')
    <main id="app">
        @include('app.template.sidebar')
        <section id="app-content">
            <div class="container-fluid">
                @include('app.template.navbar')
                @include('common.status')
                @yield('app-content')
            </div>
        </section>
    </main>
@endsection