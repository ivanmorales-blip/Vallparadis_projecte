@extends('layouts.template')

@section('contingut')

<div class="container mx-auto px-4 py-8 grid gap-8 md:grid-cols-3">

  <!-- Centres -->
  <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col">
    <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Centres</h2>
    <a href="{{ route('centers.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Centros</a>
    <a href="{{ route('centers.create') }}" class="text-[#F97800] hover:underline">Alta Centro</a>
  </div>

  <!-- Profesionals -->
  <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col">
    <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Professionals</h2>
    <a href="{{ route('profesional.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Professionals</a>
    <a href="{{ route('profesional.create') }}" class="text-[#F97800] hover:underline">Alta Professionals</a>
  </div>

  <!-- Projectes -->
<div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col mb-4">
  <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Projectes</h2>
  <a href="{{ route('projectes_comissions.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Projectes</a>
  <a href="{{ route('projectes_comissions.create') }}" class="text-[#F97800] hover:underline">Alta Projectes</a>
</div>

<!-- Comissions -->
<div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col">
  <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Comissions</h2>
  <a href="{{ route('projectes_comissions.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Comissions</a>
  <a href="{{ route('projectes_comissions.create') }}" class="text-[#F97800] hover:underline">Alta Comissions</a>
</div>




<!-- Gestión de Seguiments y Evaluacions -->
  <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col space-y-4">
      <h2 class="text-2xl text-gray-700 font-bold mb-2 border-b border-gray-300 pb-2">Gestió de Seguiments i Evaluacions</h2>

      <!-- Alta Seguiment -->
      <a href="{{ route('tracking.create') }}" 
        class="text-[#F97800] hover:underline text-lg font-medium">
          ➕ Donar d'alta Seguiment
      </a>

      <!-- Alta Avaluació -->
      <a href="{{ route('evaluation.create') }}" 
        class="text-[#F97800] hover:underline text-lg font-medium">
          ➕ Donar d'alta Avaluació
      </a>
  </div>

  <!-- Trainings Card -->
  <div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6 flex flex-col">
    <h2 class="text-2xl text-gray-700 font-bold mb-4 border-b border-gray-300 pb-2">Cursos</h2>
    <a href="{{ route('trainings.index') }}" class="text-[#F97800] hover:underline mb-2">Listar Curs</a>
    <a href="{{ route('trainings.create') }}" class="text-[#F97800] hover:underline">Alta Curs</a>
  </div>

</div>



@endsection
