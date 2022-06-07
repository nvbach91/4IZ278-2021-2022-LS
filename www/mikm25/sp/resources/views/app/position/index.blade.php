@php

use App\Models\Position;

/**
 * @var list<Position> $positions
 */

@endphp

@extends('templates.app')

@section('title')
    {{ __('pages.app.positions.index') }}
@endsection

@section('breadcrumbs')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('app.positions.index') }}
@endsection

@section('app-content')
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th class="text-nowrap">{{ __('models.id') }}</th>
                        <th class="text-nowrap">{{ __('models.position.name') }}</th>
                        <th class="text-nowrap">{{ __('models.position.branch') }}</th>
                        <th class="text-nowrap">{{ __('models.position.company') }}</th>
                        <th class="text-nowrap">{{ __('models.position.external_url') }}</th>
                        <th class="text-nowrap">{{ __('models.position.valid') }}</th>
                        <th class="text-nowrap">{{ __('models.position.clicks_count') }}</th>
                        <th class="text-nowrap">{{ __('models.position.reactions_count') }}</th>
                        <th class="text-nowrap">{{ __('tables.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($positions as $position)
                        <tr>
                            <td class="text-nowrap">{{ $position->id }}</td>
                            <td class="text-nowrap">{{ $position->name }}</td>
                            <td class="text-nowrap">{{ $position->branch->translated_name }}</td>
                            <td class="text-nowrap">
                                @if(!empty($position->company))
                                    <a href="{{ route('app.companies.show', ['company' => $position->company->id]) }}"
                                       title="{{ $position->company->name }}">
                                        {{ $position->company->name }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-nowrap">
                                @if(!empty($position->external_url))
                                    <a href="{{ $position->external_url }}" target="_blank"
                                       title="{{ $position->external_url }}">
                                        {{ __('common.link') }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-nowrap">
                                @if($position->is_valid)
                                    <span class="text-success">{{ __('common.yes') }}</span>
                                @else
                                    <span class="text-danger">{{ __('common.no') }}</span>
                                @endif
                            </td>
                            <td class="text-nowrap">{{ $position->clicks_count }}</td>
                            <td class="text-nowrap">{{ $position->reactions_count }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('app.positions.show', ['position' => $position->id, 'tab' => \App\Enums\PositionTabEnum::detail()->getValue()]) }}"
                                   class="btn btn-sm btn-primary">
                                    {{ __('common.buttons.detail') }}
                                </a>
                                <a href="{{ route('app.positions.edit', ['position' => $position->id]) }}"
                                   class="btn btn-sm btn-light ms-1">
                                    {{ __('common.buttons.edit') }}
                                </a>
                                <a href="#" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal"
                                   data-bs-target="#position-delete-modal" data-bs-form-action="{{ route('app.positions.delete', ['position' => $position->id]) }}">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                {{ __('positions.index.empty') }}
                                <a href="{{ route('app.positions.create') }}" class="btn btn-sm btn-primary">
                                    {{ __('positions.buttons.create') }}
                                </a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $positions->links() }}
    @include('app.position.modals.delete')
@endsection