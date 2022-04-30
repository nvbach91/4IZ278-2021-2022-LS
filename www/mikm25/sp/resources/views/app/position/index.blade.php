@extends('templates.app')

@section('title')
    {{ __('pages.app.positions') }}
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
                    <th>{{ __('models.position.salary_from') }}</th>
                    <th>{{ __('models.position.salary_to') }}</th>
                    <th>{{ __('models.position.external_url') }}</th>
                    <th>{{ __('models.position.valid_from') }}</th>
                    <th>{{ __('models.position.valid_until') }}</th>
                    <th>{{ __('models.position.company_name') }}</th>
                    <th>{{ __('tables.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($positions as $position)
                    <tr>
                        <td>{{ $position->id }}</td>
                        <td>{{ $position->name }}</td>
                        <td>{{ $position->branch->translated_name }}</td>
                        <td>{{ $position->salary_from }}</td>
                        <td>{{ $position->salary_to }}</td>
                        <td>
                            @if(!empty($position->external_url))
                                <a href="{{ $position->external_url }}" target="_blank" title="{{ $position->external_url }}">
                                    {{ __('common.link') }}
                                </a>
                            @endif
                        </td>
                        <td>{{ $position->valid_from->format('Y-m-d') }}</td>
                        <td>{{ $position->valid_until->format('Y-m-d') }}</td>
                        <td>{{ $position->company_name }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">
                                {{ __('common.buttons.detail') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $positions->links() }}
@endsection