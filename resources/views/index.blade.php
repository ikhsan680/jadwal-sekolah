<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartJadwal</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="text-6xl mb-3">👤</div>
    <p class="text-sm font-medium opacity-90">Silakan Login</p>
    <a href="/pilih"
       class="mt-5 w-full text-center py-2 bg-white/20 rounded-full hover:bg-white/30 transition">
      Masuk
    </a>
  </div>
</aside>


  <!-- SEMUA KONTEN -->
  <div id="content" class="transition-all duration-300">

    <!-- HEADER -->
<header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md">
  <div class="flex items-center justify-between px-4 sm:px-6 md:px-10 py-4 w-full">
    <div class="flex items-center gap-3">
      <button id="btnMenu" class="text-3xl focus:outline-none hover:scale-110 transition">
        ☰
      </button>
      <h1 class="font-bold text-2xl md:text-3xl tracking-wide pl-2 md:pl-3">
        SmartJadwal
      </h1>
    </div>
    <a href="/kontak"
       class="font-bold text-lg md:text-xl px-3 py-2 rounded hover:bg-white/20 transition pr-6 md:pr-10">
      Kontak
    </a>
  </div>
</header>


    <!-- HERO -->
    <section id="hero"
             class="max-w-7xl mx-auto px-6 lg:px-12 mt-16 lg:mt-24">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- TEKS -->
        <div class="text-left pl-4">
          <p class="uppercase text-indigo-600 font-semibold tracking-wide mb-3">
            Jadwal Sekolah Digital
          </p>
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
            Cek Jadwal Pelajaran <br>
            Lebih Cepat & Praktis
          </h2>
          <p class="mt-5 text-gray-700 text-lg max-w-xl">
            SmartJadwal membantu siswa melihat jadwal pelajaran setiap hari
            dan memudahkan guru untuk menambah atau mengubah jadwal dengan mudah.
          </p>
          <div class="mt-8 flex gap-4">
            <a href="/pilih"
               class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded shadow transition">
              Coba Sekarang
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- FITUR -->
    <section id="features" class="max-w-7xl mx-auto px-6 lg:px-12 mt-20 md:mt-24">
      <h3 class="text-2xl md:text-3xl font-bold text-center text-gray-900 mb-12">
        Mengapa Memilih SmartJadwal?
      </h3>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 text-center">
        <div class="flex flex-col items-center">
          <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-600 text-white mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2 .895 2 2 2 2-.895 2-2zm0 0v3m0 4h.01M6 20h12a2 2 0 002-2V8l-8-4-8 4v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h4 class="text-lg font-semibold mb-2">Akses Cepat & Real-Time</h4>
          <p class="text-gray-600 text-sm md:text-base">
            Siswa dapat melihat jadwal pelajaran secara langsung tanpa menunggu update manual.
          </p>
        </div>
        <!-- Fitur 2 -->
<div class="flex flex-col items-center">
  <div class="w-12 h-12 flex items-center justify-center rounded-full bg-yellow-500 text-white mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  </div>
  <h4 class="text-lg font-semibold mb-2">Manajemen Jadwal</h4>
  <p class="text-gray-600 text-sm md:text-base">
    Atur jadwal pelajaran kapan saja, di mana saja, dengan antarmuka yang sederhana.
  </p>
</div>

<!-- Fitur 3 -->
<div class="flex flex-col items-center">
  <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-500 text-white mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>
  </div>
  <h4 class="text-lg font-semibold mb-2">Input Jadwal Mudah</h4>
  <p class="text-gray-600 text-sm md:text-base">
    Guru bisa menambah atau memperbarui jadwal pelajaran dengan cepat tanpa rumit.
  </p>
</div>

<!-- Fitur 4 -->
<div class="flex flex-col items-center">
  <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-800 text-white mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 7h18M3 12h18M3 17h18" />
    </svg>
  </div>
  <h4 class="text-lg font-semibold mb-2">Tampilan Modern</h4>
  <p class="text-gray-600 text-sm md:text-base">
    Antarmuka elegan yang mudah digunakan baik di komputer maupun ponsel.
  </p>
</div>

      </div>
    </section>

    <!-- FOOTER -->
    <footer class="mt-16 md:mt-24 text-center text-gray-500 text-sm py-6">
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

      // Geser konten hanya di layar besar
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

    // Pastikan ketika resize dari besar ke kecil, content tidak tergeser
    window.addEventListener('resize', () => {
      if (window.innerWidth < 768) {
        content.classList.remove('ml-64');
      }
    });
  </script>

</body>
</html>
