<section id="atur-jadwal" class="px-4 sm:px-6 py-8 sm:py-10 bg-indigo-50">
  <div class="max-w-6xl mx-auto space-y-8">

    <div class="max-w-5xl mx-auto">
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-indigo-700 mb-4 sm:mb-6 text-center md:text-left">
        Atur Jadwal
      </h2>
      <p class="text-gray-600 mb-6 sm:mb-8 text-center md:text-left">
        Pilih angkatan untuk menampilkan kelas.
      </p>

      <!-- Dropdown angkatan -->
      <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 sm:gap-4 mb-8 justify-center md:justify-start">
        <select id="angkatan"
          class="border rounded-lg px-4 py-2 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-indigo-500"
          onchange="tampilkanKelas()">
          <option value="">-- Pilih Angkatan --</option>
          <option value="all">Semua Angkatan</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
      </div>

      <!-- Daftar kelas -->
      <div id="kelasContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 hidden"></div>
    </div>

    <!-- DETAIL JADWAL -->
    <div id="jadwal-detail" class="hidden mt-12 sm:mt-16">
      <h3 id="judulKelas" class="text-xl sm:text-2xl font-bold text-indigo-700 mb-4 text-center md:text-left"></h3>

      <!-- Filter Hari -->
      <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4 mb-6">
        <label class="font-semibold">Filter Hari:</label>
        <select id="filterHari"
          class="border rounded px-3 py-2 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-indigo-500"
          onchange="renderTabel()">
          <option value="">Semua</option>
          <option>Senin</option>
          <option>Selasa</option>
          <option>Rabu</option>
          <option>Kamis</option>
          <option>Jumat</option>
        </select>
      </div>

      <!-- Form tambah -->
      <form id="formTambah"
        class="flex flex-col sm:flex-wrap sm:flex-row gap-3 mb-6 bg-white p-4 sm:p-5 rounded-lg shadow-sm border border-indigo-100">
        <select name="hari"
          class="border rounded px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-indigo-500">
          <option>Senin</option>
          <option>Selasa</option>
          <option>Rabu</option>
          <option>Kamis</option>
          <option>Jumat</option>
        </select>

        <input type="time" name="jamMulai"
          class="border rounded px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-indigo-500">
        <input type="time" name="jamSelesai"
          class="border rounded px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-indigo-500">
        <input type="text" name="mapel"
          placeholder="Mata Pelajaran / Kegiatan"
          class="border rounded px-3 py-2 w-full sm:w-auto flex-1 focus:ring-2 focus:ring-indigo-500">
        <input type="text" name="guru"
          placeholder="Nama Guru (opsional)"
          class="border rounded px-3 py-2 w-full sm:w-auto flex-1 focus:ring-2 focus:ring-indigo-500">

        <button type="button" onclick="tambahJadwal()"
          class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition w-full sm:w-auto">
          ➕ Tambah
        </button>
      </form>

      <!-- Jadwal -->
      <div id="jadwalContainer" class="space-y-6 overflow-x-auto"></div>
    </div>
  </div>
</section>

<!-- Modal Edit -->
<div id="modalEdit"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden p-4 sm:p-0">
  <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-lg overflow-y-auto max-h-[90vh]">
    <h3 class="text-xl sm:text-2xl font-bold mb-4 text-indigo-700 text-center sm:text-left">Edit Jadwal</h3>
    <form id="formEdit" class="space-y-4">
      <input type="hidden" name="id">

      <div>
        <label class="block font-semibold mb-1">Hari</label>
        <select name="hari"
          class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500">
          <option>Senin</option><option>Selasa</option><option>Rabu</option>
          <option>Kamis</option><option>Jumat</option>
        </select>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block font-semibold mb-1">Jam Mulai</label>
          <input type="time" name="jamMulai"
            class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block font-semibold mb-1">Jam Selesai</label>
          <input type="time" name="jamSelesai"
            class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500">
        </div>
      </div>

      <div>
        <label class="block font-semibold mb-1">Mata Pelajaran / Kegiatan</label>
        <input type="text" name="mapel"
          class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500">
      </div>

      <div>
        <label class="block font-semibold mb-1">Nama Guru (opsional)</label>
        <input type="text" name="guru"
          class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500">
      </div>

      <div class="hidden">
        <label class="block font-semibold mb-1">Terapkan perubahan ke:</label>
        <select name="aksi"
          class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500">
          <option value="satu">Hanya kelas ini</option>
          <option value="massal">Semua kelas (massal)</option>
        </select>
      </div>

      <div class="flex flex-col sm:flex-row justify-end gap-3 mt-4">
        <button type="button" onclick="closeModal()"
          class="px-4 py-2 rounded bg-gray-400 text-white hover:bg-gray-500 w-full sm:w-auto">Batal</button>
        <button type="button" onclick="updateJadwal()"
          class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 w-full sm:w-auto">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="https://unpkg.com/feather-icons"></script>
