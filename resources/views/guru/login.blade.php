<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Guru</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-purple-200">

  <div class="bg-purple-50 rounded-2xl shadow-2xl p-10 text-center w-[420px] border border-purple-400">
    <h1 class="text-purple-700 font-extrabold text-3xl mb-8 border-b-2 border-purple-400 pb-3">
      LOGIN GURU
    </h1>

    <form action="#" method="POST" class="space-y-6">
      @csrf

      <!-- Username -->
      <div>
        <input type="text" placeholder="username"
          class="w-full text-base border-b-2 border-gray-400 px-3 py-3 
                 focus:outline-none focus:border-purple-600 bg-transparent">
      </div>

      <!-- Pilih Kelas -->
      <div class="relative">
        <select
          class="appearance-none w-full text-base border-b-2 border-gray-400 px-3 py-3 
                 focus:outline-none focus:border-purple-600 bg-transparent pr-10">
          <option value="">-- pilih sekolah --</option>
          <option value="x">SMK FATAHILLAH</option>
        </select>
        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
          <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </div>
      </div>

      <!-- Masukan Code + Toggle Mata -->
      <div class="relative">
        <input type="password" id="codeInput" placeholder="masukan code"
          class="w-full text-base border-b-2 border-gray-400 px-3 py-3 
                 focus:outline-none focus:border-purple-600 bg-transparent pr-12">
        
        <!-- Icon Mata -->
        <button type="button" id="toggleCode"
          class="absolute inset-y-0 right-3 flex items-center text-purple-600">
          <!-- Mata tertutup -->
          <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
               viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-10-7-10-7a19.8 19.8 0 014-4.2M9.88 9.88A3 3 0 0114.12 14.12M6.1 6.1L18 18"/>
          </svg>
          <!-- Mata terbuka (hidden dulu) -->
          <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
               viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
        </button>
      </div>

      <!-- Tombol Login -->
      <button type="submit"
        class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold text-lg py-3 rounded-full shadow-lg transition">
        LOGIN
      </button>
    </form>
  </div>

  <script>
    const codeInput = document.getElementById("codeInput");
    const toggleBtn = document.getElementById("toggleCode");
    const eyeClosed = document.getElementById("eyeClosed");
    const eyeOpen = document.getElementById("eyeOpen");

    toggleBtn.addEventListener("click", () => {
      if (codeInput.type === "password") {
        codeInput.type = "text";
        eyeClosed.classList.add("hidden");
        eyeOpen.classList.remove("hidden");
      } else {
        codeInput.type = "password";
        eyeClosed.classList.remove("hidden");
        eyeOpen.classList.add("hidden");
      }
    });
  </script>

</body>
</html>
