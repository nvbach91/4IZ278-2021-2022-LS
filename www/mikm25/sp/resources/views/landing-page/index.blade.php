@extends('landing-page.template')

@section('content')
    <div class="container-md">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-2 mt-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('landing-page') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggle" aria-controls="navbar-toggle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-toggle">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                    <div>
                        <a href="{{ route('auth.login') }}" class="btn">
                           {{ __('pages.auth.login') }}
                        </a>
                        <a href="{{ route('auth.register') }}" class="btn btn-primary">
                            {{ __('pages.auth.register') }}
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
@endsection