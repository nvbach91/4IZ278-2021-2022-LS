@extends('templates.app')

@section('title')
    {{ __('pages.dashboard') }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="min-vh-100 row justify-content-center align-items-center">
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 my-3">
                Dobře ses přihlásil kámo! Vítej
            </div>
        </div>
    </section>
@endsection