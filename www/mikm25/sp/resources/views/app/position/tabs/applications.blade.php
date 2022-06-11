@php

use App\Models\Position;
use App\Enums\PositionTabEnum;
use App\Models\PositionApplication;

/**
 * @var Position $position
 * @var PositionTabEnum $activeTab
 * @var list<PositionApplication> $applications
 */

@endphp

@extends('app.position.show')

@section('position-content')
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th class="text-nowrap">{{ __('models.id') }}</th>
                        <th class="text-nowrap">{{ __('models.position_application.name') }}</th>
                        <th class="text-nowrap">{{ __('models.position_application.email') }}</th>
                        <th class="text-nowrap">{{ __('models.position_application.phone') }}</th>
                        <th class="text-nowrap">{{ __('models.created_at') }}</th>
                        <th class="text-nowrap">{{ __('tables.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td class="text-nowrap">{{ $application->id }}</td>
                            <td class="text-nowrap">{{ $application->name }}</td>
                            <td class="text-nowrap">{{ $application->email }}</td>
                            <td class="text-nowrap">{{ $application->phone ?? '-' }}</td>
                            <td class="text-nowrap">{{ $application->created_at->format('j. n. Y H:i:s') }}</td>
                            <td class="text-nowrap">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#position-application-modal-{{ $application->id }}">
                                    {{ __('common.buttons.detail') }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <span class="text-muted">
                                    {{ __('positions.applications.index.empty') }}
                                </span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $applications->links() }}
    @foreach($applications as $application)
        @include('app.position.modals.application', ['application' => $application])
    @endforeach
@endsection
