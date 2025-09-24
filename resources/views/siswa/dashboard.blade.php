<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
  <div class="bg-white p-6 rounded-xl shadow-lg w-[400px] text-center">
    <h1 class="text-2xl font-bold text-indigo-600 mb-4">
      Selamat Datang, {{ $siswa['username'] }}
    </h1>
    <p class="mb-2">Sekolah: {{ strtoupper($siswa['sekolah']) }}</p>
    <p class="mb-4">Kelas: {{ strtoupper($siswa['kelas']) }}</p>

    <form action="{{ route('siswa.logout') }}" method="POST">
      @csrf
      <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
        Logout
      </button>
    </form>
  </div>
</body>
</html>
