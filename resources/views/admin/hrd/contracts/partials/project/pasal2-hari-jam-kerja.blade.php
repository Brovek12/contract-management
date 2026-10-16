{{-- ============================================================= --}}
{{-- PASAL 2 — HARI DAN JAM KERJA                                 --}}
{{-- 6 Varian:                                                    --}}
{{--   1. V1 — 5:2 Office (Senin-Kamis 08.00-17.00, Jumat 08.00-17.00, 40 jam) --}}
{{--   2. V2 — 6:1 Standar (Senin-Kamis 07.00-17.00, Jumat 07.00-17.00, Sabtu 07.00-17.00) --}}
{{--   3. V3 — Roster + Site (2:1, 2:2, 3:1, 6:1, 5:2, dll) --}}
{{--   4. V4 — Shift Malam (6:1, 12 jam shift) --}}
{{--   5. V5 — On/Off Duty (2 bulan on, 1 minggu off) --}}
{{--   6. V6 — Site Roster Medco (2:1, 2:2, 3:1, 6:1, 5:2, 3:3, 4:4, 5:3) --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp

<div class="pasal-title">PASAL 2</div>
<div class="pasal-subtitle">HARI DAN JAM KERJA</div>


{{-- ============================================================= --}}
{{-- V1 — 5:2 Office (Senin-Kamis 08.00-17.00, Jumat 08.00-17.00) --}}
{{-- Digunakan di: eni-civil-all-in, eni-civil-reguler, elis-phkt-6-1, phss-humas, phss-reguler --}}
{{-- ============================================================= --}}
@if (in_array($type, [ 'phss-humas', 'phss-reguler','pep-lokal-buny', 'eni-muara-bakau-lembur','elis-phkt-5-2']))

    <p>1. Hari dan jam kerja dalam satu Minggu adalah 5 (Lima) hari dan jumlah jam kerja tidak melebihi 40 (empat puluh) jam seminggu, dengan ketentuan sebagai berikut :</p>

    <p class="indent">o Senin s/d Kamis : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 1 (satu) jam</p>
    <p class="indent-2">Jam 12.00 WITA s/d Jam 13.00 WITA</p>

    <p class="indent">o Jum'at : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 2 (dua) jam</p>
    <p class="indent-2">Jam 11.30 WITA s/d 13.30 WITA</p>

    <p class="indent">o Sabtu s/d Minggu : Libur</p>

    <p>2. Pekerja mengakui hak Perusahaan untuk mengatur hari kerja dan jam kerja serta kerja shift bagi semua pekerja dengan syarat jumlah jam kerja tidak melebihi 40 jam dalam satu Minggu.</p>

    @if (in_array($type, ['eni-muara-bakau-lembur']))
        <p>3.	Apabila Pekerja diharuskan masuk pada hari libur/istirahat maka kehadirannya akan diperhitungkan sebagai lembur pada hari libur</p>
        <p>4.	Apabila Pekerja bekerja lebih dari jam kerja yang disebutkan di pasal sebelumnya, maka akan menambah jam overtime dengan syarat mendapatkan Approval / tanda tangan dari Project / User.</p>
    @else
 

    <p>3. Jam kerja di lokasi project atau di luar office/workshop sesuai dengan peraturan yang ditentukan dan disetujui oleh project atau user.</p>

    <p>4. Selama bulan puasa Ramadhan, jam kerja akan dilaksanakan dengan ketentuan yang akan diatur kemudian.</p>
       @endif

    {{-- ============================================================= --}}
{{-- V1-C — 5:2 Office + All-In (ENI CIVIL)                       --}}
{{-- Digunakan di: eni-civil-all-in, eni-civil-reguler            --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['eni-civil-all-in']))

    <p>1. Hari dan jam kerja dalam satu Minggu adalah 5 (Lima) hari dan jumlah jam kerja tidak melebihi 40 (empat puluh) jam seminggu, dengan ketentuan sebagai berikut :</p>

    <p class="indent">o Senin s/d Kamis : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 1 (satu) jam</p>
    <p class="indent-2">Jam 12.00 WITA s/d Jam 13.00 WITA</p>

    <p class="indent">o Jum'at : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 2 (dua) jam</p>
    <p class="indent-2">Jam 11.30 WITA s/d 13.30 WITA</p>

    <p class="indent">o Sabtu s/d Minggu : Libur (hari dan jam kerja normal di office)</p>
    <p class="indent">o Diluar hari dan jam kerja diatas, apabila diperlukan masuk kerja sesuai dengan kebutuhan pekerjaan, maka wajib masuk dan tidak dihitung Overtime</p>

    <p>2. Apabila diperlukan bekerja ke lokasi/site wajib ke lokasi/site, adapun jam kerjanya menyesuaikan jam kerja di lokasi/site dan tidak dihitung dinas luar dan kelebihan jam kerja normal tidak dihitung lembur</p>

    <p>3. Selama bulan puasa Ramadhan, jam kerja akan dilaksanakan dengan ketentuan yang akan diatur kemudian.</p>

    @elseif ($type === 'eni-civil-reguler')

    <p>1. Hari dan jam kerja dalam satu Minggu adalah 5 (Lima) hari dan jumlah jam kerja tidak melebihi 40 (empat puluh) jam seminggu, dengan ketentuan sebagai berikut :</p>

    <p class="indent">o Senin s/d Kamis : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 1 (satu) jam</p>
    <p class="indent-2">Jam 12.00 WITA s/d Jam 13.00 WITA</p>

    <p class="indent">o Jum'at : Jam 08.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat 2 (dua) jam</p>
    <p class="indent-2">Jam 11.30 WITA s/d 13.30 WITA</p>

    <p class="indent">o Sabtu s/d Minggu : Libur</p>

    <p>2. Pekerja mengakui hak Perusahaan untuk mengatur hari kerja dan jam kerja serta kerja shift bagi semua pekerja dengan syarat jumlah jam kerja tidak melebihi 40 jam dalam satu Minggu.</p>

    <p>3. Apabila Pekerja diharuskan masuk pada hari libur/istirahat maka kehadirannya akan diperhitungkan sebagai lembur pada hari libur.</p>

    <p>4. Apabila Pekerja bekerja lebih dari jam kerja yang disebutkan di pasal sebelumnya, maka akan menambah jam overtime dengan syarat mendapatkan Approval / tanda tangan dari Project / User.</p>


{{-- ============================================================= --}}
{{-- V2 — 6:1 Standar (Senin-Kamis 07.00-17.00, Jumat 07.00-17.00, Sabtu 07.00-17.00) --}}
{{-- Digunakan di: eni-smallcapital-all-in, eni-smallcapital-reguler, eni-muara-bakau-lembur, --}}
{{--              eni-muara-bakau-all-in, elis-phkt-5-2, phss-driver, phss-major-ai-1, --}}
{{--              phss-major-ai-2, lawe-lawe-all-in --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['elis-phkt-6-1','eni-smallcapital-all-in', 'eni-smallcapital-reguler', 'eni-muara-bakau-all-in', 'phss-driver', 'phss-major-ai-1', 'phss-major-ai-2', 'lawe-lawe-all-in']))

    <p>1. Hari dan jam kerja dalam satu Minggu adalah 6 (Enam) hari dan 1 (Satu) hari libur dengan skema seperti dibawah ini:</p>

    <p class="indent">o Senin s/d Kamis : Jam 07.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat</p>
    <p class="indent-2">Jam 12.00 WITA s/d Jam 13.00 WITA</p>

    <p class="indent">o Jum'at : Jam 07.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat</p>
    <p class="indent-2">Jam 11.30 WITA s/d Jam 13.30 WITA</p>
    
    @if (in_array($type, [ 'eni-smallcapital-reguler', 'eni-smallcapital-reguler']))

    <p class="indent">o Sabtu : Jam 07.00 WITA s/d Jam 12.00 WITA </p>
    @else
     <p class="indent">o Sabtu : Jam 07.00 WITA s/d Jam 17.00 WITA dengan waktu istirahat</p>
    <p class="indent-2">Jam 12.00 WITA s/d Jam 13.00 WITA</p>
    @endif

    <p class="indent">o Minggu : Libur</p>

    @if (in_array($type, [ 'elis-phkt-6-1','eni-smallcapital-reguler', 'elis-phkt-5-2', 'phss-driver', 'phss-major-ai-1', 'phss-major-ai-2']))
        <p>2. Pekerja mengakui hak Perusahaan untuk mengatur hari kerja dan jam kerja serta kerja shift bagi semua pekerja dengan syarat jumlah jam kerja tidak melebihi 40 jam dalam satu Minggu.</p>
        <p>3. Apabila Pekerja diharuskan masuk pada hari libur/istirahat maka kehadirannya akan diperhitungkan sebagai lembur pada hari libur.</p>
        <p>4. Apabila Pekerja bekerja lebih dari jam kerja yang disebutkan di pasal sebelumnya, maka akan menambah jam overtime dengan syarat mendapatkan Approval / tanda tangan dari Project / User.</p>
    @endif


{{-- ============================================================= --}}
{{-- V3 — Roster + Site (2:1, 2:2, 3:1, 6:1, 5:2, dll) --}}
{{-- Digunakan di: pep-lokal-buny, sandmon-teknisi-1, sandmon-teknisi-2, sched-5-2 --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['sandmon-teknisi-1', 'sandmon-teknisi-2']))

    <p>1. Hari kerja yang di gunakan adalah sesuai dengan ketentuan yang ditetapkan oleh User / Project / Perusahaan :</p>

    <p class="indent">a. 2 : 1 (14 hari kerja dan 7 hari Libur)</p>
    <p class="indent">b. 2 : 2 (14 hari kerja dan 14 hari libur)</p>
    <p class="indent">c. 3 : 1 (21 hari kerja dan 7 hari libur)</p>
    <p class="indent">d. 6 : 1 (6 hari kerja dan 1 hari libur)</p>
    <p class="indent">e. 5 : 2 (5 hari kerja dan 2 hari libur)</p>

    @if ($type === 'pep-lokal-buny')
        <p>2. Jam kerja Office adalah dari jam 07.00 – 17.00 (10 jam) dengan jam istirahat 1 jam.</p>
        <p>3. Apabila Karyawan diharuskan masuk pada hari libur / istirahat maka kehadirannya diperhitungkan sebagai lembur pada hari libur.</p>
        <p>4. Apabila Karyawan bekerja lebih dari jam kerja yang disebutkan di pasal sebelumnya, maka akan menambah jam overtime dengan syarat mendapatkan Approval / tanda tangan dari Project / User.</p>
    @endif

    @if ($type === 'sandmon-teknisi-1' || $type === 'sandmon-teknisi-2')
        <p>1. Hari kerja yang di gunakan adalah sesuai dengan ketentuan yang ditetapkan oleh User- Pertamina Hulu Mahakam (PHM) yaitu :</p>
        <p class="indent">2 : 2 (14 hari kerja dan 14 hari libur)*</p>
        <p class="indent-2">*Awal project menggunakan schedule 2:2 (14 hari kerja dan 14 hari libur) & Apabila ada perubahan schedule dari project atau User maka akan disesuaikan.</p>
        <p>2. Jam kerja adalah dari jam 06:00 – 18:00 dengan jam istirahat mengikuti aturan yang berlaku di Pertamina Hulu Mahakam (PHM) sesuai kondisi di lapangan kerja berada.</p>
    @endif


{{-- ============================================================= --}}
{{-- V4 — Shift Malam (6:1) --}}
{{-- Digunakan di: warlok-security, phss-security --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['phss-security']))

    <p>1. Hari dan jam kerja adalah 6 (Enam) hari kerja banding 1 (satu) hari libur, dengan ketentuan sebagai berikut :</p>

    <p class="indent">a. Siang : Jam 06.00 WITA s/d Jam 18.00 WITA</p>
    <p class="indent">b. Malam : Jam 18.00 WITA s/d Jam 06.00 WITA</p>

    <p>Waktu Istirahat 1 (Satu) Jam yang waktunya diatur tersendiri.</p>

    <p>2. Jam kerja di luar lokasi Workshop diberlakukan shift kerja, dengan ketentuan 1 (satu) shift kerja sebanyak 12 (dua belas) jam dengan waktu istirahat 1 (satu) jam yang waktunya akan diatur kemudian.</p>

    <p>3. Selama bulan puasa Ramadhan, jam kerja akan dilaksanakan dengan ketentuan yang akan diatur kemudian.</p>


{{-- ============================================================= --}}
{{-- V5 — On/Off Duty (2 bulan On, 1 minggu Off) --}}
{{-- Digunakan di: phss-major-ai-3 --}}
{{-- ============================================================= --}}
@elseif ($type === 'phss-major-ai-3')

    <p>1. Hari kerja yang digunakan adalah sesuai dengan ketentuan yang ditetapkan oleh User / Project / Perusahaan sebagai berikut : 2 (Dua) bulan Onduty dan 1 (Satu) Minggu Offduty</p>

    <p>2. Jam Kerja sesuai dengan kebutuhan project di Site.</p>


{{-- ============================================================= --}}
{{-- V6 — Site Roster Medco (2:1, 2:2, 3:1, 6:1, 5:2, 3:3, 4:4, 5:3) --}}
{{-- Digunakan di: warlok-all-in, warlok-lembur --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['warlok-all-in', 'warlok-lembur', 'warlok-security']))

    <p>1. Hari kerja yang di gunakan adalah sesuai dengan ketentuan yang ditetapkan oleh User / Project / Perusahaan :</p>

    <p class="indent">a. 2 : 1 (14 hari kerja dan 7 hari Libur)</p>
    <p class="indent">b. 2 : 2 (14 hari kerja dan 14 hari libur)</p>
    <p class="indent">c. 3 : 1 (21 hari kerja dan 7 hari libur)</p>
    <p class="indent">d. 6 : 1 (6 hari kerja dan 1 hari libur)</p>
    <p class="indent">e. 5 : 2 (5 hari kerja dan 2 hari libur)</p>

    <p>2. Jam kerja Office adalah dari jam 
        @if ($type === 'warlok-security')
 18.00 – 06.00 
        @else
          07.00 – 17.00 (10 jam)
        @endif
      
        
        dengan jam istirahat 1 jam.</p>
       @if ($type === 'warlok-security')
       <p>3.	Jam kerja di luar lokasi Workshop diberlakukan shift kerja, dengan ketentuan 1 (satu) shift kerja sebanyak 12 (dua belas) jam dengan waktu istirahat 1 (satu) jam yang waktunya akan diatur kemudian.</p>
       <p>4.	Selama bulan puasa Ramadhan, jam kerja akan dilaksanakan dengan ketentuan yang akan diatur kemudian.</p>
       @else
         <p>3. Apabila Karyawan diharuskan masuk pada hari libur / istirahat maka kehadirannya diperhitungkan sebagai lembur pada hari libur.</p>

    <p>4. Apabila Karyawan bekerja lebih dari jam kerja yang disebutkan di pasal sebelumnya, maka akan menambah jam overtime dengan syarat mendapatkan Approval / tanda tangan dari Project / User.</p>

       @endif

  

{{-- ============================================================= --}}
{{-- V3-Extended — Roster Extended (8 varian roster) --}}
{{-- Digunakan di: sched-5-2 --}}
{{-- ============================================================= --}}
@elseif ($type === 'sched-5-2')

    <p>1. Hari kerja yang di gunakan adalah sesuai dengan ketentuan yang ditetapkan oleh User / Project / Perusahaan :</p>

    <p class="indent">a. 2 : 2 (14 hari kerja dan 14 hari libur)</p>
    <p class="indent">b. 6 : 1 (6 hari kerja dan 1 hari libur)</p>
    <p class="indent">c. 5 : 2 (5 hari kerja dan 2 hari libur)</p>
    <p class="indent">d. 3 : 3 (21 hari kerja dan 21 hari libur)</p>
    <p class="indent">e. 4 : 4 (28 hari kerja dan 28 hari libur)</p>
    <p class="indent">f. 5 : 3 (35 hari kerja dan 21 hari libur)</p>

    <p>2. Jam kerja office / workshop adalah dari jam 08.00 – 17.00 (9 jam) dengan jam istirahat 1 jam.</p>

    <p>3. Apabila Karyawan diharuskan masuk pada hari libur / istirahat maka kehadirannya diperhitungkan sebagai lembur pada hari libur.</p>

    <p>4. Apabila Karyawan bekerja dilapangan (lokasi) lebih dari jam kerja 06.00 – 18.00 (11 jam kerja dengan 1 jam istirahat) maka akan menambah jam overtime dengan syarat mendapatkan Approval / tanda tangan dari Project / User.</p>


{{-- ============================================================= --}}
{{-- V3-Extended 2 — Roster Extended Full (8 varian roster) --}}
{{-- Digunakan di: phss-major-ai-1, phss-major-ai-2 (kalau memang ada perubahan) --}}
{{-- ============================================================= --}}
@endif