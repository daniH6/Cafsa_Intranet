<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    </head>
    <body class="font-sans antialiased">
        <div class="relative min-h-dvh bg-gray-100 dark:bg-gray-900">
            @include('admin.layouts.navigation')
            
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-2 px-2 sm:px-2 lg:px-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            
            
            <main class="flex max-w-7xl mx-auto">
            <!-- Sidebar -->
                @isset($sidebar)
                    <sidebar class="ml-5 w-44">
                            <!-- Sidebar -->
                            {{ $sidebar }}
                    </sidebar>
                @endisset
                
                <div class="flex flex-col w-full">
                <!-- Page Content -->
                    {{ $slot }}
                </div>
            </main>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
    </body>
    
</html>
