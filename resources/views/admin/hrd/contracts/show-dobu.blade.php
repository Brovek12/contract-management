@extends('layouts.document')

@section('title', 'Perjanjian Kerja Waktu Tertentu')

@section('document-style')
<style>
    /* =========================================================
       RESET & BASE
    ========================================================= */

    .document-page,
    .document-page * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0 !important;
        padding: 0 !important;
        background: #e5e5e5 !important;
    }

    /* =========================================================
       A4 PAGE
    ========================================================= */

    .document-page {
        width: 210mm !important;
        height: 297mm !important;
        min-height: 297mm !important;

        margin: 0 auto 20px !important;

        background: #ffffff;

        display: block;

        position: relative;

        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12pt;
        line-height: 1.25;

        color: #000;
    }

    /* =========================================================
       TYPOGRAPHY
    ========================================================= */

    .document-page p {
        display: block;
        width: 100%;
        margin: 0 0 4px 0;
        padding: 0;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12pt;
        line-height: 1.25;
        text-align: justify;
        overflow-wrap: break-word;
    }

    .document-page h2 {
        display: block;
        margin: 0 0 6px 0;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 14pt;
        line-height: 1.2;
        text-align: center;
        font-weight: bold;
    }

    .document-page h3 {
        font-size: 12pt;
        margin: 8px 0 4px 0;
    }

    /* =========================================================
       TITLE / PASAL
    ========================================================= */

    .doc-title {
        text-align: center;
        font-weight: bold;
        font-size: 14pt;
        margin-bottom: 4px;
    }

    .doc-no {
        text-align: center;
        font-size: 12pt;
        margin-bottom: 14px;
    }

    .pasal-title {
        text-align: center;
        font-weight: bold;
        font-size: 12pt;
        margin-top: 10px;
        margin-bottom: 0;
        line-height: 1.2;
    }

    .pasal-subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 12pt;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    /* =========================================================
       INDENT
    ========================================================= */

    .indent {
        margin-left: 0 !important;
        padding-left: 8mm !important;
        text-indent: -8mm !important;
    }

    .indent-2 {
        margin-left: 0 !important;
        padding-left: 16mm !important;
        text-indent: -16mm !important;
    }

    /* =========================================================
       FORMULA
    ========================================================= */

    .formula {
        text-align: center !important;
        font-weight: bold;
        margin-top: 4px !important;
        margin-bottom: 6px !important;
    }

    /* =========================================================
       PAGE NUMBER
    ========================================================= */

    .page-number {
        position: absolute;
        top: 6mm;
        right: 10mm;
        font-size: 9pt;
    }

    /* =========================================================
       SIGNATURE
    ========================================================= */

    .signature-wrapper {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-top: 15mm;
        text-align: center;
    }

    .signature-column {
        width: 45%;
        font-size: 12pt;
        line-height: 1.3;

        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .signature-space {
        height: 20mm;
        width: 100%;
    }

    .signature-space-2 {
        height: 7mm;
        width: 100%;
    }

    .signature-image-wrapper-2 {
        height: 10mm;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2mm;

        position: relative;
        overflow: visible;
    }

    .signature-image-2 {
        display: block;
        max-width: 42mm;
        max-height: 8mm;
        object-fit: contain;

        transform: scale(2);
        transform-origin: center center;
        position: relative;
        z-index: 5;
    }

    .signature-name {
        margin-top: 2px;
        margin-bottom: 2px;
        font-weight: bold;
        text-decoration: underline;

        min-height: 1.2em;
    }

    .signature-title {
        min-height: 1.2em;
        font-style: italic;
    }

    /* =========================================================
       PARAF TABLE
    ========================================================= */

    .paraf-table {
        margin-top: 8mm;
        margin-left: auto;
        margin-right: 0;
        margin-bottom: 6mm;

        width: 45mm;

        table-layout: fixed;

        height: 18mm;

        border-collapse: collapse;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 10pt;
        line-height: 1.2;

        page-break-inside: avoid;
    }

    .paraf-table td {
        border: 1px solid #000;
        text-align: center;
        vertical-align: middle;

        padding: 1mm;

        overflow: hidden;
    }

    .paraf-table tr:first-child td {
        height: 6mm;
    }

    .paraf-table tr:last-child td {
        height: 12mm;
        width: 50%;
    }

    .paraf-table .paraf-title {
        font-weight: bold;
        height: 6mm;
    }

    .paraf-table .paraf-box {
        height: 12mm;
        width: 50%;
        vertical-align: middle;
        text-align: center;
    }

    .paraf-table .paraf-box img {
        display: block;
        margin: 0 auto;
        margin-left: -3mm;
        max-width: 140%;
        max-height: 140%;
        width: auto;
        height: auto;
        object-fit: contain;
        transform: scale(1.4);
        transform-origin: center center;
    }

    /* =========================================================
       DATA TABLE (identitas)
    ========================================================= */

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 6px 0 10px 0;
    }

    .data-table td {
        vertical-align: top;
        padding: 1px 0;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12pt;
        line-height: 1.25;
    }

    .data-table .data-label {
        width: 32mm;
        white-space: nowrap;
        font-weight: bold;
        padding-right: 2mm;
        vertical-align: top;
    }

    .data-table .data-sep {
        width: 4mm;
        text-align: center;
        vertical-align: top;
    }

    .data-table .data-value {
        vertical-align: top;
    }

    /* =========================================================
       FLOATING SIGN BUTTON
    ========================================================= */

    @keyframes floatPulse {
        0%   { box-shadow: 0 8px 24px rgba(0, 158, 247, 0.45); }
        50%  { box-shadow: 0 8px 36px rgba(0, 158, 247, 0.75); }
        100% { box-shadow: 0 8px 24px rgba(0, 158, 247, 0.45); }
    }

    .floating-sign-btn {
        position: fixed;
        right: 30px;
        bottom: 30px;
        z-index: 1050;

        display: inline-flex;
        align-items: center;
        gap: 8px;

        border: none;
        border-radius: 50px;
        padding: 14px 26px;

        background: #009ef7;
        color: #ffffff;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 13pt;
        font-weight: bold;

        box-shadow: 0 8px 24px rgba(0, 158, 247, 0.45);
        cursor: pointer;

        animation: floatPulse 2.4s ease-in-out infinite;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .floating-sign-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0, 158, 247, 0.65);
        background: #0086d1;
    }

    .floating-sign-btn-2 {
        position: fixed;
        bottom: 30px;
        left: 30px;
        z-index: 999;

        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 12px 22px;

        background: #ffffff;
        color: #3f4254;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;

        border: 1px solid #e4e6ef;
        border-radius: 50px;
        box-shadow:
            0 4px 12px rgba(0, 0, 0, 0.08),
            0 1px 3px rgba(0, 0, 0, 0.04);

        transition:
            transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1),
            box-shadow 0.25s ease,
            background 0.2s ease,
            color 0.2s ease;
    }

    .floating-sign-btn-2:hover {
        background: #3699ff;
        color: #ffffff;
        border-color: #3699ff;
        transform: translateX(-4px);
        box-shadow:
            0 6px 18px rgba(54, 153, 255, 0.35),
            0 2px 6px rgba(54, 153, 255, 0.2);
    }

    .floating-sign-btn-2:active {
        transform: translateX(-2px) scale(0.97);
    }

    .floating-sign-btn-2 i {
        font-size: 1.1rem;
        transition: transform 0.25s ease;
    }

    .floating-sign-btn-2:hover i {
        transform: translateX(3px);
    }

    .floating-sign-btn-2 i.ki-arrow-left {
        transition: transform 0.25s ease;
    }

    .floating-sign-btn-2:hover i.ki-arrow-left {
        transform: translateX(-3px);
    }

    @media (max-width: 576px) {
        .floating-sign-btn-2 {
            bottom: 20px;
            left: 20px;
            padding: 10px 18px;
            font-size: 0.85rem;
        }
    }

    /* =========================================================
       SIGNATURE PAD
    ========================================================= */

    .signature-pad-wrapper {
        position: relative;
        width: 100%;
        background: #f8f9fa;
        border: 1px dashed #b5b5c3;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 4px;
    }

    .signature-pad-canvas {
        display: block;
        width: 100%;
        height: 220px;
        cursor: crosshair;
        touch-action: none;
        background: #ffffff;
        -webkit-user-select: none;
        user-select: none;
    }

    .signature-clear-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 10;
        padding: 4px 10px;
        font-size: 12px;
        border-radius: 6px;
    }

    /* =========================================================
       MODAL SIGN
    ========================================================= */

    #kt_modal_sign .modal-dialog {
        max-width: 600px;
        width: calc(100% - 32px);
        margin: 1.75rem auto;
    }

    #kt_modal_sign .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    #kt_modal_sign .modal-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e4e6ef;
        background: #f8f9fa;
        flex-shrink: 0;
    }

    #kt_modal_sign .modal-title {
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #181c32;
    }

    #kt_modal_sign .modal-body {
        padding: 20px;
        font-family: "Arial Narrow", Arial, sans-serif;
        overflow-y: auto;
    }

    #kt_modal_sign .modal-footer {
        padding: 14px 20px;
        border-top: 1px solid #e4e6ef;
        background: #f8f9fa;
        gap: 8px;
        flex-shrink: 0;
    }

    /* =========================================================
       PRINT
    ========================================================= */

    @media print {

        @page {
            size: A4 portrait;
            margin: 0 !important;
        }

        html,
        body {
            width: 210mm !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #ffffff !important;
        }

        .document-page {
            width: 210mm !important;
            height: 297mm !important;
            min-height: 297mm !important;

            margin: 0 !important;

            page-break-after: always;
            break-after: page;

            overflow: hidden;
            position: relative;
        }

        .document-page:last-child {
            page-break-after: auto;
            break-after: auto;
        }

        .floating-sign-btn,
        .modal,
        .modal-backdrop {
            display: none !important;
        }
    }
