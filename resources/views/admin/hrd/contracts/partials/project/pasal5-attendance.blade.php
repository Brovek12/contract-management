{{-- ============================================================= --}}
{{-- PASAL 5 — LANJUTAN: KETENTUAN KEHADIRAN / LEMBUR / BONUS     --}}
{{-- Bagian ini SISIPAN untuk type yang punya klausul tambahan    --}}
{{-- (mis. Sand Monitoring, PHSS Major, dll)                     --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp

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
{{-- 3. ENI / ELIS / LAWE-LAWE / PHS MAJOR — Klausul umum          --}}
{{-- ============================================================= --}}
@elseif (in_array($type, [
    'eni-civil-all-in', 'eni-civil-reguler',
    'eni-smallcapital-all-in', 'eni-smallcapital-reguler',
    'eni-muara-bakau-lembur', 'eni-muara-bakau-all-in',
    'warlok-all-in', 'warlok-lembur', 'warlok-security',
    'elis-phkt-5-2', 'elis-phkt-6-1',
    'phss-major-ai-1', 'phss-major-ai-2', 'phss-major-ai-3',
    'lawe-lawe-reguler', 'lawe-lawe-all-in',
    'pep-lokal-buny', 'sched-5-2',
]))

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