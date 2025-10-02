<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Guru</title>
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
        LOGIN GURU
      </h1>

      {{-- TAMPILKAN PESAN ERROR/SUKSES --}}
      @if (session('success'))
        <div class="mb-4 text-green-600 font-semibold">
          {{ session('success') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="mb-4 text-red-600">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form action="{{ route('guru.login.submit') }}" method="POST" class="space-y-6 text-left">
        @csrf

        <!-- Username -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
          <input type="text" id="username" name="username" placeholder="Username" required
            value="{{ old('username') }}"
            class="w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-indigo-500 bg-white shadow-sm">
        </div>

        <!-- Pilih Sekolah -->
        <div>
          <label for="sekolah" class="block text-sm font-medium text-gray-700 mb-1">Pilih Sekolah</label>
          <div class="relative">
            <select id="sekolah" name="sekolah" required
              class="appearance-none w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                     focus:outline-none focus:ring-2 focus:ring-indigo-500 
                     focus:border-indigo-500 bg-white shadow-sm pr-10">
              <option value="">-- Pilih Sekolah --</option>
              <option value="smk_fatahillah" {{ old('sekolah')=='smk_fatahillah' ? 'selected' : '' }}>SMK FATAHILLAH</option>
            </select>
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Masukan NIP + Toggle Mata -->
        <div>
          <label for="nipInput" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
          <div class="relative">
            <input type="password" id="nipInput" name="nip" placeholder="Masukan NIP" required
              value="{{ old('nip') }}"
              class="w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                     focus:outline-none focus:ring-2 focus:ring-indigo-500 
                     focus:border-indigo-500 bg-white shadow-sm pr-12">
            <!-- Icon Mata -->
            <button type="button" id="toggleNip"
              class="absolute inset-y-0 right-3 flex items-center text-indigo-600">
              <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-10-7-10-7a19.8 19.8 0 014-4.2M9.88 9.88A3 3 0 0114.12 14.12M6.1 6.1L18 18"/>
              </svg>
              <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Tombol Login -->
        <button type="submit"
          class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg py-3 rounded-full shadow-lg transition transform hover:scale-105">
          LOGIN
        </button>
      </form>

      <!-- Tambahkan link register -->
      <p class="mt-6 text-center text-sm text-gray-600">
        Belum punya akun? 
        <a href="{{ route('guru.register') }}" class="text-indigo-600 font-semibold hover:underline">
          Register di sini
        </a>
      </p>
    </div>
  </main>

  <!-- Footer -->
  <footer class="relative z-10 text-center text-black text-sm py-4">
    © 2025 <span class="font-semibold text-black">SmartJadwal</span>. All rights reserved.
  </footer>

  <script>
    const nipInput = document.getElementById("nipInput");
    const toggleBtn = document.getElementById("toggleNip");
    const eyeClosed = document.getElementById("eyeClosed");
    const eyeOpen = document.getElementById("eyeOpen");

    toggleBtn.addEventListener("click", () => {
      if (nipInput.type === "password") {
        nipInput.type = "text";
        eyeClosed.classList.add("hidden");
        eyeOpen.classList.remove("hidden");
      } else {
        nipInput.type = "password";
        eyeClosed.classList.remove("hidden");
        eyeOpen.classList.add("hidden");
      }
    });
  </script>

</body>
</html>