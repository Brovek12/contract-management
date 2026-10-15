{{-- ============================================================= --}}
{{-- PASAL 7 — KETENTUAN LEMBUR / KOMPENSASI GAJI ALL-IN          --}}
{{-- 3 Varian:                                                    --}}
{{--   A. Kompensasi All-In (Gaji sudah termasuk lembur)          --}}
{{--   B. Kompensasi Lembur (Formula 1.5x, 2x, 3x, 4x)           --}}
{{--   C. Extend + Lembur Khusus Sand Monitoring                  --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp


{{-- ============================================================= --}}
{{-- VARIAN A — KOMPENSASI GAJI ALL-IN                            --}}
{{-- eni-civil-all-in, eni-smallcapital-all-in, eni-muara-bakau-all-in, --}}
{{-- warlok-all-in, phss-major-ai-1, phss-major-ai-2, phss-major-ai-3, --}}
{{-- phss-humas, lawe-lawe-all-in                                --}}
{{-- ============================================================= --}}
@if (in_array($type, [
    'eni-civil-all-in',
    'eni-smallcapital-all-in',
    'eni-muara-bakau-all-in',
    'warlok-all-in',
    'phss-major-ai-1',
    'phss-major-ai-2',
    'phss-major-ai-3',
    'phss-humas',
    'lawe-lawe-all-in',
]))

    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN KOMPENSASI GAJI ALL-IN</div>

    <p>
        1. Pekerja bersedia untuk bekerja melebihi jam kerja sebagaimana dimaksud dalam Pasal 2 ayat (1)
        apabila diperlukan oleh Perusahaan berdasarkan penugasan atau perintah Perusahaan, termasuk
        bekerja pada hari istirahat mingguan, hari libur resmi, dan/atau hari libur nasional sesuai
        dengan kebutuhan operasional Perusahaan.
    </p>

    <p>
        2. Para Pihak sepakat bahwa penghasilan yang diterima Pekerja merupakan gaji all-in sebagaimana
        dimaksud dalam Pasal 5 ayat (1), yang telah memperhitungkan kompensasi atas pelaksanaan pekerjaan
        di luar jam kerja, termasuk pekerjaan pada hari istirahat mingguan, hari libur resmi, dan/atau
        hari libur nasional.
    </p>

    <p>
        3. Dengan ditandatanganinya Perjanjian Kerja ini, Pekerja memahami dan menyetujui bahwa
        Perusahaan tidak melakukan pembayaran upah lembur secara terpisah karena kompensasi atas
        pelaksanaan pekerjaan sebagaimana dimaksud pada ayat (1) telah diperhitungkan dalam penghasilan
        (gaji all-in) yang diterima Pekerja.
    </p>


{{-- ============================================================= --}}
{{-- VARIAN C — EXTEND + LEMBUR KHUSUS (SAND MONITORING)          --}}
{{-- sandmon-teknisi-1, sandmon-teknisi-2                         --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['sandmon-teknisi-1', 'sandmon-teknisi-2']))

    <div class="pasal-title">PASAL 8</div>
    <div class="pasal-subtitle">KETENTUAN LEMBUR</div>

    <p>
        1. Karyawan di minta bekerja saat libur/day off oleh Pemberi Kerja dalam hal ini Pertamina Hulu
        Mahakam (PHM), maka hari kerja tersebut di kategorikan sebagai Extend dan Karyawan akan di
        berikan kompensasi pembayaran sebesar <strong>Rp. 630.000</strong> (Enam Ratus Tiga Puluh Ribu
        rupiah) perhari dan akan di bayarkan saat Penggajian di bulan yang sama. (MOU Pasal 4 Point 14).
    </p>

    <p>
        2. Perusahaan memberi kompensasi lembur sebesar <strong>Rp. 63.000</strong> (Enam Puluh Tiga Ribu
        rupiah) per jam, apabila karyawan bekerja melebihi jam kerja yang di tentukan oleh Pertamina
        Hulu Mahakam (PHM) dan atas persetujuan pihak Pertamina Hulu Mahakam (PHM). (MOU Pasal 4 Point 15).
    </p>


{{-- ============================================================= --}}
{{-- VARIAN B — KOMPENSASI LEMBUR (FORMULA)                       --}}
{{-- eni-civil-reguler, eni-smallcapital-reguler, warlok-lembur,  --}}
{{-- elis-phkt-5-2, elis-phkt-6-1, phss-driver, phss-reguler,     --}}
{{-- pep-lokal-buny, sched-5-2, lawe-lawe-reguler                --}}
{{-- ============================================================= --}}
@elseif (in_array($type, [
    'eni-civil-reguler',
    'eni-smallcapital-reguler',
    'warlok-lembur',
    'elis-phkt-5-2',
    'elis-phkt-6-1',
    'phss-driver',
    'phss-reguler',
    'pep-lokal-buny',
    'sched-5-2',
    'lawe-lawe-reguler',
]))

    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN LEMBUR</div>

    <p>
        1. Pekerja bersedia untuk bekerja lebih dari jam kerja yang telah ditetapkan pada Pasal 2 ayat 1
        tersebut diatas sebagai kerja lembur bilamana Perusahaan memandang perlu berdasarkan perintah
        Perusahaan, demikian pula halnya Pekerja bersedia kerja lembur pada hari – hari pada saat
        istirahat (hari libur).
    </p>

    <p>
        2. Perusahaan akan membayar upah lembur pekerja sesuai dengan jam kerja lembur yang dilakukan oleh
        Pekerja berdasarkan catatan lembur dan dibayarkan sesuai dengan perhitungan jam lembur yang
        ditetapkan sebagai berikut:
    </p>

    <p class="indent">a. Perhitungan Upah lembur pada hari kerja :</p>
    <p class="indent-2">Jam Pertama&nbsp;&nbsp;&nbsp;&nbsp; : 1,5 x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>
    <p class="indent-2">Jam Kedua dst&nbsp;&nbsp; : 2&nbsp;&nbsp;&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>

    <p class="indent">b. Perhitungan Upah lembur pada hari libur :</p>
    <p class="indent-2">Tujuh Jam Pertama&nbsp;&nbsp;&nbsp;&nbsp; : 2&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>
    <p class="indent-2">Jam Kedelapan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 3&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>
    <p class="indent-2">Jam Kesembilan dst&nbsp;&nbsp; : 4&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>


{{-- ============================================================= --}}
{{-- FALLBACK — Kalau type tidak terdaftar, tampilkan varian lembur --}}
{{-- ============================================================= --}}
@else

    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN LEMBUR</div>

    <p>
        1. Pekerja bersedia untuk bekerja lebih dari jam kerja yang telah ditetapkan pada Pasal 2 ayat 1
        tersebut diatas sebagai kerja lembur bilamana Perusahaan memandang perlu berdasarkan perintah
        Perusahaan, demikian pula halnya Pekerja bersedia kerja lembur pada hari – hari pada saat
        istirahat (hari libur).
    </p>

    <p>
        2. Perusahaan akan membayar upah lembur pekerja sesuai dengan jam kerja lembur yang dilakukan oleh
        Pekerja berdasarkan catatan lembur dan dibayarkan sesuai dengan perhitungan jam lembur yang
        ditetapkan sebagai berikut:
    </p>

    <p class="indent">a. Perhitungan Upah lembur pada hari kerja :</p>
    <p class="indent-2">Jam Pertama&nbsp;&nbsp;&nbsp;&nbsp; : 1,5 x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>
    <p class="indent-2">Jam Kedua dst&nbsp;&nbsp; : 2&nbsp;&nbsp;&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>

    <p class="indent">b. Perhitungan Upah lembur pada hari libur :</p>
    <p class="indent-2">Tujuh Jam Pertama&nbsp;&nbsp;&nbsp;&nbsp; : 2&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>
    <p class="indent-2">Jam Kedelapan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 3&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam</p>
    <p class="indent-2">Jam Kesembilan dst&nbsp;&nbsp; : 4&nbsp; x Gaji Pokok&nbsp;&nbsp;&nbsp; : 173 per jam

@endif