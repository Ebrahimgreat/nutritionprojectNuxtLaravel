<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Load Tailwind CSS and your custom CSS via Vite -->

    <!-- Filament Styles -->
    @filamentStyles
    @livewireStyles



    <style>
        body {
            background-color: #270202;
            color:white;
            font-family:"Roboto";
        }


    </style>

    @vite('resources/css/app.css')
</head>
<body class="antialiased">
<x-layouts.navigation />


<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Example of an image with Tailwind CSS styling -->
<div class="flex -space-x-1 overflow-hidden">
    <x-filament::avatar
        src="{{ asset('storage/photo.png') }}"
        alt="Dan Harrin"
        size="lg"

    />
</div>







    <div class="mx-auto max-w-7xl px-10 py-6 sm:px-6 lg:px-12" style="background-color:#270202;">
        <center>
            {{$heading}}
        </center>
    </div>

<!-- Dynamic content slots -->

    {{$slot}}




<!-- Filament Scripts -->
@livewireScripts
@filamentScripts
<!-- Your custom JS (loaded via Vite) -->
@vite('resources/js/app.js')


</body>
</html>
