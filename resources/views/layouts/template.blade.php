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
        {{--Barra navigacio--}}
        


        {{-- Header --}}        
        @include('components.header')



        <div class="flex flex-1 min-h-0"> 
            @include('components.sidebar')
        <main class="flex-1 overflow-auto p-6 bg-gray-50 min-h-0">
            @yield('contingut')
        </main>
        </div>

        {{-- Peu de pagina --}}
         <footer class="h-16 bg-gray-100 shadow-inner flex items-center justify-between w-full">
        @include('components.footer')
    </footer>

    </body>
</html>