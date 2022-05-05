<?php

use App\Models\Position;

/**
 * @var Position $position
 */

?>

@extends('app.position.detail.template')

@section('position-content')
    <div class="row mb-2">
        <div class="col-lg-6 col-sm-12 mb-sm-2">
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
                            <a href="{{ $position->external_url }}" target="_blank">{{ $position->external_url }}</a>
                        @else
                            -
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
                        <td>{{ $position->company->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('models.company.size') }}</td>
                        <td>{{ !empty($position->company->size) ? $position->company->size->getTranslatedSize() : '-' }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('models.company.url') }}</td>
                        <td>{{ $position->company->url ?? '-' }}</td>
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
        <div class="col-lg-4 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    {!! $position->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
