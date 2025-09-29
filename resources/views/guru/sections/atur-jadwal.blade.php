<section id="atur-jadwal" class="min-h-screen px-6 py-16 bg-white">
  <div class="max-w-5xl mx-auto">
    <h2 class="text-3xl font-bold text-indigo-700 mb-6">Atur Jadwal</h2>
    <p class="text-gray-600 mb-8">Pilih angkatan & jurusan untuk menampilkan kelas.</p>

    <!-- Dropdown angkatan -->
    <div class="flex flex-wrap gap-4 mb-8">
      <select id="angkatan" class="border rounded-lg px-4 py-2">
        <option value="">-- Pilih Angkatan --</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
      </select>

      <button onclick="tampilkanKelas()" 
              class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
        Tampilkan Kelas
      </button>
    </div>

    <!-- Daftar kelas -->
    <div id="kelasContainer" class="grid grid-cols-2 md:grid-cols-3 gap-6 hidden"></div>
  </div>

  <!-- DETAIL JADWAL -->
  <div id="jadwal-detail" class="hidden mt-16">
    <h3 id="judulKelas" class="text-2xl font-bold text-indigo-700 mb-4"></h3>

    <!-- Form tambah -->
    <form id="formTambah" class="flex flex-wrap gap-3 mb-6">
      <select name="hari" class="border rounded px-3 py-2">
        <option>Senin</option><option>Selasa</option><option>Rabu</option>
        <option>Kamis</option><option>Jumat</option>
      </select>
      <input type="text" name="jam" placeholder="07.00 - 09.30" class="border rounded px-3 py-2">
      <input type="text" name="mapel" placeholder="Nama Mapel" class="border rounded px-3 py-2">
      <button type="button" onclick="tambahJadwal()"
              class="bg-green-600 text-white px-4 py-2 rounded-lg">➕ Tambah</button>
    </form>

    <!-- Tabel jadwal -->
    <div class="bg-white shadow rounded-xl overflow-hidden">
      <table class="w-full text-center" id="tabelJadwal">
        <thead class="bg-indigo-600 text-white">
          <tr><th class="px-4 py-2">Hari</th><th>Jam</th><th>Mata Pelajaran</th><th>Aksi</th></tr>
        </thead>
        <tbody>
          <tr><td colspan="4" class="py-4 text-gray-500">Belum ada jadwal</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  let kelasAktif = null;

  function tampilkanKelas() {
    const angkatan = document.getElementById('angkatan').value;
    const container = document.getElementById('kelasContainer');
    container.innerHTML = ""; // reset

    if (!angkatan) {
      alert("Pilih angkatan dulu!");
      return;
    }

    let kelasList = [];

    if (angkatan === "X") {
      kelasList = ["PPLG 1", "PPLG 2", "TJKT", "MPLB", "AKL"];
    } else if (angkatan === "XI" || angkatan === "XII") {
      kelasList = ["RPL 1", "RPL 1", "TKJ", "MP", "AK"];
    }

    kelasList.forEach(kls => {
      const btn = document.createElement("button");
      btn.innerText = `${angkatan} ${kls}`;
      btn.className = "block w-full bg-indigo-600 text-white text-center font-semibold py-6 rounded-xl shadow hover:bg-indigo-700 transition";
      btn.onclick = () => openJadwal(`${angkatan} ${kls}`);
      container.appendChild(btn);
    });

    container.classList.remove('hidden');
  }

  function openJadwal(kelas) {
    kelasAktif = kelas;
    document.getElementById('judulKelas').innerText = "Jadwal Kelas " + kelas;
    document.getElementById('jadwal-detail').classList.remove('hidden');
    document.getElementById('jadwal-detail').scrollIntoView({ behavior: "smooth" });
  }

  function tambahJadwal() {
    const form = document.getElementById('formTambah');
    const hari = form.hari.value;
    const jam = form.jam.value;
    const mapel = form.mapel.value;

    if (!hari || !jam || !mapel) return alert("Lengkapi semua field!");

    const tbody = document.querySelector('#tabelJadwal tbody');
    if (tbody.querySelector('td')?.innerText.includes("Belum ada")) tbody.innerHTML = "";

    const row = document.createElement('tr');
    row.className = "border hover:bg-indigo-50";
    row.innerHTML = `
      <td class="px-4 py-2">${hari}</td>
      <td>${jam}</td>
      <td>${mapel}</td>
      <td class="flex gap-2 justify-center py-2">
        <button onclick="editJadwal(this)" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️</button>
        <button onclick="hapusJadwal(this)" class="bg-red-600 text-white px-3 py-1 rounded">🗑️</button>
      </td>
    `;
    tbody.appendChild(row);

    form.reset();
  }

  function editJadwal(btn) {
    const row = btn.closest('tr');
    const mapel = prompt("Edit Mata Pelajaran:", row.children[2].innerText);
    if (mapel) row.children[2].innerText = mapel;
  }

  function hapusJadwal(btn) {
    if (confirm("Hapus jadwal ini?")) {
      btn.closest('tr').remove();
      const tbody = document.querySelector('#tabelJadwal tbody');
      if (tbody.children.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="py-4 text-gray-500">Belum ada jadwal</td></tr>`;
      }
    }
  }
</script>
