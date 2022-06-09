@php

    use App\Models\Position;

    /**
     * @var Position $position
     */

@endphp

@extends('templates.landing-page')

@section('landing-page-content')
    <div class="row mt-2 mt-lg-3">
        <div class="col">
            <div class="card bg-light border-0">
                <div class="card-body m-between-column-2 p-4">
                    <h2>{{ $position->name }}</h2>
                    @if(isset($position->company) || isset($position->workplace_address))
                        <div class="d-flex justify-content-start align-items-center m-between-row-2 flex-wrap">
                            @isset($position->company)
                                <span class="h5">
                        <i class="bi bi-building"></i> {{ $position->company->name }}
                    </span>
                            @endisset
                            @isset($position->workplace_address)
                                <span class="h5">
                        <i class="bi bi-geo-alt-fill"></i> {{ $position->workplace_address }}
                    </span>
                            @endisset
                        </div>
                    @endif
                    @if(!empty($position->tags))
                        <div class="d-flex justify-content-start align-items-center m-between-row-2 flex-wrap">
                            @foreach($position->tags as $tag)
                                <span class="badge bg-primary">
                            {{ $tag->name }}
                        </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-lg-3 gx-0 gx-lg-3">
        <div class="col-12 col-lg-9 order-1 order-lg-0">
            <div class="card bg-light border-0">
                <div class="card-body p-4">
                    {!! $position->content !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-2 mb-lg-0 order-0 order-lg-1">
            <div class="card bg-light border-0 position-sticky top-0">
                <div class="card-body m-between-column-3">
                    <div>
                        <span class="fw-bolder mb-1 d-block">{{ __('models.position.branch') }}:</span>
                        <span>{{ $position->branch->translated_name }}</span>
                    </div>
                    @isset($position->min_practice_length)
                        <div>
                            <span class="fw-bolder mb-1 d-block">{{ __('models.position.min_practice_length') }}:</span>
                            <span>{{ $position->min_practice_length }}</span>
                        </div>
                    @endisset
                    @if($position->isSalarySet())
                        <div>
                            <span class="fw-bolder mb-1 d-block">{{ __('models.position.salary') }}:</span>
                            <span>{{ $position->getFormattedSalary() }}</span>
                        </div>
                    @endif
                    @isset($position->company)
                        <div>
                            <span class="fw-bolder mb-1 d-block">{{ __('models.company.name') }}:</span>
                            <span>{{ $position->company->name }}</span>
                        </div>
                        @isset($position->company->contact_email)
                            <div>
                                <span class="fw-bolder mb-1 d-block">{{ __('models.company.contact_email') }}:</span>
                                <span>
                                    <a href="mailto:{{ $position->company->contact_email }}">{{ $position->company->contact_email }}</a>
                                </span>
                            </div>
                        @endisset
                        @isset($position->company->url)
                            <div>
                                <span class="fw-bolder mb-1 d-block">{{ __('models.company.url') }}:</span>
                                <span>
                                    <a href="{{ $position->company->url }}">{{ $position->company->url }}</a>
                                </span>
                            </div>
                        @endisset
                        @isset($position->company->size)
                            <div>
                                <span class="fw-bolder mb-1 d-block">{{ __('models.company.size') }}:</span>
                                <span>{{ $position->company->size->getTranslatedSize() }}</span>
                            </div>
                        @endisset
                        @isset($position->company->address)
                            <div>
                                <span class="fw-bolder mb-1 d-block">{{ __('models.company.address') }}:</span>
                                <span>{{ $position->company->address }}</span>
                            </div>
                        @endisset
                    @endisset
                    <div class="d-grid">
                        <button class="btn btn-primary position-interested-btn">
                            {{ __('landing-page.position.interested_button') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection