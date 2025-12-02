<aside class="w-64 bg-white border-r border-gray-200 shadow-lg z-40 flex flex-col">

    {{-- Perfil usuario --}}
    <div class="p-4 flex items-center space-x-3 border-b border-gray-200">
        <img src="{{ auth()->user()->avatar ?? asset('default-avatar.png') }}" alt="Avatar" class="w-10 h-10 rounded-full">
        <div>
            <p class="font-semibold text-gray-700">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">Administrador</p>
        </div>
    </div>

    {{-- Buscador --}}
    <div class="p-3 border-b border-gray-200">
        <input type="text" placeholder="Cerca..." class="w-full px-3 py-2 text-sm rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-300">
    </div>

    {{-- Navegación principal --}}
    <nav class="flex flex-col p-4 space-y-2 flex-grow overflow-y-auto custom-scrollbar">
        
        {{-- Centres --}}
        <div x-data="{ open: true }" class="mb-2">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition font-medium">
                <span class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10l1-2 4 4 5-5 4 4 3-3"></path></svg>
                    <span>Centres</span>
                </span>
                <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="open" class="mt-1 ml-6 flex flex-col space-y-1">
                <a href="{{ route('centers.index') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Llistar Centres</a>
                <a href="{{ route('centers.create') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Alta Centre</a>
            </div>
        </div>

        {{-- Professionals --}}
        <div x-data="{ open: true }" class="mb-2">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition font-medium">
                <span class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-8 0v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>Professionals</span>
                </span>
                <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="open" class="mt-1 ml-6 flex flex-col space-y-1">
                <a href="{{ route('profesional.index') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Llistar Professionals</a>
                <a href="{{ route('profesional.create') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Alta Professional</a>
            </div>
        </div>

        {{-- Seguiments --}}
        <div x-data="{ open: true }" class="mb-2">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition font-medium">
                <span class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 17v-6h13v6"></path><path d="M3 13h4v4H3z"></path></svg>
                    <span>Seguiments</span>
                </span>
                <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="open" class="mt-1 ml-6 flex flex-col space-y-1">
                <a href="{{ route('tracking.index') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Llistar Seguiments</a>
                <a href="{{ route('tracking.create') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Alta Seguiment</a>
            </div>
        </div>

        {{-- Evaluacions --}}
        <div x-data="{ open: true }" class="mb-2">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition font-medium">
                <span class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422M12 14v7M12 14L5.84 10.578M12 21l6.16-3.422M5.84 17.578L12 21"></path></svg>
                    <span>Avaluacions</span>
                </span>
                <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="open" class="mt-1 ml-6 flex flex-col space-y-1">
                <a href="{{ route('evaluation.index') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Llistar Avaluacions</a>
                <a href="{{ route('evaluation.create') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Alta Avaluació</a>
            </div>
        </div>

        {{-- Cursos --}}
        <div x-data="{ open: true }" class="mb-2">
            <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 text-gray-700 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition font-medium">
                <span class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14v7"></path><path d="M12 14L5.84 10.578"></path></svg>
                    <span>Cursos</span>
                </span>
                <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="open" class="mt-1 ml-6 flex flex-col space-y-1">
                <a href="{{ route('trainings.index') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Llistar Cursos</a>
                <a href="{{ route('trainings.create') }}" class="px-3 py-2 rounded-xl hover:bg-orange-50 hover:text-orange-500 transition">Alta Cursos</a>
            </div>
        </div>

    </nav>
</aside>

{{-- Scroll styling (Tailwind) --}}
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(209, 115, 46, 0.5);
        border-radius: 10px;
    }
</style>
