{{-- ============================================================= --}}
{{-- PASAL 9 — POIN 2: KEPATUHAN JAM DAN AREA KERJA               --}}
{{-- 2 varian:                                                    --}}
{{--   - PENDEK  → eni-smallcapital-all-in                        --}}
{{--   - PANJANG → 24 type lainnya                                 --}}
{{-- ============================================================= --}}

@php
    $c = $contract ?? null;
@endphp

@if ($type == 'eni-smallcapital-all' || $type ==='sched-5-2')

    {{-- ========================================================= --}}
    {{-- VERSI PENDEK — ENI Small Capital All-In                     --}}
    {{-- ========================================================= --}}
     <p>2. <strong>Kepatuhan Jam dan Area Kerja</strong></p>
    <p class="indent">
        a. Setiap karyawan yang berhalangan hadir, wajib menyampaikan informasi dan permohonan izin
        kepada atasan langsung sebagai persetujuan, untuk selanjutnya diinformasikan kepada HRD maksimal
        pada hari H untuk pendataan administrasi. Jenis izin adalah sebagai berikut:
    </p>
    <p class="indent-2">i. Izin Terlambat</p>
    <p class="indent-2">ii. Izin Pulang Awal</p>
    <p class="indent-2">iii. Izin meninggalkan pekerjaan (keperluan pribadi)</p>
    <p class="indent-2">iv. Izin meninggalkan pekerjaan (keperluan perusahaan)</p>

    <p class="indent">b. Penanganan Pelanggaran Perizinan</p>
    <p class="indent">
        Jika dalam masa 1 (satu) periode payroll terdapat karyawan yang melakukan pelanggaran /
        ketidakpatuhan terhadap regulasi kedisiplinan yang berlaku, akan dilakukan pembinaan secara
        bertahap dengan prosedur sebagai berikut:
    </p>
    <p class="indent-2">i. Surat Panggilan / Coaching (SPg)</p>
    <p class="indent-2">ii. Surat Peringatan I (SP-1)</p>
    <p class="indent-2">iii. Surat Peringatan II (SP-2)</p>
    <p class="indent-2">iv. Surat Peringatan III (SP-3)</p>

    <p class="indent">c. Setiap bentuk pelanggaran kedisiplinan akan dikenakan sanksi administratif
        berupa pemotongan upah sebagai berikut:</p>
    <p class="indent"><strong>Keterlambatan</strong></p>
    <p class="indent-2">- 30 - 60 menit perhari dikenakan denda sebesar 3 jam upah</p>
    <p class="indent-2">- Lebih dari 1 jam perhari dikenakan denda sebesar 1 hari upah</p>
    <p class="indent-2">Perhitungan Upah/jam = (Gaji Pokok / 173) × 50%</p>
  

@else
  <p>2. <strong>Kepatuhan Jam Kerja dan Area Kerja</strong></p>
    <p class="indent">
        Pekerja dilarang meninggalkan lingkungan atau area kerja pada waktu jam kerja tanpa izin
        tertulis dari atasan langsung, kecuali dalam keadaan darurat yang dapat dipertanggungjawabkan.
        Pekerja yang meninggalkan area kerja dengan alasan sakit wajib melaporkan kepada atasan
        langsung untuk memperoleh persetujuan.
    </p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">- Pelanggaran pertama: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran kedua: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">- Pelanggaran ketiga: Surat Peringatan Ketiga (SP III)</p>
    {{-- ========================================================= --}}
    {{-- VERSI PANJANG — 24 type lainnya                              --}}
    {{-- ========================================================= --}}
   

@endif