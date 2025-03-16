<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')


    <title>{{ config('app.name') }}</title>
    @livewireStyles

    @filamentStyles
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>




    @vite('resources/css/app.css')
</head>


<body class="antialiased">
@yield('content')
{{ $slot }}
@livewireScripts
@filamentScripts
@vite('resources/js/app.js')
</body>
</html>
