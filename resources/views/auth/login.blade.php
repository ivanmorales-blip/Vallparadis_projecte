<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>
<body class="w-screen h-screen bg-gradient-to-b from-white to-gray-200 flex items-center justify-center font-sans">

    <!-- Contenedor principal -->
    <div class="relative w-full h-full flex items-center justify-center">

        <!-- Card central grande -->
        <div class="relative w-[50rem] h-[36rem] rounded-3xl bg-gradient-to-br from-yellow-200 to-orange-300 shadow-2xl flex-none -translate-x-20 flex overflow-hidden">

            <!-- Lado izquierdo del card: logo / imagen -->
            <div class="w-1/2 flex items-center justify-center p-6">
                <img src="{{ asset('images/logo_1.png') }}" alt="Logo" class="max-w-full max-h-full object-contain">
            </div>
        </div>

        <!-- Formulario flotante mitad dentro / mitad fuera del card -->
        <div 
            class="absolute top-1/2 left-[calc(50%+4.5rem)] transform -translate-y-1/2 w-96 bg-white rounded-3xl shadow-2xl p-10 
                   transition-transform duration-300 hover:scale-105 hover:shadow-3xl z-10">
            
            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Iniciar Sesión</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6 relative">
                    <x-input-label for="email" :value="__('Email')" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.94 5.5A2 2 0 014 5h12a2 2 0 011.06.5L10 11 2.94 5.5z"/>
                            <path d="M18 8v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8l8 5 8-5z"/>
                        </svg>
                    </div>
                    <x-text-input id="email" class="block mt-1 w-full pl-12 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6 relative">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 8V6a5 5 0 1110 0v2h1a1 1 0 011 1v9a1 1 0 01-1 1H4a1 1 0 01-1-1V9a1 1 0 011-1h1zm2-2a3 3 0 116 0v2H7V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <x-text-input id="password" class="block mt-1 w-full pl-12 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-400" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-orange-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Botón Entrar -->
                <x-primary-button class="w-full bg-orange-500 hover:bg-orange-600 active:bg-orange-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">
                    {{ __('Log in') }}
                </x-primary-button>

                <!-- Registrarse -->
                <p class="mt-6 text-center text-gray-700 text-sm">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="text-orange-600 hover:underline font-medium">Regístrate</a>
                </p>
            </form>
        </div>

    </div>

</body>
</html>
