<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta tags  -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

        <title>@yield('title', 'Invent Pro')</title>
        <link rel="icon" type="image/png" href="images/favicon.png" />

        <!-- CSS Assets -->
        <link rel="stylesheet" href="{{ asset('dashboard_ui/css/app.css') }}" />

        <!-- Javascript Assets -->
        <script src="{{ asset('dashboard_ui/js/app.js') }}" defer></script>

        <!-- Javascript Third Party Libraries: Components -->
        <script src="{{ asset('dashboard_ui/js/libs/components.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
        <script>
            /**
             * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
             */
            localStorage.getItem("dark-mode") === "dark" &&
                document.documentElement.classList.add("dark");
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        @stack('head')
        @stack('styles')
    </head>
    <body class="is-header-blur @yield('body-class')">
        <!-- App preloader-->
        <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">
            <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
        </div>

        <!-- Page Wrapper -->
        <div id="root" class="min-h-100vh cloak flex grow bg-slate-50 dark:bg-navy-900">
            @include('components.dashboard.sidebar')
            @include('components.dashboard.nav')
            @include('components.dashboard.mobile-searchbar')
            @include('components.dashboard.right-sidebar')

            <!-- Page Content -->
            @yield('content')
        </div>

        @stack('modals')

        @livewireScripts

        @stack('scripts')
    </body>
</html>