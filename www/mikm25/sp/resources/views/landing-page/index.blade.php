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
                <h1>{{ __('landing-page.title') }}</h1>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-lg-3">
        <div class="col">
            @forelse($positions as $position)
                <div class="card bg-light border-0 mb-2">
                    <a href="{{ route('landing-page.show-position', ['slugPosition' => $position->slug]) }}" class="position-absolute w-100 h-100"></a>
                    <div class="card-body m-between-column-2 p-4">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title m-0">{{ $position->name }}</h5>
                            @if(!empty($position->tags))
                                <div class="ms-2 d-flex justify-content-start align-items-center m-between-row-2 flex-wrap">
                                    @foreach($position->tags as $tag)
                                        <span class="badge bg-primary">
                                        {{ $tag->name }}
                                    </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-start align-items-center m-between-row-2 flex-wrap">
                            @isset($position->company)
                                <span class="text-muted">
                                    <i class="bi bi-building"></i> {{ $position->company->name }}
                                </span>
                            @endisset
                            <span class="text-muted">
                                <i class="bi bi-geo-alt"></i> {{ $position->workplace_address }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    {{ __('landing-page.empty') }}
                </div>
            @endforelse
        </div>
    </div>

    {{ $positions->links() }}
@endsection