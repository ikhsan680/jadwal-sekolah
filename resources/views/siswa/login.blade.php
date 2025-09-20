<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-purple-200">

    <div class="bg-purple-50 rounded-2xl shadow-2xl p-10 text-center w-[400px]">
        <h1 class="text-purple-700 font-extrabold text-3xl mb-8 border-b-2 border-purple-400 pb-3">
            LOGIN SISWA
        </h1>

        <form action="#" method="POST" class="space-y-6">
            @csrf
            <!-- Username -->
            <div>
                <input type="text" placeholder="username" 
                    class="w-full text-base border border-purple-300 rounded-lg px-4 py-3 
                           focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white shadow-sm">
            </div>

            <!-- Dropdown Pilih Sekolah -->
            <div class="relative">
                <select 
                    class="appearance-none w-full text-base border border-purple-300 rounded-lg px-4 py-3 
                           focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                           bg-white shadow-sm pr-10">
                    <option value="">pilih sekolah</option>
                    <option value="smk_fatahillah">SMK FATAHILLAH</option>
                </select>
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Dropdown Pilih Kelas -->
            <div class="relative">
                <select 
                    class="appearance-none w-full text-base border border-purple-300 rounded-lg px-4 py-3 
                           focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 
                           bg-white shadow-sm pr-10">
                    <option value="">pilih kelas</option>
                    <option value="x">X</option>
                    <option value="xi">XI</option>
                    <option value="xii">XII</option>
                </select>
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Tombol Login -->
            <button type="submit" 
                class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold text-lg py-3 rounded-full shadow-lg transition">
                LOGIN
            </button>
        </form>
    </div>

</body>
</html>
  