@php

use App\Models\Position;

/**
 * @var list<Position> $positions
 */

@endphp

@extends('templates.landing-page')

@section('landing-page-content')
    <div class="row">
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
                            <h5 class="card-title m-0">
                                {{ $position->name }}
                            </h5>
                        </div>
                        <div>
                            <a href="{{ route('landing-page.show-position', ['slugPosition' => $position->slug]) }}" class="btn btn-sm btn-primary">
                                {{ __('common.buttons.detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection