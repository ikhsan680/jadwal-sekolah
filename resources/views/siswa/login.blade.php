<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col relative bg-white overflow-x-hidden">

  <!-- LATAR BELAKANG DUA SISI -->
  <div class="fixed inset-0 flex -z-10">
    <div class="w-1/2 bg-white h-full"></div>
    <div class="w-1/2 bg-indigo-600 h-full"></div>
  </div>

  <!-- NAVBAR (tidak fixed) -->
  <header class="w-[90%] max-w-6xl bg-white rounded-xl shadow-lg z-10 mx-auto mt-6">
    <div class="flex items-center justify-between px-6 py-4">
      <h1 class="font-extrabold text-2xl text-indigo-600">SmartJadwal</h1>
      <nav class="flex items-center pr-5">
        <a href="/index" class="text-gray-700 text-xl font-bold hover:text-indigo-600 transition">Home</a>
      </nav>
    </div>
  </header>

  <!-- KONTEN UTAMA -->
  <main class="flex flex-1 items-center justify-center relative z-10 px-4 sm:px-6 md:px-0 py-12">
    <div class="bg-white rounded-3xl shadow-[0_20px_40px_rgba(0,0,0,0.2)] 
                p-8 sm:p-10 md:p-12 w-full max-w-[420px] text-center">
      <h1 class="text-indigo-700 font-extrabold text-2xl sm:text-3xl mb-8 border-b-4 border-indigo-400 pb-4">
        LOGIN SISWA
      </h1>

      <form action="{{ route('siswa.login.submit') }}" method="POST" class="space-y-6 text-left">
        @csrf

        <!-- NAMA LENGKAP -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
          <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required
            class="w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-indigo-500 bg-white shadow-sm">
        </div>

        <!-- NIS -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
          <input type="text" name="nis" placeholder="Masukkan NIS" required
            class="w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 
                   focus:border-indigo-500 bg-white shadow-sm">
        </div>

        <!-- SEKOLAH -->
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

        <!-- ANGKATAN -->
        <div>
          <label for="angkatanSelect" class="block text-sm font-medium text-gray-700 mb-1">Angkatan</label>
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

        <!-- KELAS -->
        <div>
          <label for="kelasSelect" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
          <select id="kelasSelect" name="kelas" required
            class="appearance-none w-full text-base border border-indigo-300 rounded-lg px-4 py-3 
                  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                  focus:border-indigo-500 bg-white shadow-sm pr-10">
            <option value="">-- Pilih Kelas --</option>
          </select>
        </div>

        <!-- TOMBOL LOGIN -->
        <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg py-3 
                       rounded-full shadow-lg transition transform hover:scale-105">
          LOGIN
        </button>
      </form>

      <p class="mt-6 text-center text-sm text-gray-600">
        Belum punya akun? 
        <a href="{{ route('siswa.register') }}" class="text-indigo-600 font-semibold hover:underline">
          Register di sini
        </a>
      </p>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="relative z-10 text-center text-black text-sm py-4">
    © 2025 <span class="font-semibold text-black">SmartJadwal</span>. All rights reserved.
  </footer>

  <!-- SCRIPT UNTUK ANGGATAN & KELAS -->
  <script>
    const kelasOptions = {
      X: ["X PPLG 1", "X PPLG 2", "X TJKT", "X MPLB", "X AKL"],
      XI: ["XI RPL 1", "XI RPL 2", "XI TKJ", "XI MP", "XI AK"],
      XII: ["XII RPL 1", "XII RPL 2", "XII TKJ", "XII MP", "XII AK"]
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
