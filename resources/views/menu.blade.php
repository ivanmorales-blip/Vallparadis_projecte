<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <h1><a href="{{route('centers.index')}}">Listar centros</a></h1>
    <h1><a href="{{route('centers.create')}}"> Alta centro</a></h1>
    <h1><a href="{{route('profesional.index')}}">Listar Profesionals</a></h1>
    <h1><a href="{{route('profesional.create')}}"> Alta Profesionals</a></h1>
    <h1><a href="{{route('projectes_comissions.index')}}">Listar Projectes i comissions</a></h1>
    <h1><a href="{{route('projectes_comissions.create')}}"> Alta  Projectes i comissions</a></h1>
    <div class="text-center p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-4xl font-bold text-blue-600 mb-4">Hello, World!</h1>
    <p class="text-gray-700">If you see this styled text, Tailwind is working 🎉</p>
    <button class="mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
      Click Me
    </button>
  </div>
</body>
</html>