<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/wave.svg') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }} - {{ config('app.name') }}</title>
    @livewireStyles


</head>

<body class="font-sans dark:bg-black dark:text-white/50">
    {{ $slot }}


    @include('sweetalert::alert')


    @livewireScripts
</body>

</html>
