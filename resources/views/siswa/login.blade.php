<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col relative">

  <!-- Latar belakang belah dua -->
  <div class="absolute top-0 left-0 w-1/2 h-full bg-white"></div>
  <div class="absolute top-0 right-0 w-1/2 h-full bg-indigo-600"></div>

  <!-- NAVBAR MELAYANG -->
  <header class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] max-w-6xl 
                 bg-white rounded-xl shadow-lg z-50">
    <div class="flex items-center justify-between px-6 py-4">
      <!-- Logo -->
      <h1 class="font-extrabold text-2xl text-indigo-600">
        SmartJadwal
      </h1>

      <!-- Menu kanan -->
      <nav class="flex items-center pr-5">
        <a href="/index" class="text-gray-700 text-xl font-bold hover:text-indigo-600">
          Home
        </a>
      </nav>
    </div>
  </header>

  <!-- Konten utama -->
  <main class="flex flex-1 items-center justify-center relative z-10 mt-28">
    <div class="bg-white rounded-3xl shadow-[0_20px_40px_rgba(0,0,0,0.2)] p-12 w-[420px] text-center">
      <h1 class="text-indigo-700 font-extrabold text-3xl mb-8 border-b-4 border-indigo-400 pb-4">
        LOGIN SISWA
      </h1>

      <form action="#" method="POST" class="space-y-6 text-left">
        @csrf
        <!-- Username -->
        <div>
          <input type="text" placeholder="Username" 
                 class="w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 
                        focus:border-indigo-500 bg-white shadow-sm">
        </div>

        <!-- Dropdown Pilih Sekolah -->
        <div class="relative">
          <select 
            class="appearance-none w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-indigo-500 bg-white shadow-sm pr-10">
            <option value="">Pilih Sekolah</option>
            <option value="smk_fatahillah">SMK FATAHILLAH</option>
          </select>
          <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>

        <!-- Dropdown Pilih Kelas -->
        <div class="relative">
          <select 
            class="appearance-none w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-indigo-500 bg-white shadow-sm pr-10">
            <option value="">Pilih Kelas</option>
            <option value="x">X</option>
            <option value="xi">XI</option>
            <option value="xii">XII</option>
          </select>
          <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>

        <!-- Tombol Login -->
        <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg py-3 rounded-full shadow-lg transition transform hover:scale-105">
          LOGIN
        </button>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="relative z-10 text-center text-black text-sm py-4">
    © 2025 <span class="font-semibold text-black">SmartJadwal</span>. All rights reserved.
  </footer>

</body>
</html>