<script>
  let kelasAktif = null;
  let jadwalData = {};
  let editIndex = null;

  function tampilkanKelas() {
    const angkatan = document.getElementById('angkatan').value;
    const container = document.getElementById('kelasContainer');
    const detail = document.getElementById('jadwal-detail');
    container.innerHTML = "";

    if (!detail.classList.contains("hidden")) {
      detail.classList.remove("animate__fadeInUp");
      detail.classList.add("animate__fadeOutDown");
      setTimeout(() => {
        detail.classList.add("hidden");
        detail.classList.remove("animate__fadeOutDown");
      }, 400);
    }

    if (!angkatan) {
      container.classList.add('hidden');
      return;
    }

    let kelasList = [];
    if (angkatan === "X") {
      kelasList = ["PPLG 1", "PPLG 2", "TJKT", "MPLB", "AKL"];
    } else if (angkatan === "XI" || angkatan === "XII") {
      kelasList = ["RPL 1", "RPL 2", "TKJ", "MP", "AK"];
    } else if (angkatan === "all") {
      kelasList = ["SEMUA KELAS"]; // untuk jadwal massal
    }

    container.classList.remove('hidden');
    container.classList.add("animate__animated", "animate__fadeInDown", "animate__faster");

    kelasList.forEach((kls, i) => {
      const btn = document.createElement("button");
      btn.innerText = angkatan === "all" ? "Semua Angkatan" : `${angkatan} ${kls}`;
      btn.className = "block w-full bg-indigo-600 text-white text-center font-semibold py-6 rounded-xl shadow hover:bg-indigo-700 transition opacity-0";
      
      setTimeout(() => {
        btn.classList.add("animate__animated", "animate__fadeInUp");
        btn.classList.remove("opacity-0");
      }, i * 150);

      btn.onclick = () => openJadwal(btn.innerText);
      container.appendChild(btn);
    });
  }

  function openJadwal(kelas) {
    kelasAktif = kelas;
    const detail = document.getElementById('jadwal-detail');
    const judul = document.getElementById('judulKelas');
    judul.innerText = "Jadwal " + kelas;

    detail.classList.remove("animate__fadeInUp", "animate__fadeOutDown");
    detail.classList.remove('hidden');
    detail.classList.add("animate__animated", "animate__fadeInUp", "animate__faster");

    fetch(`/api/jadwal/${encodeURIComponent(kelas)}`)
      .then(res => res.json())
      .then(data => {
        jadwalData[kelas] = data;
        renderTabel();
        detail.style.animationDuration = "0.7s";
      })
      .catch(err => console.error("ERROR API:", err));
  }

  // ✅ FIXED renderTabel
  function renderTabel() {
    const container = document.getElementById('jadwalContainer');
    container.innerHTML = "";

    if (!jadwalData[kelasAktif] || jadwalData[kelasAktif].length === 0) {
      container.innerHTML = `<p class="text-gray-500">Belum ada jadwal</p>`;
      return;
    }

    const filterHari = document.getElementById('filterHari').value;
    const grouped = {};
    jadwalData[kelasAktif].forEach(item => {
      if (!filterHari || item.hari === filterHari) {
        if (!grouped[item.hari]) grouped[item.hari] = [];
        grouped[item.hari].push(item);
      }
    });

    const urutanHari = ["Senin","Selasa","Rabu","Kamis","Jumat"];

    urutanHari.forEach(hari => {
      if (grouped[hari]) {
        const card = document.createElement("div");
        card.className = "bg-white shadow rounded-xl p-4";

        let html = `<h4 class="font-bold text-indigo-700 mb-2">${hari}</h4>`;
        html += `
          <table class="w-full text-center border">
            <thead class="bg-indigo-600 text-white">
              <tr>
                <th>Jam</th>
                <th>Mata Pelajaran / Kegiatan</th>
                <th>Guru</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
        `;

        grouped[hari].forEach((item) => {
          const mulai = item.jam_mulai.slice(0, 5);
          const selesai = item.jam_selesai.slice(0, 5);
          const globalIndex = jadwalData[kelasAktif].findIndex(i => i.id === item.id);

          html += `
          <tr>
            <td>${mulai} - ${selesai}</td>
            <td>${item.mapel}</td>
            <td>${item.guru ? item.guru : "-"}</td>
            <td class="flex gap-2 justify-center py-2">
              <button onclick="openEdit(${item.id}, ${globalIndex})" 
                      class="bg-yellow-500 text-white p-2 rounded flex items-center justify-center">
                <i data-feather="edit"></i>
              </button>
              <button onclick="hapusJadwal(${item.id}, ${globalIndex})" 
                      class="bg-red-600 text-white p-2 rounded flex items-center justify-center">
                <i data-feather="trash-2"></i>
              </button>
            </td>
          </tr>
        `;
        });

        html += "</tbody></table>";
        card.innerHTML = html;
        container.appendChild(card);
      }
    });
    feather.replace();
  }

  function tambahJadwal() {
    const form = document.getElementById('formTambah');
    const data = {
      kelas: kelasAktif,
      hari: form.hari.value,
      jam_mulai: form.jamMulai.value,
      jam_selesai: form.jamSelesai.value,
      mapel: form.mapel.value,
      guru: form.guru.value || ""
    };

    if (!data.hari || !data.jam_mulai || !data.jam_selesai || !data.mapel) {
      return Swal.fire("Gagal", "Lengkapi semua field (guru opsional)!", "error");
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
      Swal.fire("Sukses", "Jadwal berhasil ditambahkan!", "success");
    })
    .catch(err => console.error(err));
  }

  // ✅ FIXED openEdit
  function openEdit(id, index) {
    const idx = (typeof index === 'number' && index >= 0) ? index : jadwalData[kelasAktif].findIndex(i => i.id === id);
    if (idx === -1) { console.error('Item jadwal tidak ditemukan', id); return; }

    editIndex = idx;
    const item = jadwalData[kelasAktif][idx];
    const form = document.getElementById('formEdit');
    
    form.id.value = item.id;
    form.hari.value = item.hari;
    form.jamMulai.value = item.jam_mulai;
    form.jamSelesai.value = item.jam_selesai;
    form.mapel.value = item.mapel;
    form.guru.value = item.guru || "";

    const aksiField = form.querySelector('[name="aksi"]').parentElement;
    if (item.is_massal || item.massal) {
      aksiField.classList.remove('hidden');
    } else {
      aksiField.classList.add('hidden');
    }

    document.getElementById('modalEdit').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modalEdit').classList.add('hidden');
  }

  // ✅ FIXED updateJadwal
  function updateJadwal() {
    const form = document.getElementById('formEdit');
    const data = {
      id: form.id.value,
      kelas: kelasAktif,
      hari: form.hari.value,
      jam_mulai: form.jamMulai.value,
      jam_selesai: form.jamSelesai.value,
      mapel: form.mapel.value,
      guru: form.guru.value || "",
      aksi: form.aksi.value
    };

    fetch(`/api/jadwal/${data.id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
      const idx = jadwalData[kelasAktif].findIndex(i => i.id == res.id);
      if (idx !== -1) jadwalData[kelasAktif][idx] = res;
      renderTabel();
      closeModal();
      Swal.fire("Sukses", "Jadwal berhasil diperbarui!", "success");
    })
    .catch(err => console.error(err));
  }

  // ✅ FIXED hapusJadwal
  function hapusJadwal(id, index) {
    const idx = (typeof index === 'number' && index >= 0) ? index : jadwalData[kelasAktif].findIndex(i => i.id === id);
    if (idx === -1) { console.error('Item jadwal tidak ditemukan', id); return; }

    const item = jadwalData[kelasAktif][idx];

    if (item.is_massal || item.massal) {
      Swal.fire({
        title: "Hapus jadwal?",
        text: "Pilih apakah hapus hanya kelas ini atau semua kelas.",
        icon: "warning",
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonText: "Hanya kelas ini",
        denyButtonText: "Semua kelas (massal)",
        cancelButtonText: "Batal"
      }).then((result) => {
        let aksi = null;
        if (result.isConfirmed) aksi = "satu";
        if (result.isDenied) aksi = "massal";

        if (aksi) {
          fetch(`/api/jadwal/${id}?aksi=${aksi}`, { method: 'DELETE' })
            .then(res => {
              if (res.ok) {
                jadwalData[kelasAktif] = jadwalData[kelasAktif].filter(i => i.id !== id);
                renderTabel();
                Swal.fire("Terhapus!", "Jadwal berhasil dihapus.", "success");
              }
            })
            .catch(err => console.error(err));
        }
      });
    } else {
      Swal.fire({
        title: "Hapus jadwal?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal"
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`/api/jadwal/${id}`, { method: 'DELETE' })
            .then(res => {
              if (res.ok) {
                jadwalData[kelasAktif] = jadwalData[kelasAktif].filter(i => i.id !== id);
                renderTabel();
                Swal.fire("Terhapus!", "Jadwal berhasil dihapus.", "success");
              }
            })
            .catch(err => console.error(err));
        }
      });
    }
  }
</script>