</style>
@endsection


@section('document-content')

{{-- =========================================================
    PAGE 1 — PEMBUKAAN + PASAL 1
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="doc-title">PERJANJIAN KERJA WAKTU TERTENTU</div>
    <div class="doc-no"><strong>NO : {{ $contract->contract_number }}</strong></div>

    <p>
        Pada hari ini <strong>
            {{ $contract->contract_date?->locale('id')->translatedFormat('l') ?? '................' }}
        </strong>
        tanggal <strong>{{ $contract->contract_date?->translatedFormat('d F Y') ?? '................' }}</strong>
        di <strong>Balikpapan</strong> telah diadakan dan disepakati perjanjian kerja antara :
    </p>

    <table class="data-table">
        <tr>
            <td class="data-label">Nama</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>Muslimin Sanafi</strong></td>
        </tr>
        <tr>
            <td class="data-label">Jabatan</td>
            <td class="data-sep">:</td>
            <td class="data-value">Head Of Balikpapan Branch</td>
        </tr>
        <tr>
            <td class="data-label">Perusahaan</td>
            <td class="data-sep">:</td>
            <td class="data-value">PT Bukaka Teknik Utama Tbk. - Balikpapan</td>
        </tr>
        <tr>
            <td class="data-label">Jenis Usaha</td>
            <td class="data-sep">:</td>
            <td class="data-value">EPC (Engineering Procurement and Construction)</td>
        </tr>
        <tr>
            <td class="data-label">Alamat</td>
            <td class="data-sep">:</td>
            <td class="data-value">
                Jl. Mulawarman Km. 21 Manggar
                <br>
                Balikpapan – Kalimantan Timur
            </td>
        </tr>
    </table>

    <p style="text-align: center;"><strong>Balikpapan -- Kalimantan Timur</strong></p>

    <p>
        Dalam perjanjian kerja ini bertindak untuk dan atas nama Perusahaan PT. Bukaka Teknik Utama Tbk
        cabang Balikpapan yang berlokasi di Balikpapan, selanjutnya disebut sebagai pihak pertama,
        <strong>PERUSAHAAN.</strong>
    </p>

    <table class="data-table">
        <tr>
            <td class="data-label">Nama</td>
            <td class="data-sep">:</td>
            <td class="data-value"><strong>{{ $contract->employee_name ?? '................' }}</strong></td>
        </tr>
        <tr>
            <td class="data-label">NIK</td>
            <td class="data-sep">:</td>
            <td class="data-value">{{ $contract->nik ?? '................' }}</td>
        </tr>
        <tr>
            <td class="data-label">Dept.</td>
            <td class="data-sep">:</td>
            <td class="data-value">{{ $contract->department ?? '................' }}</td>
        </tr>
        <tr>
            <td class="data-label">No. KTP</td>
            <td class="data-sep">:</td>
            <td class="data-value">{{ $contract->ktp_number ?? '................' }}</td>
        </tr>
        <tr>
            <td class="data-label">T T L</td>
            <td class="data-sep">:</td>
            <td class="data-value">
                {{ $contract->birth_place ?? '................' }},
                {{ $contract->birth_date?->translatedFormat('d F Y') ?? '................' }}
            </td>
        </tr>
        <tr>
            <td class="data-label">Umur</td>
            <td class="data-sep">:</td>
            <td class="data-value">{{ $contract->age_at_contract ?? '................' }}</td>
        </tr>
        <tr>
            <td class="data-label">Jenis Kelamin</td>
            <td class="data-sep">:</td>
            <td class="data-value">{{ $contract->gender ?? '................' }}</td>
        </tr>
        <tr>
            <td class="data-label">Alamat</td>
            <td class="data-sep">:</td>
            <td class="data-value">{{ $contract->address ?? '................' }}</td>
        </tr>
    </table>

    <p>
        Dalam perjanjian kerja ini bertindak untuk dan atas namanya sendiri selanjutnya disebut sebagai
        pihak kedua, <strong>KARYAWAN.</strong>
    </p>

    <p>
        Kedua belah pihak sepakat untuk mengadakan suatu perjanjian kerja yang mengatur dan memuat
        syarat -- syarat kerja sebagai berikut :
    </p>

    <div class="pasal-title">PASAL 1</div>
    <div class="pasal-subtitle">MASA BERLAKU</div>

    <p>
        Pihak Perusahaan mengadakan ikatan kerja dengan pihak pekerja untuk waktu tertentu terhitung dari
        tanggal <strong>{{ $contract->start_date?->translatedFormat('d F Y') ?? '................' }}</strong>
        sampai dengan tanggal
        <strong>{{ $contract->end_date?->translatedFormat('d F Y') ?? '................' }}</strong>
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

    @include('partials.document-footer')

</div>


{{-- =========================================================
    PAGE 2 — PASAL 2 (HARI & JAM KERJA)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">2</div>

  @include('admin.hrd.contracts.partials.show-pasal2-waktu', ['contract' => $contract, 'type' => $type])

      <div class="pasal-title">PASAL 3</div>
    <div class="pasal-subtitle">STATUS KARYAWAN</div>

    <p>
        Pihak Karyawan menerima status yang diberikan pihak Bukaka sebagai
        <strong>{{ $contract->position ?? '................' }}</strong>
        ditempatkan di Offshore / Onshore – All Area PHKT (Pertamina Hulu Kalimantan Timur)
        dan / atau di project PT. Bukaka Teknik Utama.
    </p>

    <div class="pasal-title">PASAL 4</div>
    <div class="pasal-subtitle">DOMISILI</div>

    <p>
        Karyawan diwajibkan berdomisili atau bertempat tinggal di daerah
        <strong>{{ $contract->domicile ?? '................' }}</strong>
        atas tanggungan sendiri dan tidak menuntut biaya transportasi tambahan.
    </p>
      <div class="pasal-title">PASAL 5</div>
    <div class="pasal-subtitle">PENDAPATAN DAN KESEJAHTERAAN KARYAWAN</div>

    <p>1. Selama berlakunya Perjanjian Kerja Waktu Tertentu ini, pihak Perusahaan memberikan imbalan sebagai berikut :</p>

    @include('admin.hrd.contracts.partials.show-pasal5-gaji', ['contract' => $contract, 'type' => $type])

    <p>
        2. Semua Karyawan yang telah bekerja selama 12 (dua belas) bulan berturut-turut mendapat
        cuti tahunan sebanyak 12 (dua belas) hari kerja. Hak cuti tahunan Karyawan berlaku setelah
        masa satu tahun masa kerja terhitung dari waktu Karyawan mulai masuk kerja.
    </p>

    
    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 4 — PASAL 5 (PENDAPATAN) bagian awal
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">3</div>
    <p>3. Karyawan diikutsertakan dalam Program BPJS Ketenagakerjaan yang meliputi :</p>
    <p class="indent">a. Jaminan Kematian (0,3% oleh perusahaan)</p>
    <p class="indent">b. Jaminan Kecelakaan Kerja (1,27% oleh perusahaan)</p>
    <p class="indent">c. Jaminan Hari Tua (3,7% oleh perusahaan dan 2% oleh Karyawan)</p>
    <p class="indent">d. Jaminan Pensiun (2% oleh perusahaan dan 1% oleh Karyawan)</p>


  
    <p>
        Perhitungan untuk jaminan BPJS Ketenagakerjaan berdasarkan dari gaji pokok
        (Sesuai dengan Undang – Undang / Peraturan Pemerintah).
    </p>

    <p>
        4. Karyawan diikutsertakan dalam Program BPJS Kesehatan untuk Jaminan Pemeliharaan Kesehatan
        dimana Perusahaan menanggung 4% dan Karyawan menanggung 1% dari gaji pokok
        (Sesuai dengan Undang – Undang / Peraturan Pemerintah) dan dipotong saat pembayaran gaji.
    </p>
     <p>
        5. Pekerja mendapatkan Tunjangan Hari Raya dibayarkan dan dilaksanakan minimum sesuai dengan
        ketentuan perundang-undangan yang berlaku saat ini berdasarkan gaji pokok. Pekerja yang
        mempunyai masa kerja kurang dari 1 (satu) tahun, Tunjangan Hari Raya dihitung secara proporsional.
        Tunjangan Hari Raya dibayarkan dan dilaksanakan pada saat Hari Raya Idul Fitri berlaku untuk
        semua Pekerja yang Muslim / Non Muslim.
    </p>

    <p>
        6. Gaji, dan Lembur (bila ada) dibayarkan pada tanggal <strong>09</strong> setiap bulannya, dengan
        periode perhitungan tanggal 01 – 30/31 bulan sebelumnya, dengan ketentuan sebagai berikut:
    </p>
    <p class="indent">a. Apabila tanggal 09 jatuh pada hari Sabtu, maka Upah dibayarkan pada tanggal 08 (hari Jumat)</p>
    <p class="indent">b. Apabila tanggal 09 jatuh pada hari Minggu, maka Upah akan dibayarkan pada tanggal 10 (hari Senin)</p>

    <p>7. Potongan Ketidakhadiran dan Keterlambatan</p>
    <p class="indent">
        a. Pekerja yang tidak masuk bekerja tanpa pemberitahuan dihari pertama serta tidak menunjukkan
        surat keterangan sakit dari dokter atau surat izin pada hari berikutnya maka dikategorikan
        Alpa dan upah akan dipotong dengan formula sebagai berikut:
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
        Keterangan sakit dari dokter namun sudah menginformasikan kepada atasan maka karyawan dianggap izin.
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
     <p>
        8. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh <strong>Karyawan</strong> untuk
        kemudian disetorkan ke Kas Negara.
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>





{{-- =========================================================
    PAGE 6 — PASAL 6 (LEMBUR)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">4</div>

    <div class="pasal-title">PASAL 6</div>
    <div class="pasal-subtitle">KETENTUAN LEMBUR</div>

    <p>
        1. Karyawan bersedia untuk bekerja lebih dari jam kerja dan jadwal kerja yang telah ditetapkan
        pada Pasal 2 diatas sebagai kerja lembur bilamana Perusahaan memandang perlu berdasarkan perintah
        Perusahaan, demikian pula halnya Karyawan bersedia kerja lembur pada hari – hari pada saat
        istirahat (hari libur).
    </p>

    <p>
        2. Perusahaan akan membayar upah lembur karyawan sesuai dengan jam kerja lembur yang dilakukan
        oleh Karyawan berdasarkan catatan lembur dan dibayarkan sesuai dengan perhitungan jam lembur
        yang ditetapkan sebagai berikut:
    </p>

    <p class="indent">a. Perhitungan Upah lembur pada hari kerja :</p>
    <p class="indent-2">Jam Pertama : 1,5 x Gaji Pokok : 173 per jam</p>
    <p class="indent-2">Jam Kedua dst : 2 x Gaji Pokok : 173 per jam</p>

    <p class="indent">b. Perhitungan Upah lembur pada hari libur :</p>
    <p class="indent-2">Tujuh Jam Pertama : 2 x Gaji Pokok : 173 per jam</p>
    <p class="indent-2">Jam Kedelapan : 3 x Gaji Pokok : 173 per jam</p>
    <p class="indent-2">Jam Kesembilan dst : 4 x Gaji Pokok : 173 per jam</p>

    <div class="pasal-title">PASAL 7</div>
    <div class="pasal-subtitle">KETENTUAN UPAH WAKTU SAKIT</div>

    <p>
        1. Pekerja yang tidak dapat melaksanakan pekerjaannya karena sakit berhak memperoleh upah selama
        masa sakit, dengan ketentuan Pekerja wajib memberitahukan ketidakhadirannya kepada Perusahaan dan
        menyerahkan surat keterangan dokter yang sah sesuai dengan prosedur Perusahaan.
    </p>

    <p>2. Pembayaran upah selama Pekerja tidak dapat bekerja karena sakit dilakukan dengan ketentuan sebagai berikut:</p>
    <p class="indent">a. Untuk 4 (empat) bulan pertama, dibayarkan sebesar <strong>100% (seratus persen)</strong> dari upah.</p>
    <p class="indent">b. Untuk 4 (empat) bulan kedua, dibayarkan sebesar <strong>75% (tujuh puluh lima persen)</strong> dari upah.</p>
    <p class="indent">c. Untuk 4 (empat) bulan ketiga, dibayarkan sebesar <strong>50% (lima puluh persen)</strong> dari upah.</p>
    <p class="indent">d. Untuk bulan-bulan berikutnya sampai dengan dilakukannya Pemutusan Hubungan Kerja (PHK), dibayarkan sebesar <strong>25% (dua puluh lima persen)</strong> dari upah.</p>

    <p>
        3. Untuk sakit serius, menjalani rawat inap, sakit berkepanjangan, atau kondisi kesehatan tertentu,
        Pekerja menyerahkan surat keterangan dari dokter yang merawat yang menyatakan bahwa Pekerja telah
        dapat kembali bekerja.
    </p>

    <p>
        4. Dalam hal Pekerja mengalami sakit berkepanjangan, menjalani perawatan atau pengobatan dalam
        jangka waktu yang menyebabkan Pekerja tidak dapat melaksanakan pekerjaannya sampai dengan
        berakhirnya jangka waktu PKWT, maka hubungan kerja berakhir sesuai dengan tanggal berakhirnya
        PKWT sebagaimana tercantum dalam Perjanjian Kerja. Dalam hal tersebut, Perusahaan tidak
        berkewajiban untuk memperpanjang atau memperbarui PKWT.
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>





{{-- =========================================================
    PAGE 8 — PASAL 8 (PAKAIAN & SEPATU KERJA)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">5</div>

    @include('admin.hrd.contracts.partials.show-dobu-pasal8', ['contract' => $contract])
    <div class="pasal-title">PASAL 9</div>
    <div class="pasal-subtitle">PENEGAKAN DISIPLIN</div>

    <p><strong>1. Ketidakhadiran Tanpa Izin dan Mangkir</strong></p>
    <p class="indent"><strong>a. Ketidakhadiran Tidak Berturut-turut (Akumulatif)</strong></p>

    <p class="indent">
        Pekerja dilarang tidak masuk kerja tanpa izin dari atasan langsung dan/atau pihak User. Setiap
        ketidakhadiran tanpa izin atau tanpa keterangan tertulis yang sah yang terjadi
        <strong>tidak secara berturut-turut</strong> dan <strong>terakumulasi dalam jangka waktu 1 (satu)
        bulan periode berjalan</strong> dikualifikasikan sebagai pelanggaran disiplin kerja.
    </p>

    <p class="indent">Sanksi:</p>
    <p class="indent-2">- Pelanggaran pertama: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran kedua: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">- Pelanggaran ketiga: Surat Peringatan Ketiga (SP III)</p>

    <p class="indent"><strong>b. Ketidakhadiran Berturut-turut (Mangkir)</strong></p>
    <p class="indent">
        Dalam hal Pekerja tidak masuk kerja selama <strong>5 (lima) hari kerja atau lebih secara
        berturut-turut tanpa izin atau keterangan tertulis yang sah</strong>, dan setelah dilakukan
        pemanggilan secara patut dan tertulis <strong>sebanyak 2 (dua) kali</strong> kepada Pekerja
        (pemanggilan pertama minimal hari ke-3; pemanggilan kedua minimal hari ke-4), maka Perusahaan
        dapat melakukan Pemutusan Hubungan Kerja (PHK) dengan alasan mangkir (pelanggaran disiplin oleh
        Pekerja) sesuai ketentuan Pasal 51 Peraturan Pemerintah Nomor 35 Tahun 2021.
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>



{{-- =========================================================
    PAGE 10 — PASAL 9 lanjutan
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">6</div>

    <p>2. <strong>Kepatuhan Jam Kerja dan Area Kerja</strong></p>
    <p class="indent">
        Pekerja dilarang meninggalkan lingkungan atau area kerja pada waktu jam kerja tanpa izin tertulis
        dari atasan langsung, kecuali dalam keadaan darurat yang dapat dipertanggungjawabkan. Pekerja
        yang meninggalkan area kerja dengan alasan sakit wajib melaporkan kepada atasan langsung untuk
        memperoleh persetujuan.
    </p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">- Pelanggaran pertama: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran kedua: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">- Pelanggaran ketiga: Surat Peringatan Ketiga (SP III)</p>

    <p>3. <strong>Keselamatan, Kesehatan Kerja (K3), dan Fasilitas</strong></p>
    <p class="indent">
        Setiap Pekerja Lapangan wajib mematuhi seluruh ketentuan keselamatan dan kesehatan kerja (K3),
        termasuk kewajiban menggunakan Alat Pelindung Diri (APD/PPE) secara lengkap dan benar serta
        mengenakan tanda pengenal (ID Card) resmi yang dikeluarkan oleh Perusahaan dan/atau User selama
        berada di area kerja.
    </p>
    <p>Sanksi :</p>
    <p class="indent-2">- Pelanggaran ke-1: Teguran tertulis</p>
    <p class="indent-2">- Pelanggaran ke-2: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran ke-3: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">- Pelanggaran ke-4: Surat Peringatan Ketiga (SP III)</p>

    <p>4. <strong>Ketertiban dan Keamanan Perusahaan</strong></p>
    <p class="indent">
        Pekerja bersedia dilakukan pemeriksaan barang bawaan oleh petugas keamanan (security) pada saat
        memasuki dan/atau meninggalkan lingkungan kerja sepanjang dilakukan secara wajar dan sesuai
        dengan standar operasional prosedur Perusahaan.
    </p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">- Pelanggaran pertama: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran kedua: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">- Pelanggaran ketiga: Surat Peringatan Ketiga (SP III)</p>

    <p>5. <strong>Larangan Tidur dan Kelalaian di Jam Kerja</strong></p>
    <p class="indent">
        Pekerja dilarang tidur pada jam kerja di luar waktu istirahat atau melakukan aktivitas pribadi
        yang melalaikan tugas dan tanggung jawab pekerjaan sehingga mengganggu produktivitas,
        keselamatan kerja, dan/atau operasional Perusahaan.
    </p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">- Pelanggaran pertama: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran kedua: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">- Pelanggaran ketiga: Surat Peringatan Ketiga (SP III)</p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 11 — PASAL 9 (lanjutan poin 6) + PASAL 10 (awal)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">7</div>

    <p>6. <strong>Kewajiban Pemutakhiran Data Pekerja</strong></p>
    <p class="indent">
        Pekerja wajib memberikan keterangan tertulis kepada Perusahaan mengenai setiap perubahan data
        pribadi dan/atau data keluarga paling lambat 7 (tujuh) hari kalender sejak terjadinya perubahan
        disertai dengan dokumen pendukung yang sah berdampak pada administrasi ketenagakerjaan, termasuk
        namun tidak terbatas pada:
    </p>
    <p class="indent">1. Perubahan alamat tempat tinggal dan/atau domisili;</p>
    <p class="indent">2. Perubahan nomor telepon dan/atau alamat surat elektronik (email);</p>
    <p class="indent">3. Perubahan status perkawinan;</p>
    <p class="indent">4. Kelahiran anak;</p>
    <p class="indent">5. Kematian anggota keluarga inti;</p>
    <p class="indent">6. Perubahan identitas kependudukan (ktp, kk, atau dokumen sejenis);</p>
    <p class="indent">7. Perubahan data rekening bank untuk pembayaran upah;</p>
    <p class="indent">8. Perubahan pihak yang menjadi ahli waris atau penerima manfaat hak ketenagakerjaan.</p>
    <p><strong>Sanksi :</strong> Surat Peringatan Pertama (SP I)</p>

    <div class="pasal-title">PASAL 10</div>
    <div class="pasal-subtitle">PELANGGARAN TATA TERTIB</div>

    <p><strong>Ketentuan Umum:</strong></p>
    <p>
        1. Setiap Pekerja wajib mematuhi seluruh tata tertib, kode etik, serta standar prosedur kerja
        Perusahaan, termasuk kepatuhan penuh terhadap aturan <strong>HSE (<em>Health, Safety, and
        Environment</em>)</strong> demi menjamin keselamatan jiwa, keamanan aset, dan kelestarian
        lingkungan kerja.
    </p>
    <p>
        2. Pelanggaran terhadap ketentuan ini dikenakan sanksi sesuai tingkat kesalahan dan dampaknya,
        mulai dari <strong>Surat Peringatan (SP I, II, III), Skorsing, hingga Pemutusan Hubungan Kerja
        (PHK)</strong>, berdasarkan regulasi ketenagakerjaan yang berlaku serta kebijakan internal
        Perusahaan.
    </p>
     <p>
        3. Khusus untuk jenis pelanggaran yang diklasifikasikan sebagai <strong>Pelanggaran
        Mendesak</strong>, Perusahaan berhak menjatuhkan sanksi <strong>Pemutusan Hubungan Kerja
        (PHK)</strong> secara langsung tanpa melalui tahapan pemberian Surat Peringatan secara
        berturut-turut, sebagaimana diatur dalam <strong>Pasal 52 ayat (2) Peraturan Pemerintah No. 35
        Tahun 2021</strong>.
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 12 — PASAL 10 lanjutan (Ketentuan Umum 3-4 + A. Ketertiban)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">8</div>

   
    <p>
        4. Khusus sanksi PHK atas pelanggaran berulang dan atau pelanggaran berat-mendesak, maka
        Perusahaan <strong>tidak berkewajiban membayarkan ganti rugi sisa masa kontrak</strong>
        sebagaimana dimaksud dalam Pasal 62 Undang-Undang Nomor 13 Tahun 2003.
    </p>

    <h3>A. Ketertiban dan Kepatuhan Kerja</h3>

    <p>
        1. <strong>Standar Penampilan:</strong> Pekerja pria dilarang berambut panjang, gondrong, atau
        menguncir rambut yang tidak sesuai dengan ketentuan kerapian dan standar penampilan Perusahaan.
    </p>
    <p class="indent">Kategori Pelanggaran: Ringan</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">Pelanggaran ke-2: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">Pelanggaran ke-3: Skorsing 1 (satu) minggu</p>

    <p>
        2. <strong>Penyalahgunaan Waktu Kerja:</strong> Pekerja dilarang berdagang bukan untuk
        kepentingan perusahaan dan tidak berkaitan dengan tugas dan tanggung jawab pekerjaan pada jam kerja.
    </p>
    <p class="indent">Kategori Pelanggaran: Sedang</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: SP I</p>
    <p class="indent-2">Pelanggaran ke-2: SP II</p>
    <p class="indent-2">Pelanggaran ke-3: SP III atau Skorsing</p>

    <p>
        3. <strong>Insubordinasi:</strong> Pekerja dilarang menolak atau mengabaikan perintah atasan
        yang sah dan berkaitan langsung dengan pelaksanaan tugas pekerjaan.
    </p>
    <p class="indent">Kategori Pelanggaran: Sedang</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: SP I</p>
    <p class="indent-2">Pelanggaran ke-2: SP II</p>
    <p class="indent-2">Pelanggaran ke-3: SP III atau Skorsing</p>

    <p>
        4. <strong>Mengabaikan Prosedur Kerja:</strong> Pekerja wajib mematuhi prosedur kerja sesuai
        surat edaran instruksi teknis, serta program kerja yang ditetapkan oleh Perusahaan atau User.
    </p>
    <p class="indent">Kategori Pelanggaran: Sedang - Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 13 — PASAL 10 lanjutan (5 - 9)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">9</div>

    <p>
        5. <strong>Keterangan Tidak Benar:</strong> Pekerja dilarang memberikan laporan, data, atau
        informasi yang tidak benar terkait aset, pekerjaan, atau kegiatan operasional Perusahaan.
    </p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Skorsing</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>
        6. <strong>Kerahasiaan Perusahaan:</strong> Pekerja terbukti membocorkan informasi atau rahasia
        internal Perusahaan tanpa izin yang sah.
    </p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <p>
        7. <strong>Kerusakan Materiil:</strong> Pekerja melakukan tindakan yang mengakibatkan kerusakan
        atau kerugian terhadap aset Perusahaan/User atau mempersulit kegiatan perusahaan dan atau
        menyebabkan kecelakaan kerja.
    </p>
    <p class="indent">Kategori Pelanggaran: <strong>Ringan / Berat / Mendesak</strong></p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Apabila berdampak ringan dan tidak menimbulkan kerugian material yang signifikan: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">b. Apabila menimbulkan kerugian material besar, kecelakaan serius, gangguan operasional, potensi fatalitas, kebakaran, ledakan, atau pelanggaran K3 berat: Pemutusan Hubungan Kerja (PHK)</p>

    <p>
        8. <strong>Senjata dan Minuman Keras:</strong> Pekerja dilarang membawa, menyimpan, menggunakan,
        atau mengancam dengan senjata tajam, senjata api, maupun minuman keras di lingkungan kerja.
    </p>
    <p class="indent">Kategori Pelanggaran: Berat / Mendesak</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Apabila hanya membawa: Skorsing</p>
    <p class="indent-2">b. Apabila menimbulkan kerugian material besar, kecelakaan serius, gangguan operasional, potensi fatalitas, kebakaran, ledakan, atau pelanggaran K3 berat: Pemutusan Hubungan Kerja (PHK)</p>

    <p>
        9. <strong>Narkotika:</strong> Pekerja dilarang membawa, menyimpan, menjual, membeli, atau
        mengonsumsi narkotika dan zat adiktif terlarang di dalam maupun di luar lingkungan kerja.
    </p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

     <p><strong>B. LARANGAN MEROKOK (K3 &amp; ZERO ACCIDENT)</strong></p>

    <p>10. Merokok pada waktu jam kerja di area yang dilarang merokok/ area terbatas di Office &amp; Workshop.</p>
    <p class="indent">Kategori Pelanggaran: Berat / Mendesak</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Tidak menyebabkan Kebakaran atau kerugian materil</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
   

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 14 — PASAL 10 lanjutan (B. Larangan Merokok + C. Perilaku)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">10</div>
     <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">b. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

   

    <p>11. Merokok pada waktu jam istirahat di area yang dilarang merokok/ area terbatas di Office &amp; Workshop</p>
    <p class="indent">Kategori Pelanggaran: Berat / Mendesak</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Tidak menyebabkan Kebakaran atau kerugian materil</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">b. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

    <p>12. Merokok pada waktu jam kerja di area yang dilarang merokok/area terbatas di wilayah User.</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Tidak menyebabkan Kebakaran atau kerugian materil</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">b. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

    <p>13. Merokok pada waktu jam istirahat di area yang dilarang merokok/area terbatas di wilayah User.</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Tidak menyebabkan Kebakaran atau kerugian materil</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">d. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

    <p><strong>C. PERILAKU, ETIKA &amp; INFORMASI ELEKTRONIK</strong></p>

    <p>
        14. <strong>Penggunaan Perangkat Elektronik Terlarang:</strong> Pekerja membawa, menggunakan HP
        atau perangkat elektronik sejenis di area yang dilarang/ area terbatas yang ditetapkan Perusahaan/User.
    </p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>
        15. <strong>Pemalsuan Administrasi:</strong> Pekerja dilarang menggunakan atau menyerahkan
        dokumen palsu (ijazah, sertifikat, surat keterangan dokter atau surat keterangan resmi lainnya)
        yang berhubungan dengan prosedur kerja atau kepentingan hubungan kerja.
    </p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 15 — PASAL 10 lanjutan (16 - 22)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">11</div>

    <p>
        16. <strong>Manipulasi MCU/Kesehatan:</strong> Pekerja dilarang memanipulasi pemeriksaan
        kesehatan atau menggunakan identitas orang lain atau diwakilkan orang lain dalam pelaksanaan
        Medical Check-Up.
    </p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>17. <strong>Pencurian:</strong> Terbukti mengambil barang atau aset perusahaan, kepemilikan pekerja lain yang bukan miliknya secara tidak sah di lingkungan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <p>18. <strong>Etika Verbal:</strong> Pekerja dilarang berkata kasar, menghina, atau merendahkan rekan kerja di lingkungan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Ringan</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>19. <strong>Vandalisme:</strong> Merusak atau mencoret fasilitas Perusahaan/User secara sengaja.</p>
    <p class="indent">Kategori Pelanggaran: Sedang</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Skorsing maksimal 1 (satu) minggu</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>20. <strong>Intimidasi:</strong> Mengancam secara fisik atau psikis terhadap atasan, bawahan, rekan kerja, atau keluarganya.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Skorsing maksimal 2 (dua) minggu</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>21. <strong>Perjudian</strong>: Terbukti melakukan kegiatan perjudian dalam bentuk apa pun di lingkungan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <p>22. <strong>Perbuatan Asusila:</strong> Terbukti melakukan pelecehan, tindakan tidak bermoral, pornografi, atau pornoaksi kepada rekan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 16 — PASAL 10 lanjutan (23 - 28)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">12</div>

    <p>23. <strong>Kekerasan Fisik:</strong> Berkelahi, memukul, melukai orang lain, membunuh, atau melakukan tindak pidana hukum lainnya baik rekan kerja maupun keluarganya baik di lingkungan kerja ataupun diluar lingkungan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <p>24. <strong>Pelanggaran Akses:</strong> Memasuki area Perusahaan di luar jam kerja tanpa izin atasan atau pimpinan perusahaan.</p>
    <p class="indent">Kategori Pelanggaran: Ringan → Sedang</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: SP I</p>
    <p class="indent-2">Pelanggaran ke-2: SP II</p>
    <p class="indent-2">Pelanggaran ke-3: SP III</p>
    <p class="indent-2">Pelanggaran ke-4: PHK</p>

    <p>25. <strong>Kecerobohan Alat Kerja</strong>: Menggunakan peralatan/perangkat kerja, bahan-bahan baku serta barang lain milik perusahaan/user secara sengaja ceroboh hingga menimbulkan kerusakan atau kerugian bagi perusahaan.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Skorsing minimal 1 (satu) minggu</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>26. <strong>Pembangkangan Medis:</strong> Menolak perintah melakukan pemeriksaan kesehatan atau MCU dan atau tidak mematuhi petunjuk dokter.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>27. <strong>Penyalahgunaan Atribut Kerja:</strong> Meminjamkan atau mengalihkan APD/seragam kepada pihak luar tanpa izin.</p>
    <p class="indent">Kategori Pelanggaran: Ringan</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>28. <strong>Hasutan Pelanggaran:</strong> Mengajak, menghasut atau membantu Pekerja lain melanggar tata tertib.</p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 17 — PASAL 10 lanjutan (29 - 32) + PASAL 11 (ALIH TUGAS)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">13</div>

    <p>29. <strong>Kelalaian Tugas:</strong> Lalai menjalankan tugas hingga menimbulkan kerugian bagi Perusahaan.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>30. <strong>Persaingan Usaha:</strong> Melakukan usaha sejenis dengan Perusahaan dan atau memanfaatkan fasilitas perusahaan untuk mendukung usaha pribadi selama masih terikat hubungan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Sedang-Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>31. <strong>Tindak Pidana:</strong> Pekerja dinyatakan bersalah melakukan tindak criminal/pidana berdasarkan putusan aparat penegak hukum.</p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <p><strong>E. LAIN-LAIN</strong></p>

    <p>32. <strong>Diskresi Perusahaan:</strong> Perbuatan atau tindakan Pekerja yang belum diatur secara khusus dalam aturan perusahaan atau kontrak kerja ini, namun berdasarkan penilaian objektif terbukti merusak citra dan atau merugikan Perusahaan, mengganggu operasional, melanggar kepatutan kerja, atau menimbulkan risiko terhadap keselamatan, keamanan, dan ketertiban kerja.</p>
    <p class="indent">Kategori Pelanggaran: <strong>Ringan → Mendesak</strong></p>
    <p class="indent">Sanksi:</p>
    <p class="indent">
        Surat Peringatan Pertama (SP I) sampai dengan Pemutusan Hubungan Kerja (PHK) ataupun PHK
        Langsung (tanpa urutan SP -- pelanggaran mendesak), dengan memperhatikan tingkat kesalahan,
        dampak yang ditimbulkan, dan ketentuan peraturan perundang-undangan yang berlaku.
    </p>

    <div class="pasal-title">PASAL 11</div>
    <div class="pasal-subtitle">ALIH TUGAS</div>

    <p>
        Karyawan bersedia sewaktu -- waktu dialih tugaskan oleh Perusahaan ke bagian / jabatan / daerah
        lain sesuai keperluan yang akan diatur kemudian.
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 18 — PASAL 12 (KELONGGARAN)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">14</div>
@include('admin.hrd.contracts.partials.show-dobu-pasal12', ['contract' => $contract, 'type' => $type])

    <div class="pasal-title">PASAL 13</div>
    <div class="pasal-subtitle">AKHIR PERJANJIAN KERJA</div>

    <p>
        1. Perusahaan memberikan Uang Kompensasi kepada Pekerja pada saat berakhirnya Perjanjian Kerja
        Waktu Tertentu ini dengan aturan sebagai berikut:
    </p>

    <p class="indent">
        a. Uang Kompensasi diberikan kepada Pekerja yang telah mempunyai masa kerja paling sedikit 1
        (satu) bulan secara terus menerus.
    </p>

    <p class="indent">
        b. Perhitungan besaran Uang Kompensasi adalah proporsional sesuai dengan masa kerja yang telah
        dijalani, dengan menggunakan formula yang ditetapkan dalam Peraturan Pemerintah Nomor 35 Tahun
        2021 yaitu:
    </p>

    <p class="formula">(Masa Kerja (bulan) / 12) x Gaji Pokok)</p>

    <p>
        2. Apabila Perusahaan mengakhiri Hubungan Kerja sebelum berakhirnya jangka waktu yang ditetapkan
        dalam Perjanjian ini, dan pengakhiran tersebut bukan disebabkan oleh pelanggaran disiplin dan
        tata tertib perusahaan, maka:
    </p>
    <p class="indent">
        a. Perusahaan memberikan Uang Kompensasi kepada Pekerja yang besarnya dihitung berdasarkan
        jangka waktu PKWT yang telah dilaksanakan oleh Pekerja (sesuai poin 1).
    </p>
    <p class="indent">
        b. Perusahaan membayar ganti rugi kepada Pekerja sebesar Upah Pekerja sampai batas waktu
        berakhirnya jangka waktu PKWT berdasarkan gaji pokok. (Sesuai Pasal 62 UU Ketenagakerjaan).
    </p>
      <p>
        3. Apabila Pekerja mengundurkan diri atas kemauan sendiri atau dianggap mengundurkan diri oleh
        perusahaan sebelum berakhirnya jangka waktu yang ditetapkan dalam Perjanjian ini, maka:
    </p>
    <p class="indent">
        a. Pekerja berhak atas Uang Kompensasi yang besarnya dihitung berdasarkan jangka waktu PKWT yang
        telah dilaksanakan oleh Pekerja (sesuai poin 1).
    </p>
    <p class="indent">
        b. Pekerja membayar ganti rugi kepada Perusahaan sebesar Upah Pekerja sampai batas waktu
        berakhirnya jangka waktu PKWT berdasarkan gaji pokok. (Sesuai Pasal 17 PP 35/2021).
    </p>
    <p class="indent">
        c. Pembayaran Uang Kompensasi sebagaimana dimaksud pada butir (a) dapat diperhitungkan
        (dikompensasikan) dengan kewajiban pembayaran ganti rugi oleh Pekerja kepada Perusahaan.
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>



{{-- =========================================================
    PAGE 20 — PASAL 13 lanjutan
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">14</div>

    <p>
        4. Pekerja tidak hadir selama 5 (Lima) hari dalam 1 (satu) bulan secara berturut -- turut, tanpa
        izin atau tanpa alasan yang bisa dipertanggung jawabkan dan atau telah dipanggil secara patut dan
        tertulis sebanyak 2 (dua) kali maka <strong>diklasifikasikan mengundurkan diri</strong>.
    </p>

    <p>
        5. Pekerja tidak berhak menuntut ganti rugi kontrak dan hanya akan menerima pendapatan sampai
        saat tanggal pemutusan Perjanjian Kerja Waktu Tertentu jika :
    </p>
    <p class="indent">a. Pekerja yang mengundurkan diri atau yang diklasifikasikan mengundurkan diri.</p>
    <p class="indent">
        b. Pekerja telah terbukti sah melakukan pelanggaran pasal disiplin dan tata tertib perusahaan
        dengan sanksi PHK, melalui bukti temuan atau dokumen perusahaan atau surat pendukung lainnya yang
        dapat dipertanggungjawabkan secara hukum.
    </p>
    <p class="indent">
        c. Atau, Pekerja telah terbukti sah melakukan pelanggaran disiplin dan tata tertib dengan sanksi
        PHK berdasarkan putusan pengadilan yang berkekuatan hukum tetap jika diperlukan (kategori kasus
        kriminal/penipuan dalam undang-undang pidana/perdata).
    </p>

    <p>6. Pemberitahuan pengunduran diri diberikan kepada Perusahaan selambat -- lambatnya 30 (tiga puluh) hari sebelumnya.</p>

    <p>
        7. Pekerja yang mengundurkan diri wajib menyelesaikan tanggungjawab pekerjaan / alih tugas
        kepada pekerja yang ditunjuk atasan.
    </p>

    <p>
        8. Apabila masa kerja Pekerja memenuhi persyaratan saat akhir hubungan kerja, maka Pekerja akan
        mendapatkan uang pengganti hak sesuai dengan Pasal 40 ayat (4) pada PP No. 35 Tahun 2021.
    </p>

    <p>
        9. Hasil Medical Check Up dinyatakan <em>UN-FIT</em> oleh dokter / user, sehingga Pekerja tidak
        dapat melakukan pekerjaan, maka perusahaan berhak untuk melakukan pemutusan perjanjian kerja ini
        yang penyelesaiannya berpedoman pada ketentuan perundang-undangan yang berlaku.
    </p>

    <p>
        10. Hasil evaluasi Pekerja dinilai tidak mampu dan tidak cakap oleh Perusahaan / User dalam
        melaksanakan tugasnya dan sudah di tempatkan di bidang lain yang sesuai apabila ada, dan / atau
        melanggar tata tertib yang ditetapkan oleh Perusahaan / User.
    </p>

    <p>11. Pekerja terikat perjanjian kerja dengan perusahaan lain.</p>
    <p>12. Pekerja Meninggal dunia.</p>
    <div class="pasal-title">PASAL 14</div>
    <div class="pasal-subtitle">PERSELISIHAN</div>

    <p>
        Bila timbul suatu perselisihan mengenai pelaksanaan Perjanjian kerja ini, akan diselesaikan
        secara musyawarah dan kekeluargaan. Bila tidak tercapai kesepakatan maka akan diselesaikan
        menurut peraturan perundang -- undangan yang berlaku di Wilayah Republik Indonesia.
    </p>

    <table class="paraf-table">
        <tr>
            <td colspan="2" class="paraf-title">Paraf</td>
        </tr>
        <tr>
            <td class="paraf-title">Karyawan</td>
            <td class="paraf-title">HRD</td>
        </tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image"
                         alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box">
                @if ($contract->hrd_signature)
                    <img src="{{ asset('storage/' . $contract->hrd_signature) }}"
                         class="signature-image"
                         alt="HRD Signature">
                @endif
            </td>
        </tr>
    </table>

</div>


{{-- =========================================================
    PAGE 21 — PASAL 14 (PERSELISIHAN) + PASAL 15 (KETENTUAN LAIN)
========================================================== --}}
<div class="document-page">

    @include('partials.document-header')

    <div class="page-number">15</div>

    

    <div class="pasal-title">PASAL 15</div>
    <div class="pasal-subtitle">KETENTUAN LAIN</div>

    <p>1. <strong>Perpanjangan atau Pembaruan Perjanjian Kerja</strong></p>
    <p class="indent">
        Apabila menjelang berakhirnya masa berlaku Perjanjian Kerja ini Perusahaan menilai masih
        memerlukan Pekerja, maka Perusahaan akan memberitahukan kepada Pekerja sebelum Perjanjian Kerja
        ini berakhir untuk dilakukan perpanjangan atau pembaruan Perjanjian Kerja sesuai dengan ketentuan
        peraturan perundang-undangan yang berlaku.
    </p>

    <p>2. <strong>Kondisi Pekerjaan dan Penempatan Pekerja</strong></p>
    <p class="indent">
        Apabila terjadi penundaan, masa menunggu, atau pengurangan pekerjaan, baik pada kegiatan proyek
        maupun operasional kantor, maka Perusahaan berhak menempatkan Pekerja dalam kondisi <em>stand by</em>
        dengan ketentuan upah (gaji pokok) tetap dibayarkan, atau menempatkan Pekerja pada pekerjaan,
        unit kerja, lokasi, atau proyek lain sesuai dengan kebutuhan Perusahaan.
    </p>

    <p>3. <strong>Penugasan pada Pekerjaan atau Proyek Lain</strong></p>
    <p class="indent">
        Apabila suatu pekerjaan atau proyek telah selesai dan Perusahaan memperoleh pekerjaan, proyek,
        atau kegiatan lain serta membutuhkan tenaga kerja, dan kinerja Pekerja dinilai memenuhi
        persyaratan, maka Pekerja dapat ditawarkan untuk dialihkan atau dilibatkan dalam pekerjaan atau
        proyek tersebut.
    </p>

    <p>4. <strong>Tanda Tangan dan Dokumen Elektronik</strong></p>
    <p class="indent">
        Para Pihak sepakat bahwa Perjanjian Kerja ini dapat ditandatangani secara langsung maupun tidak
        langsung, termasuk melalui tanda tangan elektronik, hasil pemindaian (scan), foto, atau media
        elektronik lainnya. Tanda tangan dan dokumen tersebut diakui sah, mengikat, dan mempunyai
        kekuatan hukum yang sama dengan naskah asli sesuai dengan ketentuan peraturan perundang-undangan
        yang berlaku.
    </p>

    <p>5. <strong>Keabsahan Salinan Perjanjian Kerja</strong></p>
    <p class="indent">
        Salinan Perjanjian Kerja ini dalam bentuk hasil pemindaian (scan), fotokopi, atau dokumen
        elektronik lainnya dinyatakan sah dan dapat dipergunakan sebagai alat bukti hukum yang mengikat
        Para Pihak.
    </p>

    <p>6. <strong>Pernyataan Kesepakatan Para Pihak</strong></p>
    <p class="indent">
        Perjanjian Kerja ini disepakati dan ditandatangani oleh Para Pihak dalam keadaan sadar, sehat
        jasmani dan rohani, tanpa adanya paksaan atau tekanan dari pihak manapun. Dengan
        ditandatanganinya Perjanjian Kerja ini, Para Pihak menyatakan telah membaca, memahami, dan
        menyetujui seluruh isi Perjanjian Kerja ini.
    </p>

    {{-- SIGNATURE --}}
    <div class="signature-wrapper">
        <div class="signature-column">

            <div><strong>Karyawan</strong></div>
            <div>&nbsp;</div>

            <div class="signature-space-2"></div>

            <div class="signature-image-wrapper-2">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}"
                         class="signature-image-2"
                         alt="Employee Signature">
                @endif
            </div>

            <div class="signature-name">
                {{ $contract->employee_name ?? '........................' }}
            </div>

            <div class="signature-title">
                &nbsp;
            </div>

        </div>

        <div class="signature-column">

            <div><strong>PT BUKAKA TEKNIK UTAMA Tbk</strong></div>
            <div><strong>Cabang Balikpapan</strong></div>

            <div class="signature-space"></div>

            <div class="signature-image-wrapper">
                @if ($contract->head_signature)
                    <img src="{{ asset('storage/' . $contract->head_signature) }}"
                         class="signature-image"
                         alt="Head Signature">
                @endif
            </div>

            <div class="signature-name">
                IR. Muslimin Sanafi
            </div>

            <div class="signature-title">
                Head Of Balikpapan Branch
            </div>

        </div>
    </div>

    @include('partials.document-footer')

</div>

@endsection