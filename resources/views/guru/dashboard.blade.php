<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru - SmartJadwal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="font-sans bg-gradient-to-br from-indigo-100 via-white to-indigo-50 min-h-screen">

  <!-- SIDEBAR -->
  <aside id="sidebar"
    class="fixed top-0 left-0 h-full w-2/5 sm:w-1/3 md:w-64 
           bg-gradient-to-b from-indigo-700 to-indigo-900 text-white p-6 
           transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl z-50">
    
    <button id="btnClose"
      class="absolute -right-8 top-4 bg-indigo-700 w-9 h-9 rounded-r text-xl flex items-center justify-center hover:bg-indigo-800 hidden">
      ❮
    </button>

    <div class="flex flex-col items-center mt-10">
      <div class="w-16 h-16 rounded-full bg-white text-indigo-800 flex items-center justify-center text-2xl shadow">
        👤
      </div>
      <p class="mt-3 font-semibold">{{ $guru->username }}</p>
      <span class="text-sm opacity-80">Guru</span>
    </div>

    <nav class="mt-8 space-y-3 w-full">
      <a href="#home" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 transition shadow">
        🏠 <span>Home</span>
      </a>
      <a href="#atur-jadwal" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-indigo-500 transition">
        📅 <span>Atur Jadwal</span>
      </a>
      <a href="#mata-pelajaran" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-indigo-500 transition">
        📖 <span>Mata Pelajaran</span>
      </a>
    </nav>

    <form action="{{ route('guru.logout') }}" method="POST" class="mt-10">
      @csrf
      <button type="submit"
        class="w-full py-2 bg-red-600 hover:bg-red-700 rounded-lg font-bold shadow">
        Logout
      </button>
    </form>
  </aside>

  <!-- KONTEN UTAMA -->
  <div id="content" class="transition-all duration-300">

    <!-- HEADER (FIXED NAVBAR) -->
    <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md z-40">
      <div class="flex items-center justify-between px-4 sm:px-6 md:px-10 py-4 w-full">
        <div class="flex items-center gap-3">
          <button id="btnMenu" class="text-3xl focus:outline-none hover:scale-110 transition">
            ☰
          </button>
          <h1 class="font-bold text-2xl md:text-3xl tracking-wide pl-2 md:pl-3">
            SmartJadwal
          </h1>
        </div>
      </div>
    </header>

    <!-- SPASI SUPAYA KONTEN TIDAK TERSEMBUNYI DI BAWAH NAVBAR -->
    <div class="h-20"></div>

    <!-- SECTION (TERISI DARI FILE LAIN) -->
    @include('guru.sections.home')
    @include('guru.sections.atur-jadwal')
    @include('guru.sections.mata-pelajaran')

    <!-- FOOTER -->
    <footer class="text-center text-gray-500 text-sm py-6 mt-10">
      © 2025 SmartJadwal. All rights reserved.
    </footer>
  </div>

  <!-- SCRIPT -->
  <script>
    const sidebar = document.getElementById('sidebar');
    const btnMenu = document.getElementById('btnMenu');
    const btnClose = document.getElementById('btnClose');
    const content = document.getElementById('content');

    btnMenu.addEventListener('click', () => {
      sidebar.classList.remove('-translate-x-full');
      btnClose.classList.remove('hidden');
      btnMenu.classList.add('hidden');

      // hanya geser konten di layar besar
      if (window.innerWidth >= 768) {
        content.classList.add('ml-64');
      }
    });

    btnClose.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      btnClose.classList.add('hidden');
      btnMenu.classList.remove('hidden');
      content.classList.remove('ml-64');
    });

    // reset posisi jika ukuran layar berubah
    window.addEventListener('resize', () => {
      if (window.innerWidth < 768) {
        content.classList.remove('ml-64');
      }
    });
  </script>

</body>
</html>
