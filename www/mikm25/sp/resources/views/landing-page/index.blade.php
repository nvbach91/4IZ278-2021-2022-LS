@php

use App\Models\Position;

/**
 * @var list<Position> $positions
 */

@endphp

@extends('templates.landing-page')

@section('content')
    <div class="container-md">
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded-2 mt-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('landing-page') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggle" aria-controls="navbar-toggle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-toggle">
                    <div class="ms-auto d-grid gap-1 d-md-block">
                        @if(auth('web')->check())
                            <a href="{{ route('app.dashboard') }}" class="btn btn-primary me-lg-2">
                                {{ __('landing-page.to_app') }}
                            </a>
                        @else
                            <a href="{{ route('auth.login') }}" class="btn btn-light me-lg-2">
                                {{ __('pages.auth.login') }}
                            </a>
                            <a href="{{ route('auth.register') }}" class="btn btn-primary">
                                {{ __('pages.auth.register') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="row mt-4">
            <div class="col">
                <div class="card border-0 bg-light p-5">
                    <h1>Najděte si práci, co vás bude bavit!</h1>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                @foreach($positions as $position)
                    <div class="card border-0 bg-light p-1 mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <div class="flex-grow-1 me-2">
                                <h5 class="card-title">
                                    {{ $position->name }}
                                </h5>
                            </div>
                            <div>
                                <a href="#" class="btn btn-primary">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection