<?php

use App\Models\Position;

/**
 * @var list<Position> $positions
 */

?>

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
            <table class="table table-borderless table-responsive">
                <thead>
                <tr>
                    <th>{{ __('models.id') }}</th>
                    <th>{{ __('models.position.name') }}</th>
                    <th>{{ __('models.position.branch') }}</th>
                    <th>{{ __('models.position.company') }}</th>
                    <th>{{ __('models.position.external_url') }}</th>
                    <th>{{ __('models.position.valid') }}</th>
                    <th>{{ __('models.position.clicks_count') }}</th>
                    <th>{{ __('models.position.reactions_count') }}</th>
                    <th>{{ __('tables.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($positions as $position)
                    <tr>
                        <td>{{ $position->id }}</td>
                        <td>{{ $position->name }}</td>
                        <td>{{ $position->branch->translated_name }}</td>
                        <td>
                            @if(!empty($position->company))
                                <a href="{{ route('app.companies.show', ['company' => $position->company->id]) }}" title="{{ $position->company->name }}">
                                    {{ \Illuminate\Support\Str::limit($position->company->name, 20) }}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if(!empty($position->external_url))
                                <a href="{{ $position->external_url }}" target="_blank"
                                   title="{{ $position->external_url }}">
                                    {{ __('common.link') }}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($position->is_valid)
                                <span class="text-success">{{ __('common.yes') }}</span>
                            @else
                                <span class="text-danger">{{ __('common.no') }}</span>
                            @endif
                        </td>
                        <td>{{ $position->clicks_count }}</td>
                        <td>{{ $position->reactions_count }}</td>
                        <td>
                            <a href="{{ route('app.positions.show', ['position' => $position->id, 'tab' => \App\Constants\PositionTabConstants::TAB_DETAIL]) }}"
                               class="btn btn-sm btn-primary">
                                {{ __('common.buttons.detail') }}
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
    {{ $positions->links() }}
@endsection