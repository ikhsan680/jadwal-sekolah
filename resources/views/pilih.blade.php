<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Role</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col relative">

 <!-- KIRI -->
<div class="absolute top-0 left-0 w-1/2 h-full bg-white flex flex-col items-center justify-center p-10 text-center z-0">
  <div class="-translate-x-10"> <!-- geser isi aja -->
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" 
         alt="Siswa" 
         class="w-32 mb-6 opacity-90">
    <p class="text-gray-700 text-lg font-semibold">
      SISWA
    </p>
  </div>
</div>

<!-- KANAN -->
<div class="absolute top-0 right-0 w-1/2 h-full bg-indigo-600 flex flex-col items-center justify-center p-10 text-center z-0">
  <div class="translate-x-10"> <!-- geser isi aja -->
    <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" 
         alt="Guru" 
         class="w-32 mb-6 opacity-90">
    <p class="text-white text-lg font-semibold">
      GURU
    </p>
  </div>
</div>


  <!-- NAVBAR -->
  <header class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] max-w-6xl 
                 bg-white rounded-xl shadow-lg z-50">
    <div class="flex items-center justify-between px-6 py-4">
      <h1 class="font-extrabold text-2xl text-indigo-600">
        SmartJadwal
      </h1>
      <nav class="flex items-center pr-5">
        <a href="/index" class="text-gray-700 text-xl font-bold hover:text-indigo-600">
          Home
        </a>
      </nav>
    </div>
  </header>

  <!-- KONTEN UTAMA -->
  <main class="flex flex-1 items-center justify-center relative z-10 mt-28">
    <div class="bg-white rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.2)] p-12 w-[420px] text-center z-20">
      <h1 class="text-indigo-700 font-extrabold text-3xl mb-8 border-b-4 border-indigo-400 pb-4">
        PILIH ROLE
      </h1>

      <div class="space-y-6">
        <a href="{{ route('siswa.login') }}"
           class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 text-lg rounded-full shadow-lg transition transform hover:scale-105">
          SISWA
        </a>
        <a href="/guru/login"
           class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 text-lg rounded-full shadow-lg transition transform hover:scale-105">
          GURU
        </a>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="relative z-10 text-center text-black text-sm py-4">
    © 2025 <span class="font-semibold text-black">SmartJadwal</span>. All rights reserved.
  </footer>

</body>
</html>
