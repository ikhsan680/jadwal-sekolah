<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col relative">

  <!-- Latar belakang belah dua -->
  <div class="absolute top-0 left-0 w-1/2 h-full bg-white"></div>
  <div class="absolute top-0 right-0 w-1/2 h-full bg-indigo-600"></div>

  <!-- NAVBAR -->
  <header class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] max-w-6xl 
                 bg-white rounded-xl shadow-lg z-50">
    <div class="flex items-center justify-between px-6 py-4">
      <h1 class="font-extrabold text-2xl text-indigo-600">SmartJadwal</h1>
      <nav class="flex items-center pr-5">
        <a href="/index" class="text-gray-700 text-xl font-bold hover:text-indigo-600">Home</a>
      </nav>
    </div>
  </header>

  <!-- Konten -->
  <main class="flex flex-1 items-center justify-center relative z-10 mt-28">
    <div class="bg-white rounded-3xl shadow-[0_20px_40px_rgba(0,0,0,0.2)] p-12 w-[460px] text-center">
      <h1 class="text-indigo-700 font-extrabold text-3xl mb-8 border-b-4 border-indigo-400 pb-4">
        REGISTER SISWA
      </h1>

      <form action="{{ route('siswa.register.submit') }}" method="POST" class="space-y-6 text-left">
        @csrf

        <!-- Nama -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
          <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required
                 class="w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 
                        focus:border-indigo-500 bg-white shadow-sm">
        </div>

        <!-- Pilih Sekolah -->
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
        <div class="relative">
            <select name="sekolah" required
            class="appearance-none w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 
                    focus:border-indigo-500 bg-white shadow-sm pr-10">
            <option value="">-- Pilih Sekolah --</option>
            <option value="smk_fatahillah">SMK FATAHILLAH</option>
            </select>
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
            </div>
        </div>
        </div>

        <!-- NIS -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
          <input type="text" name="nis" placeholder="Nomor Induk Siswa" required
                 class="w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 
                        focus:border-indigo-500 bg-white shadow-sm">
        </div>

        <!-- Pilih Angkatan -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Angkatan</label>
          <select id="angkatanSelect" name="angkatan" required
            class="appearance-none w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-indigo-500 bg-white shadow-sm pr-10">
            <option value="">-- Pilih Angkatan --</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
          </select>
        </div>

        <!-- Pilih Kelas -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
          <select id="kelasSelect" name="kelas" required
            class="appearance-none w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-indigo-500 bg-white shadow-sm pr-10">
            <option value="">-- Pilih Kelas --</option>
          </select>
        </div>

        <!-- Tombol Register -->
        <button type="submit"
          class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg py-3 rounded-full shadow-lg transition transform hover:scale-105">
          REGISTER
        </button>
      </form>

      <!-- Link ke Login -->
      <p class="mt-6 text-center text-sm text-gray-600">
        Sudah punya akun? 
        <a href="{{ route('siswa.login') }}" class="text-indigo-600 font-semibold hover:underline">
          Login di sini
        </a>
      </p>
    </div>
  </main>

  <footer class="relative z-10 text-center text-black text-sm py-4">
    © 2025 <span class="font-semibold">SmartJadwal</span>. All rights reserved.
  </footer>

  <!-- Script untuk filter kelas -->
  <script>
    const kelasOptions = {
      X: ["X PPLG 1", "X PPLG 2", "X TJKT", "X MPLB", "X AKL"],
      XI: ["XI RPL 1", "XI RPL 2", "XI TKJ", "XI MP", "XI AK"],
      XII: ["XI RPL 1", "XI RPL 2", "XI TKJ", "XI MP", "XI AK"] 
    };

    const angkatanSelect = document.getElementById("angkatanSelect");
    const kelasSelect = document.getElementById("kelasSelect");

    angkatanSelect.addEventListener("change", function() {
      const angkatan = this.value;
      kelasSelect.innerHTML = '<option value="">-- Pilih Kelas --</option>';

      if (kelasOptions[angkatan]) {
        kelasOptions[angkatan].forEach(kls => {
          const option = document.createElement("option");
          option.value = kls;
          option.textContent = kls;
          kelasSelect.appendChild(option);
        });
      }
    });
  </script>
</body>
</html>
