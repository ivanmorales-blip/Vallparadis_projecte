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
    <body class="min-h-screen flex flex-col font-sans antialiased">
        
        {{-- Header --}}        
        @include('components.header')



        <div class="flex min-h-screen">
            <aside class="w-72 bg-white/95 backdrop-blur-sm border-r border-gray-200 shadow-xl flex flex-col sticky top-0 h-screen overflow-y-auto scroll-smooth custom-scrollbar">
                @include('components.sidebar') 
            </aside>

            <main class="flex-1 overflow-auto p-6 bg-gray-50">
                @yield('contingut')
            </main>
        </div>




        {{-- Peu de pagina --}}
         <footer class="h-16 bg-gray-100 shadow-inner flex items-center justify-between w-full">
        @include('components.footer')
         </footer>

    </body>
</html>