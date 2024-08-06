<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @livewireStyles
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/wave.svg') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }} - {{ config('app.name') }}</title>


</head>

<body class="font-sans bg-blue-50 dark:bg-black dark:text-white/50">
    <section class="grid w-full grid-cols-5 grid-rows-5 gap-x-10 gap-y-10 bg-wave-primary-bg ">
        <div class="row-span-5">
            @if (auth()->user()->role == 'user')
                <livewire:utils.navigation-side-bar :active="parse_url(request()->getRequestUri())['path']" />
            @endif


        </div>
        <div class="col-span-4">
            {{-- WE NEED TO WRAP THE LAYOUT INSIDE THE DASHBOARD --}}
            <livewire:utils.header-login name="{{ auth()->user()->name }} {{ auth()->user()->lastname }}"
                title="{{ $title }}" balance="{{ auth()->user()->balance }}" :path="trim(request()->getRequestUri(), '/')" />
        </div>


        {{-- ! This is refer to the active panel ! --}}
        <div class="min-h-screen col-span-4 col-start-2 row-span-4 row-start-2 px-10">
            {{ $slot }}
        </div>
        {{-- ! This is refer to the active panel ! --}}
    </section>

    @include('sweetalert::alert')
    @livewireScripts
</body>

</html>
