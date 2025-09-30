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

      <input type="time" name="jamMulai" class="border rounded px-3 py-2">
      <input type="time" name="jamSelesai" class="border rounded px-3 py-2">
      <input type="text" name="mapel" placeholder="Nama Mapel" class="border rounded px-3 py-2">
      <input type="text" name="guru" placeholder="Nama Guru" class="border rounded px-3 py-2">         

      <button type="button" onclick="tambahJadwal()"
              class="bg-green-600 text-white px-4 py-2 rounded-lg">➕ Tambah</button>
    </form>

    <!-- Tabel jadwal -->
    <div class="bg-white shadow rounded-xl overflow-hidden">
      <table class="w-full text-center" id="tabelJadwal">
        <thead class="bg-indigo-600 text-white">
          <tr><th class="px-4 py-2">Hari</th><th>Jam</th><th>Mata Pelajaran</th><th>Guru</th><th>Aksi</th></tr>
        </thead>
        <tbody>
          <tr><td colspan="5" class="py-4 text-gray-500">Belum ada jadwal</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  let kelasAktif = null;
  let jadwalData = {};

  function tampilkanKelas() {
    const angkatan = document.getElementById('angkatan').value;
    const container = document.getElementById('kelasContainer');
    container.innerHTML = "";

    if (!angkatan) {
      alert("Pilih angkatan dulu!");
      return;
    }

    let kelasList = [];

    if (angkatan === "X") {
      kelasList = ["PPLG 1", "PPLG 2", "TJKT", "MPLB", "AKL"];
    } else if (angkatan === "XI" || angkatan === "XII") {
      kelasList = ["RPL 1", "RPL 2", "TKJ", "MP", "AK"];
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

  // Encode biar spasi jadi %20
  fetch(`/api/jadwal/${encodeURIComponent(kelas)}`)
    .then(res => res.json())
    .then(data => {
      console.log("DATA DARI API:", data); // 👈 cek hasil
      jadwalData[kelas] = data;
      renderTabel();
    })
    .catch(err => console.error("ERROR API:", err));
}


  function renderTabel() {
    const tbody = document.querySelector('#tabelJadwal tbody');
    tbody.innerHTML = "";

    if (!jadwalData[kelasAktif] || jadwalData[kelasAktif].length === 0) {
      tbody.innerHTML = `<tr><td colspan="5" class="py-4 text-gray-500">Belum ada jadwal</td></tr>`;
      return;
    }

    jadwalData[kelasAktif].forEach((item, index) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${item.hari}</td>
        <td>${item.jam_mulai} - ${item.jam_selesai}</td>
        <td>${item.mapel}</td>
        <td>${item.guru}</td>
        <td class="flex gap-2 justify-center py-2">
          <button onclick="editJadwal(${item.id}, ${index})" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️</button>
          <button onclick="hapusJadwal(${item.id}, ${index})" class="bg-red-600 text-white px-3 py-1 rounded">🗑️</button>
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  function tambahJadwal() {
    const form = document.getElementById('formTambah');
    const data = {
      kelas: kelasAktif,
      hari: form.hari.value,
      jam_mulai: form.jamMulai.value,
      jam_selesai: form.jamSelesai.value,
      mapel: form.mapel.value,
      guru: form.guru.value
    };

    if (!data.hari || !data.jam_mulai || !data.jam_selesai || !data.mapel || !data.guru) {
      return alert("Lengkapi semua field!");
    }

    fetch('/api/jadwal', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
      if (!jadwalData[kelasAktif]) jadwalData[kelasAktif] = [];
      jadwalData[kelasAktif].push(res);
      renderTabel();
      form.reset();
    })
    .catch(err => console.error(err));
  }

  function editJadwal(id, index) {
    const mapelBaru = prompt("Edit Mata Pelajaran:", jadwalData[kelasAktif][index].mapel);
    if (mapelBaru) {
      fetch(`/api/jadwal/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mapel: mapelBaru })
      })
      .then(res => res.json())
      .then(res => {
        jadwalData[kelasAktif][index].mapel = res.mapel;
        renderTabel();
      })
      .catch(err => console.error(err));
    }
  }

  function hapusJadwal(id, index) {
    if (confirm("Hapus jadwal ini?")) {
      fetch(`/api/jadwal/${id}`, { method: 'DELETE' })
        .then(res => {
          if (res.ok) {
            jadwalData[kelasAktif].splice(index, 1);
            renderTabel();
          }
        })
        .catch(err => console.error(err));
    }
  }
</script>
