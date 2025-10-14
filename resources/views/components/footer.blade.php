<footer class="flex items-center justify-between bg-gray-100 p-4 shadow-inner mt-8 w-full">
  <!-- Logo -->
  <div class="flex items-center">
    <a href="{{ url('/menu') }}">
      <img src="{{ asset('images/logo_1.png') }}" alt="Logo Vallparadis" class="h-[60px] w-auto" />
    </a>
  </div>

  <!-- Logout button -->
  <form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button
        type="submit"
        class="bg-[#F97800] text-white px-4 py-2 rounded hover:bg-[#cc6e00] transition"
        onclick="return confirm('Are you sure you want to log out?')"
    >
        Tancar sessió
    </button>
</form>
</footer>
