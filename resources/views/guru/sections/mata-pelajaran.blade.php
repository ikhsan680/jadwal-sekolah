<section id="mata-pelajaran" class="px-4 sm:px-6 py-12 bg-indigo-50">
  <div class="max-w-6xl mx-auto space-y-6">
    <h2 class="text-3xl font-bold text-indigo-700 text-center">Jadwal Harian</h2>

    <!-- Dropdown Angkatan & Kelas -->
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

      <button id="btnDownloadPDF" onclick="downloadPDF()" 
              class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition hidden w-full sm:w-auto">
        📄 Download PDF
      </button>
    </div>

    <!-- Tabel jadwal -->
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


<!-- jsPDF dan AutoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
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
      tbody.innerHTML = `<tr>
        <td colspan="5" class="px-4 py-3 text-gray-500">Pilih angkatan dan kelas untuk menampilkan jadwal.</td>
      </tr>`;
      btnDownload.classList.add("hidden");
      return;
    }

    try {
      const res = await fetch(`/api/jadwal/${encodeURIComponent(kelas)}`);
      const data = await res.json();

      if (!data.length) {
        tbody.innerHTML = `<tr>
          <td colspan="5" class="px-4 py-3 text-gray-500">Belum ada jadwal untuk kelas ini.</td>
        </tr>`;
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

      // tampilkan tombol download
      btnDownload.classList.remove("hidden");

    } catch (err) {
      console.error(err);
      tbody.innerHTML = `<tr>
        <td colspan="5" class="px-4 py-3 text-red-500">Gagal memuat jadwal.</td>
      </tr>`;
      btnDownload.classList.add("hidden");
    }
  }

  async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const kelas = document.getElementById('kelasSelect').value;
    if (!kelas) { alert("Pilih kelas dulu!"); return; }

    try {
      const res = await fetch(`/api/jadwal/${encodeURIComponent(kelas)}`);
      const data = await res.json();
      const doc = new jsPDF("l", "pt", "a4"); // landscape agar muat 5 kolom

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
        } else {
          row.push("-");
        }
      });

      doc.autoTable({
        head: [hariList],
        body: [row],
        startY: 60,
        styles: { halign: "center", valign: "middle" },
        headStyles: { fillColor: [79, 70, 229] }, // warna indigo
      });

      doc.save(`Jadwal-${kelas}.pdf`);
    } catch(err) {
      console.error(err);
      alert("Gagal membuat PDF!");
    }
  }
</script>
