{{-- ============================================================= --}}
{{-- PASAL 7 - KETENTUAN LEMBUR / PIKET / ALL-IN                   --}}
{{-- ============================================================= --}}

@php
    $category = $category ?? ($contract->category ?? null);
    $type     = $type     ?? ($contract->type     ?? null);
@endphp

@if ($category === 'managerial')

    {{-- ============================= --}}
    {{-- MANAGERIAL: KETENTUAN PIKET  --}}
    {{-- ============================= --}}
    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN PIKET</div>

    <p>
        1. Karyawan bersedia untuk bekerja lebih dari jam kerja yang telah ditetapkan pada
        pasal 2 ayat 1 tersebut diatas sebagai kerja Piket bilamana Pengusaha memandang
        perlu berdasarkan perintah Pengusaha, demikian pula halnya Karyawan bersedia
        kerja Piket pada hari – hari libur atau hari raya.
    </p>

    <p>
        2. Pengusaha akan membayar upah Piket Karyawan sesuai dengan jam kerja Piket
        yang dilakukan oleh Karyawan berdasarkan catatan Piket dan dibayarkan sesuai
        dengan perhitungan upah Piket yang ditetapkan sebagai berikut :
    </p>

    <ol type="a" class="ms-4">
        <li>
            Upah/Gaji Piket pada hari Kerja dan Libur :
            <strong>Rp. 31.250 Perjam</strong>
            (berdasarkan surat edaran dari PT. Bukaka Pusat).
        </li>
        <li>
            Uang laut ( Offshore Allowance ) per Hari :
            <strong>Rp. 250.000</strong>
        </li>
    </ol>

    <p>
        3. Upah / Gaji Piket pada hari – hari yang diliburkan oleh Pengusaha, perhitungannya
        sama dengan perhitungan Piket pada Hari Libur
    </p>

@elseif ($type === 'eni-muara-bakau-all-in')

    {{-- ============================================ --}}
    {{-- ALL-IN: KETENTUAN KOMPENSASI GAJI ALL-IN     --}}
    {{-- ============================================ --}}
    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN KOMPENSASI GAJI ALL-IN</div>

    <p>
        1. Pekerja bersedia untuk bekerja melebihi jam kerja sebagaimana dimaksud dalam
        Pasal 2 ayat (1) apabila diperlukan oleh Perusahaan berdasarkan penugasan atau
        perintah Perusahaan, termasuk bekerja pada hari istirahat mingguan, hari libur
        resmi, dan/atau hari libur nasional sesuai dengan kebutuhan operasional Perusahaan.
    </p>

    <p>
        2. Para Pihak sepakat bahwa penghasilan yang diterima Pekerja merupakan gaji
        all-in sebagaimana dimaksud dalam Pasal 5 ayat (1), yang telah memperhitungkan
        kompensasi atas pelaksanaan pekerjaan di luar jam kerja, termasuk pekerjaan pada
        hari istirahat mingguan, hari libur resmi, dan/atau hari libur nasional.
    </p>

    <p>
        3. Dengan ditandatanganinya Perjanjian Kerja ini, Pekerja memahami dan menyetujui
        bahwa Perusahaan tidak melakukan pembayaran upah lembur secara terpisah karena
        kompensasi atas pelaksanaan pekerjaan sebagaimana dimaksud pada ayat (1) telah
        diperhitungkan dalam penghasilan (gaji all-in) yang diterima Pekerja.
    </p>
    @elseif ($type === 'all-in')

    {{-- ============================================ --}}
    {{-- ALL-IN: KETENTUAN KOMPENSASI GAJI ALL-IN     --}}
    {{-- ============================================ --}}
    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN ALL-IN</div>

    <p>
       1. Karyawan bersedia untuk bekerja melebihi jam kerja yang telah ditetapkan bilamana Pengusaha memandang perlu berdasarkan perintah Pengusaha, demikian pula halnya Karyawan bersedia melaksanakan tugas pada hari-hari libur atau hari raya.
    </p>

    <p>
       2.	Karyawan menyetujui bahwa Upah/Gaji bulanan yang diterima merupakan sistem upah All-In, di mana seluruh imbalan atas pelaksanaan kerja di luar jam kerja biasa, baik pada hari kerja, hari libur mingguan, maupun hari raya, telah masuk dan diperhitungkan secara menyeluruh ke dalam gaji bulanan Karyawan
    </p>

    <p>
      3.	Berdasarkan sistem All-In tersebut, Pengusaha tidak membayarkan upah atau biaya tambahan per jam maupun per hari untuk kelebihan jam kerja yang dilakukan Karyawan.
    </p>

@else

    {{-- ============================= --}}
    {{-- DEFAULT: KETENTUAN LEMBUR    --}}
    {{-- ============================= --}}
    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN LEMBUR</div>

    <p>
        1. Pekerja bersedia untuk bekerja lebih dari jam kerja yang telah ditetapkan pada Pasal 2 ayat 1
        tersebut diatas sebagai kerja lembur bilamana Perusahaan memandang perlu berdasarkan perintah
        Perusahaan, demikian pula halnya Pekerja bersedia kerja lembur pada hari -- hari pada saat
        istirahat (hari libur).
    </p>

    <p>
        2. Perusahaan akan membayar upah lembur pekerja sesuai dengan jam kerja lembur yang dilakukan
        oleh Pekerja berdasarkan catatan lembur dan dibayarkan sesuai dengan perhitungan jam lembur yang
        ditetapkan sebagai berikut:
    </p>

    <p class="indent">a. Perhitungan Upah lembur pada hari kerja :</p>
    <p class="indent-2">Jam Pertama : 1,5 x Gaji Pokok : 173 per jam</p>
    <p class="indent-2">Jam Kedua dst : 2 x Gaji Pokok : 173 per jam</p>

    <p class="indent">b. Perhitungan Upah lembur pada hari libur :</p>
    <p class="indent-2">Tujuh Jam Pertama : 2 x Gaji Pokok : 173 per jam</p>
    <p class="indent-2">Jam Kedelapan : 3 x Gaji Pokok : 173 per jam</p>
    <p class="indent-2">Jam Kesembilan dst : 4 x Gaji Pokok : 173 per jam</p>

@endif