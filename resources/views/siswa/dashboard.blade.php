<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Siswa - SmartJadwal</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="font-sans bg-gradient-to-br from-indigo-100 via-white to-indigo-50 min-h-screen">

  <!-- SIDEBAR -->
  <aside id="sidebar"
    class="fixed top-0 left-0 h-full w-2/5 sm:w-1/3 md:w-64 
           bg-gradient-to-b from-indigo-700 to-indigo-900 text-white p-6 
           transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl z-50">

    <button id="btnClose"
      class="absolute -right-8 top-4 bg-indigo-700 w-9 h-9 rounded-r text-xl flex items-center justify-center 
             hover:bg-indigo-800 hidden">❮</button>

    <div class="flex flex-col items-center mt-10">
      <div class="w-16 h-16 rounded-full bg-white text-indigo-800 flex items-center justify-center text-2xl shadow">
        👨‍🎓
      </div>
      <p class="mt-3 font-semibold">{{ $siswa->nama }}</p>
      <span class="text-sm opacity-80">Siswa</span>
    </div>

    <nav class="mt-8 space-y-3 w-full">
      <a href="#home" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 transition shadow">
        🏠 <span>Home</span>
      </a>
      <a href="#jadwal" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-indigo-500 transition">
        📅 <span>Jadwal Harian</span>
      </a>
    </nav>

    <form action="{{ route('siswa.logout') }}" method="POST" class="mt-10">
      @csrf
      <button type="submit"
        class="w-full py-2 bg-red-600 hover:bg-red-700 rounded-lg font-bold shadow">
        Logout
      </button>
    </form>
  </aside>

  <!-- KONTEN -->
  <div id="content" class="transition-all duration-300">

    <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md z-40">
      <div class="flex items-center justify-between px-4 sm:px-6 md:px-10 py-4 w-full">
        <div class="flex items-center gap-3">
          <button id="btnMenu" class="text-3xl focus:outline-none hover:scale-110 transition">☰</button>
          <h1 class="font-bold text-2xl md:text-3xl tracking-wide pl-2 md:pl-3">SmartJadwal</h1>
        </div>
      </div>
    </header>

    <div class="h-20"></div>

    <!-- HOME -->
    <section id="home"
      class="flex flex-col lg:flex-row justify-start items-center px-6 sm:px-10 lg:px-16 py-20 bg-indigo-50 text-left">
      <div class="flex-1 text-left">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-indigo-700 leading-tight mb-6">
          Halo, {{ $siswa->nama }} 👋
        </h1>
        <p class="text-gray-600 text-base sm:text-lg max-w-xl mb-8">
          Selamat datang di Dashboard Siswa.<br>
          Kamu bisa melihat jadwal harian dengan mudah.<br>
          Yuk semangat belajar 🚀
        </p>
        <a href="#jadwal"
          class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
          Lihat Jadwal Saya
        </a>
      </div>
    </section>

    <!-- JADWAL -->
    <section id="jadwal" class="px-4 sm:px-6 py-12 bg-indigo-50">
      <div class="max-w-6xl mx-auto space-y-6">
        <h2 class="text-3xl font-bold text-indigo-700 text-center">Jadwal Harian</h2>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-4 mb-4">
          <select id="angkatanSelect" class="border rounded-lg px-4 py-2 w-full sm:w-auto" onchange="loadKelas()">
            <option value="">-- Pilih Angkatan --</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
          </select>

          <select id="kelasSelect" class="border rounded-lg px-4 py-2 w-full sm:w-auto" onchange="tampilkanJadwal()">
            <option value="">-- Pilih Kelas --</option>
          </select>

          <button id="btnDownloadPDF"
            onclick="downloadPDF()" 
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition hidden w-full sm:w-auto">
            📄 Download PDF
          </button>
        </div>

        <div id="jadwalContainer" class="bg-white shadow-lg rounded-xl overflow-hidden">
          <div class="overflow-x-auto w-full">
            <table class="min-w-[600px] sm:min-w-full border-collapse text-center text-sm sm:text-base">
              <thead class="bg-indigo-600 text-white">
                <tr>
                  <th class="px-3 sm:px-4 py-2 sm:py-3">Senin</th>
                  <th class="px-3 sm:px-4 py-2 sm:py-3">Selasa</th>
                  <th class="px-3 sm:px-4 py-2 sm:py-3">Rabu</th>
                  <th class="px-3 sm:px-4 py-2 sm:py-3">Kamis</th>
                  <th class="px-3 sm:px-4 py-2 sm:py-3">Jumat</th>
                </tr>
              </thead>
              <tbody id="tbodyJadwal">
                <tr>
                  <td colspan="5" class="px-4 py-3 text-gray-500 text-sm sm:text-base">
                    Pilih angkatan dan kelas untuk menampilkan jadwal.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <footer class="text-center text-gray-500 text-sm py-6">
      © 2025 SmartJadwal. All rights reserved.
    </footer>
  </div>

  <!-- SCRIPT -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

  <script>
    const sidebar = document.getElementById('sidebar');
    const btnMenu = document.getElementById('btnMenu');
    const btnClose = document.getElementById('btnClose');
    const content = document.getElementById('content');

    btnMenu.addEventListener('click', () => {
      sidebar.classList.remove('-translate-x-full');
      btnClose.classList.remove('hidden');
      btnMenu.classList.add('hidden');
      if (window.innerWidth >= 768) content.classList.add('ml-64');
    });

    btnClose.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      btnClose.classList.add('hidden');
      btnMenu.classList.remove('hidden');
      content.classList.remove('ml-64');
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth < 768) content.classList.remove('ml-64');
    });

    const kelasPerAngkatan = {
      "X": ["PPLG 1", "PPLG 2", "TJKT", "MPLB", "AKL"],
      "XI": ["RPL 1", "RPL 2", "TKJ", "MP", "AK"],
      "XII": ["RPL 1", "RPL 2", "TKJ", "MP", "AK"]
    };

    function loadKelas() {
      const angkatan = document.getElementById('angkatanSelect').value;
      const kelasSelect = document.getElementById('kelasSelect');
      kelasSelect.innerHTML = `<option value="">-- Pilih Kelas --</option>`;
      if (!angkatan) return;
      kelasPerAngkatan[angkatan].forEach(kelas => {
        const opt = document.createElement("option");
        opt.value = `${angkatan} ${kelas}`;
        opt.text = `${angkatan} ${kelas}`;
        kelasSelect.appendChild(opt);
      });
    }

    async function tampilkanJadwal() {
      const kelas = document.getElementById('kelasSelect').value;
      const tbody = document.getElementById('tbodyJadwal');
      const btnDownload = document.getElementById('btnDownloadPDF');

      if (!kelas) {
        tbody.innerHTML = `<tr><td colspan="5" class="px-4 py-3 text-gray-500">Pilih angkatan dan kelas untuk menampilkan jadwal.</td></tr>`;
        btnDownload.classList.add("hidden");
        return;
      }

      try {
        const res = await fetch(`/api/jadwal/${encodeURIComponent(kelas)}`);
        const data = await res.json();
        if (!data.length) {
          tbody.innerHTML = `<tr><td colspan="5" class="px-4 py-3 text-gray-500">Belum ada jadwal untuk kelas ini.</td></tr>`;
          btnDownload.classList.add("hidden");
          return;
        }

        const hariList = ["Senin","Selasa","Rabu","Kamis","Jumat"];
        let html = `<tr>`;
        hariList.forEach(hari => {
          const jadwalHari = data.filter(j => j.hari === hari);
          if (jadwalHari.length) {
            html += `<td class="border px-4 py-3">`;
            jadwalHari.forEach(j => {
              const jamMulai = j.jam_mulai.slice(0,5).replace(":",".");
              const jamSelesai = j.jam_selesai.slice(0,5).replace(":",".");
              html += `${jamMulai}-${jamSelesai}<br>${j.mapel}<br><small>${j.guru || '-'}</small><hr class="my-1">`;
            });
            html += `</td>`;
          } else {
            html += `<td class="border px-4 py-3 text-gray-400">-</td>`;
          }
        });
        html += `</tr>`;
        tbody.innerHTML = html;
        btnDownload.classList.remove("hidden");

      } catch (err) {
        console.error(err);
        tbody.innerHTML = `<tr><td colspan="5" class="px-4 py-3 text-red-500">Gagal memuat jadwal.</td></tr>`;
        btnDownload.classList.add("hidden");
      }
    }

    async function downloadPDF() {
      const { jsPDF } = window.jspdf;
      const kelas = document.getElementById('kelasSelect').value;
      if (!kelas) { alert("Pilih kelas dulu!"); return; }

      const res = await fetch(`/api/jadwal/${encodeURIComponent(kelas)}`);
      const data = await res.json();
      const doc = new jsPDF("l", "pt", "a4");
      doc.setFontSize(18);
      doc.text(`Jadwal Harian ${kelas}`, 40, 40);

      const hariList = ["Senin","Selasa","Rabu","Kamis","Jumat"];
      let row = [];
      hariList.forEach(hari => {
        const jadwalHari = data.filter(j => j.hari === hari);
        if (jadwalHari.length) {
          let cell = "";
          jadwalHari.forEach(j => {
            const jamMulai = j.jam_mulai.slice(0,5).replace(":",".");
            const jamSelesai = j.jam_selesai.slice(0,5).replace(":",".");
            cell += `${jamMulai}-${jamSelesai}\n${j.mapel}\n${j.guru || '-'}\n\n`;
          });
          row.push(cell);
        } else row.push("-");
      });

      doc.autoTable({
        head: [hariList],
        body: [row],
        startY: 60,
        styles: { halign: "center", valign: "middle" },
        headStyles: { fillColor: [79, 70, 229] },
      });

      doc.save(`Jadwal-${kelas}.pdf`);
    }

    document.addEventListener("DOMContentLoaded", () => {
      const angkatan = "{{ $siswa->angkatan }}";
      const kelas = "{{ $siswa->angkatan }} {{ $siswa->kelas }}";
      document.getElementById('angkatanSelect').value = angkatan;
      loadKelas();
      document.getElementById('kelasSelect').value = kelas;
      tampilkanJadwal();
    });
  </script>
</body>
</html>
