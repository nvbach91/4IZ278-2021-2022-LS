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
                                    <i class="bi bi-geo-alt"></i> {{ $position->workplace_address }}
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
                <div class="card-footer border-0 px-4">
                    <div class="d-flex justify-content-start align-items-center m-between-row-2 flex-wrap">
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> {{ __('models.created_at') }}: {{ $position->created_at->format('j. n. Y H:i:s') }}
                        </small>
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> {{ __('models.updated_at') }}: {{ $position->updated_at->format('j. n. Y H:i:s') }}
                        </small>
                    </div>
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
                                    <a href="{{ $position->company->url }}" target="_blank">{{ $position->company->url }}</a>
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
                        @if($position->isExternalUrlSet())
                            <a href="{{ route('landing-page.position-redirect', ['slugPosition' => $position->slug]) }}"
                               class="btn btn-primary">
                                {{ __('landing-page.position.interested_button') }}
                            </a>
                        @else
                            <button type="button" class="btn btn-primary position-interested-btn">
                                {{ __('landing-page.position.interested_button') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$position->isExternalUrlSet())
        <div class="row mt-2 mt-lg-3 mb-2 position-reaction-form">
            <div class="col">
                <div class="card bg-light border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('landing-page.position-react', ['slugPosition' => $position->slug]) }}" method="post">
                            <div class="row">
                                <div class="col-lg-6 m-between-column-2 mb-2 mb-lg-0">
                                    <div>
                                        <label for="reaction-name" class="form-label">
                                            {{ __('landing-page.position.form.name') }}
                                            @include('common.forms.required')
                                        </label>
                                        <input type="text" name="name" id="reaction-name" class="form-control" required>
                                    </div>
                                    <div>
                                        <label for="reaction-email" class="form-label">
                                            {{ __('landing-page.position.form.email') }}
                                            @include('common.forms.required')
                                        </label>
                                        <input type="email" name="email" id="reaction-email" class="form-control" required>
                                    </div>
                                    <div>
                                        <label for="reaction-phone" class="form-label">
                                            {{ __('landing-page.position.form.phone') }}
                                        </label>
                                        <input type="tel" name="phone" id="reaction-phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex flex-column">
                                    <label for="reaction-message" class="form-label">
                                        {{ __('landing-page.position.form.message') }}
                                        @include('common.forms.required')
                                    </label>
                                    <textarea class="form-control flex-grow-1" name="message" id="reaction-message" required></textarea>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-lg-3">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('landing-page.position.interested_button') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection