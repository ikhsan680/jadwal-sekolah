<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru - SmartJadwal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gradient-to-br from-indigo-100 via-white to-indigo-50 min-h-screen">

  <!-- SIDEBAR -->
  <aside id="sidebar"
         class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-indigo-700 to-indigo-900 text-white p-6 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl z-50">
    <button id="btnClose"
            class="absolute -right-8 top-4 bg-indigo-700 w-9 h-9 rounded-r text-xl flex items-center justify-center hover:bg-indigo-800 hidden">
      ❮
    </button>
    <div class="flex flex-col items-center mt-10">
      <div class="text-6xl mb-3">👨‍🏫</div>
      <p class="text-sm font-medium opacity-90">Halo, {{ $guru->username }}</p>
      <form action="{{ route('guru.logout') }}" method="POST" class="mt-5 w-full">
        @csrf
        <button type="submit"
                class="w-full text-center py-2 bg-white/20 rounded-full hover:bg-white/30 transition">
          Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- KONTEN -->
  <div id="content" class="transition-all duration-300">

    <!-- HEADER -->
    <header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md">
      <div class="flex items-center justify-between px-10 py-4 w-full">
        <div class="flex items-center gap-3">
          <button id="btnMenu" class="text-3xl focus:outline-none hover:scale-110 transition">
            ☰
          </button>
          <h1 class="font-bold text-3xl tracking-wide pl-3">
            SmartJadwal Guru
          </h1>
        </div>
        <span class="font-bold text-lg mr-5">
          {{ $guru->sekolah }}
        </span>
      </div>
    </header>

    <!-- DASHBOARD UTAMA -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 mt-12">
      <h2 class="text-3xl font-bold text-gray-800 mb-6">
        Selamat Datang, {{ $guru->username }} 👋
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Card Jadwal -->
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-indigo-700 mb-3">📅 Jadwal Pelajaran</h3>
          <p class="text-gray-600 mb-4">Kelola jadwal pelajaran harian untuk kelas.</p>
          <a href="#"
             class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            Lihat Jadwal
          </a>
        </div>

        <!-- Card Tambah Jadwal -->
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-indigo-700 mb-3">➕ Tambah Jadwal</h3>
          <p class="text-gray-600 mb-4">Tambahkan jadwal pelajaran baru dengan cepat.</p>
          <a href="#"
             class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Tambah Jadwal
          </a>
        </div>

        <!-- Card Akun -->
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold text-indigo-700 mb-3">⚙️ Pengaturan Akun</h3>
          <p class="text-gray-600 mb-4">Perbarui informasi akun guru Anda.</p>
          <a href="#"
             class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
            Atur Akun
          </a>
        </div>

      </div>
    </section>

    <!-- FOOTER -->
    <footer class="mt-24 text-center text-gray-500 text-sm py-6">
      © 2025 SmartJadwal. All rights reserved.
    </footer>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const btnMenu = document.getElementById('btnMenu');
    const btnClose = document.getElementById('btnClose');
    const content = document.getElementById('content');

    btnMenu.addEventListener('click', () => {
      sidebar.classList.remove('-translate-x-full');
      btnClose.classList.remove('hidden');
      btnMenu.classList.add('hidden');
      content.classList.add('ml-64');
    });

    btnClose.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      btnClose.classList.add('hidden');
      btnMenu.classList.remove('hidden');
      content.classList.remove('ml-64');
    });
  </script>

</body>
</html>
