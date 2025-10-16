<aside class="w-64 bg-white border-r border-gray-200 shadow-lg z-40 flex flex-col">


  <nav class="p-4 flex flex-col space-y-4 flex-grow overflow-y-auto">
    <a href="{{ route('centers.index') }}" class="text-gray-700 hover:text-orange-500">Listar Centros</a>
    <a href="{{ route('centers.create') }}" class="text-gray-700 hover:text-orange-500">Alta Centro</a>
    <a href="{{ route('profesional.index') }}" class="text-gray-700 hover:text-orange-500">Listar Professionals</a>
    <a href="{{ route('profesional.create') }}" class="text-gray-700 hover:text-orange-500">Alta Professionals</a>
    <a href="{{ route('projectes_comissions.index') }}" class="text-gray-700 hover:text-orange-500">Listar Projectes</a>
    <a href="{{ route('projectes_comissions.create') }}" class="text-gray-700 hover:text-orange-500">Alta Projectes</a>
  </nav>
</aside>
