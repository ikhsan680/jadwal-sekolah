<section id="mata-pelajaran" class="px-6 py-12 bg-indigo-50">
  <div class="max-w-6xl mx-auto space-y-6">
    <h2 class="text-3xl font-bold text-indigo-700 text-center">Jadwal Harian</h2>

    <!-- Dropdown Angkatan -->
    <div class="flex justify-center gap-4 mb-4">
      <select id="angkatanSelect" class="border rounded-lg px-4 py-2" onchange="loadKelas()">
        <option value="">-- Pilih Angkatan --</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
      </select>

      <!-- Dropdown Kelas -->
      <select id="kelasSelect" class="border rounded-lg px-4 py-2" onchange="tampilkanJadwal()">
        <option value="">-- Pilih Kelas --</option>
      </select>
    </div>

    <!-- Tabel jadwal -->
    <div id="jadwalContainer" class="bg-white shadow-lg rounded-xl overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full border-collapse text-center">
          <thead class="bg-indigo-600 text-white">
            <tr>
              <th class="px-4 py-3">Senin</th>
              <th class="px-4 py-3">Selasa</th>
              <th class="px-4 py-3">Rabu</th>
              <th class="px-4 py-3">Kamis</th>
              <th class="px-4 py-3">Jumat</th>
            </tr>
          </thead>
          <tbody id="tbodyJadwal">
            <tr>
              <td colspan="5" class="px-4 py-3 text-gray-500">Pilih angkatan dan kelas untuk menampilkan jadwal.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
  // Data contoh kelas per angkatan, bisa diganti dari API
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

    if (!kelas) {
      tbody.innerHTML = `<tr>
        <td colspan="5" class="px-4 py-3 text-gray-500">Pilih angkatan dan kelas untuk menampilkan jadwal.</td>
      </tr>`;
      return;
    }

    try {
      const res = await fetch(`/api/jadwal/${encodeURIComponent(kelas)}`);
      const data = await res.json();

      if (!data.length) {
        tbody.innerHTML = `<tr>
          <td colspan="5" class="px-4 py-3 text-gray-500">Belum ada jadwal untuk kelas ini.</td>
        </tr>`;
        return;
      }

      const hariList = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"];
      let html = `<tr>`;
      hariList.forEach(hari => {
        const jadwalHari = data.filter(j => j.hari === hari);
        if (jadwalHari.length) {
          html += `<td class="border px-4 py-3">`;
          jadwalHari.forEach(j => {
            // format HH.MM
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

    } catch (err) {
      console.error(err);
      tbody.innerHTML = `<tr>
        <td colspan="5" class="px-4 py-3 text-red-500">Gagal memuat jadwal.</td>
      </tr>`;
    }
  }
</script>
