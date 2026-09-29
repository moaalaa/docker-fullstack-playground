<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-base-200 text-base-content antialiased">

    <div class="drawer lg:drawer-open">
        <input id="drawer" type="checkbox" class="drawer-toggle" />

        <!-- ========================= MAIN COLUMN ========================= -->
        <div class="drawer-content flex min-h-dvh min-w-0 flex-col">
            <livewire:header />

            <!-- Page content -->
            <main class="flex-1 px-4 py-8 sm:px-10 sm:py-10">
                {{ $slot }}
            </main>
        </div>



        <livewire:sidebar />
    </div>

    <livewire:auth-modal />
    <livewire:toast />
    @livewireScripts
</body>

</html>
