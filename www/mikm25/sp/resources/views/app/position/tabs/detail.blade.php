@php

use App\Models\Position;
use App\Enums\PositionTabEnum;

/**
 * @var Position $position
 * @var PositionTabEnum $activeTab
 */

@endphp

@extends('app.position.show')

@section('position-content')
    <div class="row mb-2">
        <div class="col-lg-6 col-md-12 order-1 order-lg-0">
            <div class="card">
                <div class="card-header">
                    {{ __('positions.detail.sections.preview') }}
                </div>
                <div class="card-body p-4">
                    {!! $position->content !!}
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 mb-md-3 order-0 order-lg-1">
            <div class="card position-lg-sticky top-0">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td colspan="2"><b>{{ __('positions.detail.sections.general') }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('models.id') }}</td>
                            <td>{{ $position->id }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.workplace_address') }}</td>
                            <td>{{ $position->workplace_address }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.branch') }}</td>
                            <td>{{ $position->branch->translated_name }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.tags') }}</td>
                            <td>
                                @forelse($position->tags as $tag)
                                    <span class="badge bg-primary">
                                {{ $tag->name }}
                            </span>
                                @empty
                                    -
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>{{ __('positions.detail.sections.validity') }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.valid') }}</td>
                            <td>
                                @if($position->is_valid)
                                    <span class="text-success">{{ __('common.yes') }}</span>
                                @else
                                    <span class="text-danger">{{ __('common.no') }}</span>
                            @endif
                        </tr>
                        <tr>
                            <td>{{ __('models.position.valid_from') }}</td>
                            <td>{{ !empty($position->valid_from) ? $position->valid_from->format('j. n. Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.valid_until') }}</td>
                            <td>{{ !empty($position->valid_until) ? $position->valid_until->format('j. n. Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>{{ __('positions.detail.sections.salary') }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.salary_from') }}</td>
                            <td>{{ $position->salary_from ?? '–' }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.salary_to') }}</td>
                            <td>{{ $position->salary_to ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>{{ __('positions.detail.sections.content') }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.external_url') }}</td>
                            <td>
                                @if(!empty($position->external_url))
                                    <a href="{{ $position->external_url }}" target="_blank">
                                        {{ __('common.link') }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.detail_link') }}</td>
                            <td>
                                @if($position->is_valid)
                                    <a href="{{ route('landing-page.position', ['slugPosition' => $position->slug]) }}" target="_blank">
                                        {{ __('common.link') }}
                                    </a>
                                @else
                                    <span class="text-muted">{{ __('positions.detail.detail_link_hint') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('models.position.min_practice_length') }}</td>
                            <td>{{ $position->min_practice_length ?? '-' }}</td>
                        </tr>
                        @if(!empty($position->company))
                            <tr>
                                <td colspan="2"><b>{{ __('positions.detail.sections.company') }}</b></td>
                            </tr>
                            <tr>
                                <td>{{ __('models.id') }}</td>
                                <td>{{ $position->company->id }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('models.company.name') }}</td>
                                <td>
                                    <a href="{{ route('app.companies.show', ['company' => $position->company->id]) }}">
                                        {{ $position->company->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('models.company.size') }}</td>
                                <td>{{ !empty($position->company->size) ? $position->company->size->getTranslatedSize() : '-' }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('models.company.url') }}</td>
                                <td>
                                    @if(!empty($position->company->url))
                                        <a href="{{ $position->company->url }}" target="_blank">{{ $position->company->url }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('models.company.address') }}</td>
                                <td>{{ $position->company->address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('models.company.contact_email') }}</td>
                                <td>
                                    @if(!empty($position->company->contact_email))
                                        <a href="mailto:{{ $position->company->contact_email }}">{{ $position->company->contact_email }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
