@extends('layouts.template')

@section('contingut')

<div class="container mx-auto px-4 py-8 grid gap-8 md:grid-cols-3">

  <!-- Professionals Card -->
  <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col">
    <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Professionals</h2>
    <a href="{{ route('profesional.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Professionals</a>
    <a href="{{ route('profesional.create') }}" class="text-[#F97800] hover:underline">Alta Professionals</a>
  </div>

  <!-- Centres Card -->
  <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col">
    <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Centres</h2>
    <a href="{{ route('centers.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Centros</a>
    <a href="{{ route('centers.create') }}" class="text-[#F97800] hover:underline">Alta Centro</a>
  </div>

  <!-- Projectes Card -->
  <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col">
    <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Projectes i Comissions</h2>
    <a href="{{ route('projectes_comissions.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Projectes i comissions</a>
    <a href="{{ route('projectes_comissions.create') }}" class="text-[#F97800] hover:underline">Alta Projectes i comissions</a>
  </div>

</div>

@endsection
