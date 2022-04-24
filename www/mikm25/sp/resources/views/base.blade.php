<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @hasSection('title')
            {{ config('app.name') }} | @yield('title')
        @else
            {{ config('app.name') }}
        @endif
    </title>
    @stack('head')
</head>
<body>
@yield('content')
@stack('scripts')
</body>
</html>
