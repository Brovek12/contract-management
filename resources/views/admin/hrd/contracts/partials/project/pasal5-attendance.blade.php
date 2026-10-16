{{-- ============================================================= --}}
{{-- PASAL 5 — LANJUTAN: KETENTUAN KEHADIRAN / LEMBUR / BONUS     --}}
{{-- Bagian ini SISIPAN untuk type yang punya klausul tambahan    --}}
{{-- (mis. Sand Monitoring, PHSS Major, dll)                     --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp
<div class="pasal5-attendance-compact">
{{-- ============================================================= --}}
{{-- 1. SAN MONITORING — Klausul khusus "Timesheet" dan "Training" --}}
{{-- ============================================================= --}}
@if (in_array($type, ['sandmon-teknisi-1', 'sandmon-teknisi-2']))

    <p>6. Potongan Ketidakhadiran (MOU Pasal 4 Point 3-5)</p>
    <p class="indent">
        a. Jika dalam 1 periode Timesheet (14 hari kerja) Karyawan berhalangan hadir dalam keadaan sakit
        dengan menunjukan Surat Dokter maka Perusahaan hanya akan membayarkan Gaji Pokok + Tunjangan Tetap
        kepada Karyawan yang mengacu pada perhitungan pada Pasal 5 Poin 1.
    </p>
    <p class="indent">
        b. Jika dalam 1 periode Timesheet (14 hari kerja) Karyawan berhalangan hadir Karena Sakit yang di
        sebabkan oleh kecelakaan kerja dengan menunjukan surat dokter dan persetujuan dari Site Supervisor
        beserta Pertamina Hulu Mahakam (PHM) maka Perusahaan akan membayarkan THP kepada Karyawan.
    </p>
    <p class="indent">
        c. Bila dalam 1 Periode Timesheet (14 hari kerja) Karyawan hanya dapat hadir beberapa hari
        (kurang dari 14 hari) maka Perusahaan akan memotong EWHC dan Tunjangan Harian sesuai dengan hari
        yang di tinggalkan. Apabila dalam 1 Periode Timesheet Karyawan diminta hadir lebih dari 14 hari
        kerja, maka Perusahaan akan memberikan tambahan harian nilai EWHC sesuai dengan jumlah hari yang
        ditambahkan. Perhitungan harian nilai EWHC dan Tunjangan Harian adalah Total dari nilai EWHC dan
        Tunjangan Harian dibagi 14 hari.
    </p>

    <p>7. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh Perusahaan untuk kemudian disetorkan ke Kas Negara.</p>


{{-- ============================================================= --}}
{{-- 2. PHSS MAJOR — Klausul khusus "Tanggal Pembayaran Lembur"    --}}
{{-- ============================================================= --}}
@elseif (in_array($type, ['phss-driver', 'phss-reguler', 'phss-security', 'phss-humas']))

    <p>7. Jika terdapat Lembur pada periode perhitungan tanggal 01 – 30/31 pada bulan sebelumnya, maka akan dibayarkan setiap tanggal 25 bulan selanjutnya.</p>

    <p>8. Potongan Ketidakhadiran dan Keterlambatan</p>
    <p class="indent">
        a. Pekerja yang tidak masuk bekerja tanpa pemberitahuan dihari pertama serta tidak menunjukkan
        surat keterangan sakit dari dokter atau surat izin pada hari berikutnya maka dikategorikan
        <strong>Alpa</strong> dan upah akan dipotong dengan formula sebagai berikut:
    </p>
    <p class="formula">ALPA = Alpa X Gaji Pokok / 21</p>
    <p class="indent">
        b. Pekerja yang tidak masuk bekerja karena izin, maka wajib memberikan informasi kepada atasan
        serta membuat surat izin pada hari berikutnya. Perhitungan Potongan izin adalah sebagai berikut :
    </p>
    <p class="formula">IZIN = Gaji Pokok X Jumlah Izin X 50% / 21</p>
    <p class="indent">
        c. Pekerja yang tidak masuk bekerja karena sakit, maka wajib memberikan Informasi kepada atasan
        serta menunjukkan surat keterangan sakit dari dokter. Bagi yang tidak dapat menunjukkan surat
        Keterangan sakit dari dokter namun sudah menginformasikan kepada atasan maka Pekerja dianggap
        <strong>izin.</strong>
    </p>
    <p class="indent">
        d. Setiap Pekerja yang terlambat datang untuk bekerja kecuali seizin atasannya, maka berlaku
        pemotongan Gaji dengan formula sebagai berikut :
    </p>
    <p class="formula">Potongan Keterlambatan = Keterlambatan X Gaji Pokok / 8 / 21</p>
    <p class="indent">
        e. Gaji yang tidak dibayarkan ini berlaku untuk seluruh Pekerja sesuai dengan ketentuan yang
        tercantum di dalam Peraturan Perusahaan.
    </p>

    <p>9. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh Pekerja untuk kemudian disetorkan ke Kas Negara.</p>


   {{-- ============================================================= --}}
{{-- 3A. ENI CIVIL ALL-IN — Tanggal Pembayaran 25                  --}}
{{-- eni-civil-all-in                                             --}}
{{-- ============================================================= --}}
@elseif ($type === 'eni-civil-all-in' )

    <p>6. Gaji pokok dan tunjangan dibayarkan tanggal 25 setiap bulannya. Dengan periode gaji dan tunjangan mulai tanggal 26 bulan sebelumnya sampai tanggal 25 bulan selanjutnya. Ketentuan tanggal pembayaran Upah adalah sebagai berikut:</p>
    <p class="indent">a. Apabila tanggal 25 jatuh pada hari Sabtu, maka Upah akan dibayarkan pada tanggal 24 (hari Jumat).</p>
    <p class="indent">b. Apabila tanggal 25 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 26 (hari Senin).</p>

    <p>7. Potongan Ketidakhadiran dan Keterlambatan</p>
    <p class="indent">
        a. Pekerja yang tidak masuk bekerja tanpa pemberitahuan dihari pertama serta tidak menunjukkan
        surat keterangan sakit dari dokter atau surat izin pada hari berikutnya maka dikategorikan
        <strong>Alpa</strong> dan upah akan dipotong dengan formula sebagai berikut:
    </p>
    <p class="formula">ALPA = Alpa X Gaji Pokok / 21</p>
    <p class="indent">
        b. Pekerja yang tidak masuk bekerja karena izin, maka wajib memberikan informasi kepada atasan
        serta membuat surat izin pada hari berikutnya. Perhitungan Potongan izin adalah sebagai berikut :
    </p>
    <p class="formula">IZIN = Gaji Pokok X Jumlah Izin X 50% / 21</p>
    <p class="indent">
        c. Pekerja yang tidak masuk bekerja karena sakit, maka wajib memberikan Informasi kepada atasan
        serta menunjukkan surat keterangan sakit dari dokter. Bagi yang tidak dapat menunjukkan surat
        Keterangan sakit dari dokter namun sudah menginformasikan kepada atasan maka karyawan dianggap
        <strong>izin.</strong>
    </p>
    <p class="indent">
        d. Setiap Pekerja yang terlambat datang untuk bekerja kecuali seizin atasannya, maka berlaku
        pemotongan Gaji dengan formula sebagai berikut :
    </p>
    <p class="formula">Potongan Keterlambatan = Keterlambatan X Gaji Pokok / 8 / 21</p>
    <p class="indent">
        e. Gaji yang tidak dibayarkan ini berlaku untuk seluruh Pekerja sesuai dengan ketentuan yang
        tercantum di dalam Peraturan Perusahaan.
    </p>

    <p>8. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh <strong>Perusahaan</strong> untuk kemudian disetorkan ke Kas Negara.</p>


{{-- ============================================================= --}}
{{-- 3B. ENI CIVIL REGULER — Tanggal Pembayaran 09                 --}}
{{-- eni-civil-reguler                                            --}}
{{-- ============================================================= --}}
@elseif ($type === 'eni-civil-reguler'  || $type === 'eni-muara-bakau-all-in' ||$type === "warlok-all-in" || $type === 'eni-muara-bakau-lembur' || $type === 'warlok-lembur' || $type ==='warlok-security' || $type ==='elis-phkt-6-1')

    <p>6. Gaji, dan Lembur (bila ada) dibayarkan pada tanggal 09 setiap bulannya, dengan periode perhitungan tanggal 01 – 30/31 bulan sebelumnya, dengan ketentuan sebagai berikut:</p>
    <p class="indent">a. Apabila tanggal 09 jatuh pada hari Sabtu/Libur Nasional, maka Upah dibayarkan pada tanggal 08 (hari Jumat/hari sebelumnya)</p>
    <p class="indent">b. Apabila tanggal 09 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 10 (hari Senin)</p>

    <p>7. Potongan Ketidakhadiran dan Keterlambatan</p>
    <p class="indent">
        a. Pekerja yang tidak masuk bekerja tanpa pemberitahuan dihari pertama serta tidak menunjukkan
        surat keterangan sakit dari dokter atau surat izin pada hari berikutnya maka dikategorikan
        <strong>Alpa</strong> dan upah akan dipotong dengan formula sebagai berikut:
    </p>
    <p class="formula">ALPA = Alpa X Gaji Pokok / 21</p>
    <p class="indent">
        b. Pekerja yang tidak masuk bekerja karena izin, maka wajib memberikan informasi kepada atasan
        serta membuat surat izin pada hari berikutnya. Perhitungan Potongan izin adalah sebagai berikut :
    </p>
    <p class="formula">IZIN = Gaji Pokok X Jumlah Izin X 50% / 21</p>
    <p class="indent">
        c. Pekerja yang tidak masuk bekerja karena sakit, maka wajib memberikan Informasi kepada atasan
        serta menunjukkan surat keterangan sakit dari dokter. Bagi yang tidak dapat menunjukkan surat
        Keterangan sakit dari dokter namun sudah menginformasikan kepada atasan maka karyawan dianggap
        <strong>izin.</strong>
    </p>
    <p class="indent">
        d. Setiap Pekerja yang terlambat datang untuk bekerja kecuali seizin atasannya, maka berlaku
        pemotongan Gaji dengan formula berikut :
    </p>
    <p class="formula">Potongan Keterlambatan = Keterlambatan X Gaji Pokok / 8 / 21</p>
    <p class="indent">
        e. Gaji yang tidak dibayarkan ini berlaku untuk seluruh Pekerja sesuai dengan ketentuan yang
        tercantum di dalam Peraturan Perusahaan.
    </p>

    <p>8. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh <strong>Perusahaan</strong> untuk kemudian disetorkan ke Kas Negara.</p>


   {{-- ============================================================= --}}
{{-- 5. ENI SMALL CAPITAL ALL-IN — Pajak Pekerja + Pesangon       --}}
{{-- eni-smallcapital-all-in                                    --}}
{{-- ============================================================= --}}
@elseif ($type === 'eni-smallcapital-all-in')

    <p>6. Gaji pokok dan tunjangan (Upah) dibayarkan tanggal 09 setiap bulannya. dengan periode perhitungan tanggal 01 – 30/31 bulan sebelumnya.</p>

    <p>7. Ketentuan tanggal pembayaran Upah adalah sebagai berikut:</p>
    <p class="indent">a. Apabila tanggal 09 jatuh pada hari Sabtu, maka Upah dibayarkan pada tanggal 08 (hari Jumat)</p>
    <p class="indent">b. Apabila tanggal 09 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 10 (hari Senin)</p>

    <p>8. Apabila Pekerja diberhentikan dikarenakan bukan kesalahan Pekerja dan masa kontrak belum berakhir, kepada Pekerja akan dibayarkan sisa upah masa kontraknya.</p>

    <p>9. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh Pekerja untuk kemudian disetorkan ke Kas Negara.</p>


{{-- ============================================================= --}}
{{-- 3. ENI / ELIS / LAWE-LAWE / PHS MAJOR — Klausul umum          --}}
{{-- ============================================================= --}}
@elseif (in_array($type, [
    'eni-smallcapital-reguler',
    'elis-phkt-5-2',
    'phss-major-ai-1', 'phss-major-ai-2', 'phss-major-ai-3',
    'lawe-lawe-reguler', 'lawe-lawe-all-in',
    'pep-lokal-buny', 'sched-5-2',
]))

@if  (in_array($type, ['elis-phkt-5-2']))
<p>6.	Gaji, Tunjangan - tunjangan dan Lembur (bila ada) dibayarkan setiap tanggal 25 setiap bulannya. Dengan 
    periode Gaji dan Tunjangan mulai tanggal 26 bulan sebelumnya sampai tanggal 25 bulan selanjutnya dan uang makan, 
    transport, tunjangan lokasi dan lembur tanggal 16 bulan sebelumnya sampai tanggal 15 bulan selanjutnya</p>

    <p>7. Ketentuan tanggal pembayaran Upah adalah sebagai berikut:</p>
    <p class="indent">a.	Apabila tanggal 25 jatuh pada hari Sabtu, maka Upah akan dibayarkan pada tanggal 24 (hari Jumat)</p>
    <p class="indent">b.	Apabila tanggal 25 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 26 (hari Senin).</p>

@endif


    <p>8. Potongan Ketidakhadiran dan Keterlambatan</p>
    <p class="indent">
        a. Pekerja yang tidak masuk bekerja tanpa pemberitahuan dihari pertama serta tidak menunjukkan
        surat keterangan sakit dari dokter atau surat izin pada hari berikutnya maka dikategorikan
        <strong>Alpa</strong> dan upah akan dipotong dengan formula sebagai berikut:
    </p>
    <p class="formula">ALPA = Alpa X Gaji Pokok / 21</p>
    <p class="indent">
        b. Pekerja yang tidak masuk bekerja karena izin, maka wajib memberikan informasi kepada atasan
        serta membuat surat izin pada hari berikutnya. Perhitungan Potongan izin adalah sebagai berikut :
    </p>
    <p class="formula">IZIN = Gaji Pokok X Jumlah Izin X 50% / 21</p>
    <p class="indent">
        c. Pekerja yang tidak masuk bekerja karena sakit, maka wajib memberikan Informasi kepada atasan
        serta menunjukkan surat keterangan sakit dari dokter. Bagi yang tidak dapat menunjukkan surat
        Keterangan sakit dari dokter namun sudah menginformasikan kepada atasan maka Pekerja dianggap
        <strong>izin.</strong>
    </p>
    <p class="indent">
        d. Setiap Pekerja yang terlambat datang untuk bekerja kecuali seizin atasannya, maka berlaku
        pemotongan Gaji dengan formula sebagai berikut :
    </p>
    <p class="formula">Potongan Keterlambatan = Keterlambatan X Gaji Pokok / 8 / 21</p>
    <p class="indent">
        e. Gaji yang tidak dibayarkan ini berlaku untuk seluruh Pekerja sesuai dengan ketentuan yang
        tercantum di dalam Peraturan Perusahaan.
    </p>

    <p>9. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh Pekerja untuk kemudian disetorkan ke Kas Negara.</p>

@endif
</div>