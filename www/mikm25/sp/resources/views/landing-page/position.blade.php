@php

use App\Models\Position;

/**
 * @var Position $position
 */

@endphp

@extends('templates.landing-page')

@section('landing-page-content')
    {{ $position->name }}
@endsection