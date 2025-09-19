<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-purple-50">

    <div class="bg-purple-100 rounded-3xl shadow-2xl p-12 text-center w-[420px]">
        <h1 class="text-purple-700 font-extrabold text-3xl mb-8 border-b-4 border-purple-400 pb-4">
            PILIH ROLE
        </h1>

        <div class="space-y-6">
          
            <a href="/siswa/login" 
               class="block bg-purple-600 hover:bg-purple-700 text-white font-bold py-5 text-xl rounded-full shadow-lg transition transform hover:scale-105">
                SISWA
            </a>

            <a href="/guru/login" 
               class="block bg-purple-600 hover:bg-purple-700 text-white font-bold py-5 text-xl rounded-full shadow-lg transition transform hover:scale-105">
                GURU
            </a>
        </div>
    </div>

</body>
</html>