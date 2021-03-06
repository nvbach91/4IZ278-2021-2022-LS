@extends('base')

@push('head')
    <link rel="stylesheet" href="{{ mix('/css/landing-page.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('/js/landing-page.js') }}"></script>
@endpush

@section('content')
    <div class="container-md">
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded-2 mt-2 mb-2 mb-lg-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('landing-page') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggle" aria-controls="navbar-toggle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-toggle">
                    <div class="ms-auto d-grid gap-1 d-md-block pt-3 pt-md-0">
                        @if(auth('web')->check())
                            <a href="{{ route('app.dashboard') }}" class="btn btn-sm btn-primary me-lg-2">
                                {{ __('landing-page.to_app') }}
                            </a>
                        @else
                            <a href="{{ route('auth.login') }}" class="btn btn-sm btn-outline-primary me-lg-2">
                                {{ __('pages.auth.login') }}
                            </a>
                            <a href="{{ route('auth.register') }}" class="btn btn-sm btn-outline-primary">
                                {{ __('pages.auth.register') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        @include('common.status')
        @yield('landing-page-content')
    </div>
@endsection