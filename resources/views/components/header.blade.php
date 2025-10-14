
<header class="flex items-center justify-between bg-gray-100 p-4 shadow-md">
  <!-- Logo -->
  <div class="flex items-center">
    <a href="{{ url('/menu') }}">
      <img src="{{ asset('images/logo_1.png') }}" alt="Logo Vallparadis" class="h-[90px] w-auto" />
    </a>
  </div>

  <div class="flex-1"></div>

  <!-- Search bar -->
  <div class="ml-auto w-48 pr-4">
    <input 
      type="text" 
      placeholder="Cercar..." 
      class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>

  <!-- Logout button -->
  <button 
    class="bg-[#F97800] text-white px-4 py-2 rounded hover:bg-[#cc6e00] transition"
  >
    Tancar sessió
  </button>
</header>
