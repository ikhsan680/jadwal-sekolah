<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JadwalKu</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gradient-to-br from-indigo-100 via-white to-indigo-50 min-h-screen">

    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md">
        <div class="flex items-center justify-between px-6 py-4 max-w-5xl mx-auto">
            <button id="btnMenu" class="text-2xl focus:outline-none hover:scale-110 transition">☰</button>
            <h1 class="font-bold text-xl tracking-wide">JadwalKu</h1>
            <a href="#"
               class="px-3 py-1 rounded hover:bg-white/20 transition">
                Kontak
            </a>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar"
           class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-indigo-700 to-indigo-800 text-white p-6 transform -translate-x-full transition-transform duration-300 shadow-lg">
        <button id="btnClose"
                class="absolute -right-8 top-4 bg-indigo-700 w-9 h-9 rounded-r text-xl flex items-center justify-center hover:bg-indigo-800">
            ❮
        </button>
        <div class="flex flex-col items-center mt-8">
            <div class="text-6xl mb-3">👤</div>
            <p class="text-sm font-medium">Silakan Login</p>
            <a href="#"
               class="mt-5 w-full text-center py-2 bg-white/20 rounded-full hover:bg-white/30 transition">
                Masuk
            </a>
        </div>
    </aside>

    <!-- Konten -->
    <main class="max-w-3xl mx-auto px-6 mt-20 text-center">
        <h2 class="text-4xl md:text-5xl font-extrabold text-indigo-700 leading-snug drop-shadow">
            Selamat Datang <br>
            di Website <span class="text-purple-600">Jadwal Pelajaran</span> Sekolah
        </h2>
        <p class="mt-4 text-gray-700 text-base md:text-lg font-medium">
            Aplikasi praktis untuk mengecek jadwal belajar kamu.
        </p>
        <a href="/pilih"
           class="inline-block mt-8 px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-full shadow hover:shadow-lg hover:scale-105 transition">
            LOGIN
        </a>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        document.getElementById('btnMenu').addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });
        document.getElementById('btnClose').addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>
</body>
</html>
