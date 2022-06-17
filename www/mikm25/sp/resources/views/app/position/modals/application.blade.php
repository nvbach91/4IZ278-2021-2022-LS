@php

use App\Models\PositionApplication;

/**
 * @var PositionApplication $application
 */

@endphp

<div class="modal fade" id="position-application-modal-{{ $application->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('positions.applications.modal.title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-between-column-2">
                <div>
                    <div class="fw-bolder mb-2">
                        {{ __('models.position_application.name') }}:
                    </div>
                    <span>{{ $application->name }}</span>
                </div>
                <div>
                    <div class="fw-bolder mb-2">
                        {{ __('models.position_application.email') }}:
                    </div>
                    <span>
                        <a href="mailto:{{ $application->email }}">{{ $application->email }}</a>
                    </span>
                </div>
                <div>
                    <div class="fw-bolder mb-2">
                        {{ __('models.position_application.phone') }}:
                    </div>
                    <span>{{ $application->phone ?? '-' }}</span>
                </div>
                <div>
                    <div class="fw-bolder mb-2">
                        {{ __('models.position_application.message') }}:
                    </div>
                    <div class="bg-light rounded p-3 w-100">
                        {!! $application->message !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.buttons.close') }}</button>
            </div>
        </div>
    </div>
</div>