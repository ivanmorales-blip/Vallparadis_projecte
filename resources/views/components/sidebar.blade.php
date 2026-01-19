<aside class="w-72 bg-white/95 backdrop-blur-sm border-r border-gray-200 shadow-xl h-screen flex flex-col">

    {{-- Perfil usuario --}}
    <div class="p-5 flex items-center space-x-4 border-b border-gray-200">
        <img src="{{ auth()->user()->avatar ?? asset('default-avatar.png') }}" 
             alt="Avatar" 
             class="w-12 h-12 rounded-full border-2 border-orange-400 shadow-md hover:scale-105 transition-transform duration-300">
        <div>
            <p class="font-bold text-gray-900 text-lg">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">Administrador</p>
        </div>
    </div>

    {{-- Buscador --}}
    <div class="p-4 border-b border-gray-200">
        <input id="sidebarSearch" type="text" placeholder="Cerca..." 
            class="w-full px-4 py-2 text-sm rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-300
                    bg-white/50 backdrop-blur-sm shadow-sm placeholder-gray-400 transition-all duration-300 hover:shadow-md">
    </div>

    {{-- Navegación principal con scroll --}}
    <nav class="flex flex-col p-4 space-y-3 flex-grow overflow-y-auto custom-scrollbar">

        @php
        $menuItems = [
            ['title'=>'Professionals','icon'=>'profesionals-icone','links'=>[['name'=>'Llistar Professionals','route'=>route('profesional.index')],['name'=>'Alta Professional','route'=>route('profesional.create')]]],
            ['title'=>'Projectes','icon'=>'computer-desktop','links'=>[['name'=>'Llistar Projectes','route'=>route('projectes_comissions.projectes')],['name'=>'Alta Projecte','route'=>route('projectes_comissions.create')]]],
            ['title'=>'Comissions','icon'=>'computer-desktop','links'=>[['name'=>'Llistar Comissions','route'=>route('projectes_comissions.comissions')],['name'=>'Alta Comissió','route'=>route('projectes_comissions.create')]]],
            ['title'=>'Seguiments','icon'=>'tracking-icone','links'=>[['name'=>'Llistar Seguiments','route'=>route('tracking.index')],['name'=>'Alta Seguiment','route'=>route('tracking.create')]]],
            ['title'=>'Avaluacions','icon'=>'tracking-icone','links'=>[['name'=>'Llistar Avaluacions','route'=>route('evaluation.index')],['name'=>'Alta Avaluació','route'=>route('evaluation.create')]]],
            ['title'=>'Cursos','icon'=>'training-icone','links'=>[['name'=>'Llistar Cursos','route'=>route('trainings.index')],['name'=>'Alta Cursos','route'=>route('trainings.create')]]],
            ['title'=>'Recursos Humans','icon'=>'human-resources-icone','links'=>[['name'=>'Llistar Recursos Humans','route'=>route('human_resources.index',1)],['name'=>'Alta Recurso Humà','route'=>route('human_resources.create',[1,'pendent'])]]],
            ['title'=>'Documentació interna','icon'=>'documentacio-icone','links'=>[['name'=>'Llistar Documentació','route'=>route('documentacio.index')],['name'=>'Alta Documentació','route'=>route('documentacio.create')]]],
            ['title'=>'Manteniment','icon'=>'manteniment-icone','links'=>[['name'=>'Llistar Manteniment','route'=>route('manteniment.index')],['name'=>'Alta Manteniment','route'=>route('manteniment.create')]]],
        ];
        @endphp

        @foreach($menuItems as $item)
        <div x-data="{ open: false }" class="mb-2">
            <button @click="open = !open" 
                    :class="{'bg-orange-50 shadow-lg': open}"
                    class="flex items-center justify-between w-full px-4 py-2 rounded-2xl text-gray-700 font-medium 
                           transition-all duration-300 shadow-sm hover:shadow-lg hover:bg-orange-50 hover:text-orange-600 transform hover:-translate-y-0.5">
                <span class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-orange-400 transition-colors duration-300">
                        <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#{{ $item['icon'] }}"></use>
                    </svg>
                    <span class="text-sm font-semibold">{{ $item['title'] }}</span>
                </span>
                <svg :class="{'rotate-90': open}" 
                     class="w-4 h-4 transition-transform duration-300 text-orange-400"
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            {{-- Submenú desplegable --}}
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 max-h-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 max-h-60 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 max-h-60 translate-y-0"
                 x-transition:leave-end="opacity-0 max-h-0 -translate-y-2"
                 class="mt-2 ml-8 flex flex-col space-y-1 overflow-hidden">

                @foreach($item['links'] as $link)
                <a href="{{ $link['route'] }}" 
                   class="px-3 py-2 rounded-2xl text-sm font-medium
                          bg-white/50 backdrop-blur-sm border border-gray-200 shadow-sm
                          hover:bg-orange-100 hover:text-orange-600 transition-all duration-300 hover:shadow-md transform hover:-translate-y-0.5
                          {{ request()->url() === $link['route'] ? 'bg-orange-100 shadow-lg text-orange-700 font-bold' : '' }}">
                    {{ $link['name'] }}
                </a>
                @endforeach
            </div>
        </div>
        @endforeach

    </nav>
</aside>

{{-- Scroll styling profesional --}}
<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: rgba(245, 158, 11, 0.5);
    border-radius: 12px;
    transition: background-color 0.3s;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background-color: rgba(245, 158, 11, 0.85);
}
.custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: rgba(245, 158, 11, 0.5) transparent;
}
</style>
