@php

use App\Models\Position;
use App\Enums\PositionTabEnum;
use App\View\Models\Dashboards\DashboardInterface;

/**
 * @var Position $position
 * @var PositionTabEnum $activeTab
 * @var list<DashboardInterface> $dashboards
 */

@endphp

@extends('app.position.show')

@section('position-content')
    <div class="row">
        @foreach($dashboards as $dashboard)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3 mb-lg-0">
                @include('app.common.dashboard', ['dashboard' => $dashboard])
            </div>
        @endforeach
    </div>
@endsection
