<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>
<body>
    <header class="flex items-center justify-between bg-gray-100 p-4 shadow-md">
  <!-- Logo -->
  <div class="flex items-center">
    <img src="{{ asset('images/logo_1.png') }}" alt="Logo Vallparadis" class="h-[90px] w-auto"/>
  </div>

  <!-- Search bar -->
  <div class="flex-grow max-w-xl mx-4">
    <input 
      type="text" 
      placeholder="Search..." 
      class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>

  <!-- Logout button -->
  <button 
    class="bg-[#F97800] text-white px-4 py-2 rounded hover:bg-red-600 transition"
  >
    Logout
  </button>
    </header>

    <h1><a href="{{route('centers.index')}}">Listar centros</a></h1>
    <h1><a href="{{route('centers.create')}}"> Alta centro</a></h1>
    <h1><a href="{{route('profesional.index')}}">Listar Profesionals</a></h1>
    <h1><a href="{{route('profesional.create')}}"> Alta Profesionals</a></h1>
    <h1><a href="{{route('projectes_comissions.index')}}">Listar Projectes i comissions</a></h1>
    <h1><a href="{{route('projectes_comissions.create')}}"> Alta  Projectes i comissions</a></h1>
</body>
</html>