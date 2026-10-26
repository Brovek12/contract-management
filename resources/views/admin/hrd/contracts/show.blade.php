@extends('layouts.document')

@section('title', $contract->title)

@section('document-style')
    @include('admin.hrd.contracts.partials.show-styles')
@endsection


@section('document-content')
@include('admin.hrd.contracts.partials.show-progress', ['contract' => $contract])

@php
    $editableStatuses = ['sent', 'viewed', 'signed'];
    $isEditing = $contract->status === 'signed' && $contract->employee_signature;
    $canSign = auth()->user()->hasRole('Employee')
               && in_array($contract->status, $editableStatuses);
@endphp

{{-- =========================================================
    PAGE 1
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    <div class="doc-title"> {{ $contract->title }}</div>
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
        pihak kedua, <strong>PEKERJA.</strong>
    </p>

    <p>
        Kedua belah pihak telah sepakat untuk mengadakan suatu perjanjian kerja yang mengatur dan memuat
        syarat -- syarat kerja sebagai berikut:
    </p>

    <div class="pasal-title">PASAL 1</div>
    <div class="pasal-subtitle">MASA BERLAKU</div>

    <p>
        Pihak Perusahaan mengadakan ikatan kerja dengan pihak pekerja untuk waktu tertentu terhitung dari
        tanggal <strong>{{ $contract->start_date?->translatedFormat('d F Y') ?? '................' }}</strong>
        sampai dengan tanggal
        <strong>{{ $contract->end_date?->translatedFormat('d F Y') ?? '................' }}</strong>
    </p>

    @include('partials.document-footer')
</div>
{{-- PAGE 1 END --}}

{{-- =========================================================
    PAGE 2
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    @include('admin.hrd.contracts.partials.show-pasal2-waktu', ['contract' => $contract, 'type' => $type])
    @include('admin.hrd.contracts.partials.show-pasal3-status-pekerja', ['contract' => $contract, 'type' => $type])

    <div class="pasal-title">PASAL 4</div>
    <div class="pasal-subtitle">DOMISILI</div>

    <p>
        Pekerja diwajibkan berdomisili atau bertempat tinggal di kota daerah
        <strong>{{ $contract->domicile ?? '................' }}</strong> dan sekitarnya atas tanggungan
        sendiri dan tidak menuntut biaya transportasi tambahan.
    </p>

    <div class="pasal-title">PASAL 5</div>
    <div class="pasal-subtitle">PENDAPATAN DAN KESEJAHTERAAN PEKERJA</div>

    <p>1. Selama berlakunya Perjanjian Kerja Waktu Tertentu ini, pihak Perusahaan memberikan imbalan sebagai berikut :</p>

    @include('admin.hrd.contracts.partials.show-pasal5-gaji', ['contract' => $contract, 'type' => $type])

    <p>
        2. Semua pekerja yang telah bekerja selama 12 (dua belas) bulan berturut-turut mendapat cuti tahunan
        sebanyak 12 (dua belas) hari kerja. Hak cuti tahunan pekerja berlaku setelah masa satu tahun masa
        kerja terhitung dari waktu pekerja mulai masuk kerja. Cuti tahunan diatur sebagai berikut :
    </p>
    <p class="indent">a. Sebanyak-banyaknya 6 (enam) hari kerja atau sesusi ketentuan PT. Bukaka Teknik Utama Tbk. cabang Balikpapan ditetapkan sebagai cuti bersama (cuti masal) pada setiap Idul Fitri.</p>
</div>
{{-- PAGE 2 END --}}

{{-- =========================================================
    PAGE 3
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    <p class="indent">b. Sisanya 6 (enam) hari kerja dapat dipergunakan menurut kepentingan pribadi masing-masing pekerja.</p>
    <p class="indent">c. Apabila pada saat cuti masal di Hari Raya Idul Fitri karena kondisi pekerjaan, pekerja wajib masuk maka kehadirannya dapat diperhitungkan sebagai lembur di hari libur atau menggeser cutinya.</p>
    <p>3. <strong>Pekerja</strong> diikutsertakan dalam Program <strong>BPJS Ketenagakerjaan</strong> yang meliputi :</p>

    <p class="indent">a. Jaminan Kematian</p>
    <p class="indent">b. Jaminan Kecelakaan Kerja</p>
    <p class="indent">c. Jaminan Hari Tua</p>
    <p class="indent">d. Jaminan Pensiun</p>

    <p>
        <strong>Pekerja</strong> menanggung 2% untuk Jaminan Hari Tua dan 1% untuk Jaminan Pensiun yang
        perhitungannya berdasarkan gaji pokok (Sesuai dengan Undang -- Undang / Peraturan Pemerintah) dan
        dipotong saat pembayaran gaji.
    </p>
    <p>
        4. <strong>Pekerja</strong> diikutsertakan dalam Program <strong>BPJS Kesehatan</strong> untuk
        Jaminan Pemeliharaan Kesehatan dimana pekerja menanggung 1% dari gaji pokok (Sesuai dengan
        Undang -- Undang / Peraturan Pemerintah) dan dipotong saat pembayaran gaji.
    </p>

    <p>
        5. <strong>Pekerja</strong> mendapatkan Tunjangan Hari Raya dibayarkan dan dilaksanakan minimum
        sesuai dengan ketentuan perundang-undangan yang berlaku saat ini berdasarkan <strong>gaji pokok</strong>.
        Pekerja yang mempunyai masa kerja kurang dari 1 (satu) tahun, Tunjangan Hari Raya dihitung secara
        proporsional. Tunjangan Hari Raya dibayarkan dan dilaksanakan pada saat Hari Raya Idul Fitri
        berlaku untuk semua Pekerja yang Muslim / Non Muslim
    </p>

    @include('admin.hrd.contracts.partials.show-pasal5-attendance', ['contract' => $contract, 'type' => $type])

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 3 END --}}

{{-- =========================================================
    PAGE 4
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    <div class="pasal-title">PASAL 6</div>
    <div class="pasal-subtitle">KENAIKAN GAJI POKOK</div>

    <p>1. Kenaikan gaji pokok dilakukan sesuai dengan kondisi perusahaan pada bulan Januari tahun berjalan.</p>
    <p>2. Kenaikan gaji pokok berdasarkan pertimbangan kondisi perusahaan dan / atau melihat hasil penilaian dan evaluasi. Besarnya kenaikan gaji pokok sesuai dengan kemampuan perusahaan.</p>

    @include('admin.hrd.contracts.partials.show-pasal7-lembur', ['contract' => $contract, 'type' => $type])

    <div class="pasal-title">PASAL 8</div>
    <div class="pasal-subtitle">KETENTUAN UPAH WAKTU SAKIT</div>

    <p>
        1. Pekerja yang tidak dapat melaksanakan pekerjaannya karena sakit berhak memperoleh upah selama
        masa sakit, dengan ketentuan Pekerja wajib memberitahukan ketidakhadirannya kepada Perusahaan dan
        menyerahkan surat keterangan dokter yang sah sesuai dengan prosedur Perusahaan.
    </p>

    <p>2. Pembayaran upah selama Pekerja tidak dapat bekerja karena sakit dilakukan dengan ketentuan sebagai berikut:</p>
    <p class="indent">a. Untuk 4 (empat) bulan pertama, dibayarkan sebesar <strong>100% (seratus persen)</strong> dari upah.</p>

    @if ($contract->category === 'managerial' || $contract->category === 'non-managerial')
        <p class="indent">b. Untuk 4 (empat) bulan kedua, dibayarkan sebesar <strong>75% (tujuh puluh lima persen)</strong> dari upah.</p>
        <p class="indent">c. Untuk 4 (empat) bulan ketiga, dibayarkan sebesar <strong>50% (lima puluh persen)</strong> dari upah.</p>
        <p class="indent">d. Untuk bulan-bulan berikutnya sampai dengan dilakukannya Pemutusan Hubungan Kerja (PHK), dibayarkan sebesar <strong>25% (dua puluh lima persen)</strong> dari upah.</p>
        <p>
            3. Untuk sakit serius, menjalani rawat inap, sakit berkepanjangan, atau kondisi kesehatan tertentu,
            Pekerja menyerahkan surat keterangan dari dokter yang merawat yang menyatakan bahwa Pekerja telah
            dapat kembali bekerja.
        </p>
    @endif

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 4 END --}}

{{-- =========================================================
    PAGE 5
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    @if ($contract->category === 'managerial' || $contract->category === 'non-managerial')
        <p>
            4. Dalam hal Pekerja mengalami sakit berkepanjangan, menjalani perawatan atau pengobatan dalam jangka
            waktu yang menyebabkan Pekerja tidak dapat melaksanakan pekerjaannya sampai dengan berakhirnya jangka
            waktu PKWT, maka hubungan kerja berakhir sesuai dengan tanggal berakhirnya PKWT sebagaimana tercantum
            dalam Perjanjian Kerja. Dalam hal tersebut, Perusahaan tidak berkewajiban untuk memperpanjang atau
            memperbarui PKWT
        </p>
    @else
        <p class="indent">b. Untuk 4 (empat) bulan kedua, dibayarkan sebesar <strong>75% (tujuh puluh lima persen)</strong> dari upah.</p>
        <p class="indent">c. Untuk 4 (empat) bulan ketiga, dibayarkan sebesar <strong>50% (lima puluh persen)</strong> dari upah.</p>
        <p class="indent">d. Untuk bulan-bulan berikutnya sampai dengan dilakukannya Pemutusan Hubungan Kerja (PHK), dibayarkan sebesar <strong>25% (dua puluh lima persen)</strong> dari upah.</p>
        <p>
            3. Pekerja yang telah dinyatakan sembuh dan akan kembali bekerja wajib menyerahkan surat keterangan
            telah dapat bekerja kembali dari dokter yang merawat apabila dipersyaratkan oleh Perusahaan dan/atau User.
        </p>
    @endif

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

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 5 END --}}

{{-- =========================================================
    PAGE 6
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

  

    @if ($contract->category === 'managerial' || $contract->category === 'non-managerial')
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
        <p>3. <strong>Keselamatan, Kesehatan Kerja (K3), dan Fasilitas</strong></p>
    @endif

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
        yang melalaikan tugas dan tanggung jawab pekerjaan sehingga mengganggu produktivitas, keselamatan
        kerja, dan/atau operasional Perusahaan.
    </p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">- Pelanggaran pertama: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran kedua: Surat Peringatan Kedua (SP II)</p>

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 6 END --}}

{{-- =========================================================
    PAGE 7
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    @if ($contract->category === 'non-managerial' || $contract->category === 'managerial')
     <p class="indent-2">- Pelanggaran ketiga: Surat Peringatan Ketiga (SP III)</p>
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
    @endif

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
    <p>
        4. Khusus sanksi PHK atas pelanggaran berulang dan atau pelanggaran berat-mendesak, maka
        Perusahaan <strong>tidak berkewajiban membayarkan ganti rugi sisa masa kontrak</strong>
        sebagaimana dimaksud dalam Pasal 62 Undang-Undang Nomor 13 Tahun 2003.
    </p>

    <p><strong>A. Ketertiban dan Kepatuhan Kerja</strong></p>

    <p>
        1. <strong>Standar Penampilan:</strong> Pekerja pria dilarang berambut panjang, gondrong, atau
        menguncir rambut yang tidak sesuai dengan ketentuan kerapian dan standar penampilan Perusahaan.
    </p>
    <p class="indent">Kategori Pelanggaran: Ringan</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama (SP I)</p>

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 7 END --}}

{{-- =========================================================
    PAGE 8
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    @if ($contract->category === 'non-managerial' || $contract->category === 'managerial')
        <p class="indent-2">Pelanggaran ke-2: Surat Peringatan Kedua (SP II)</p>
        <p class="indent-2">Pelanggaran ke-3: Skorsing 1 (satu) minggu</p>
        <p>
            2. <strong>Penyalahgunaan Waktu Kerja:</strong> Pekerja dilarang berdagang bukan untuk
            kepentingan perusahaan dan tidak berkaitan dengan tugas dan tanggung jawab pekerjaan pada jam kerja.
        </p>
        <p class="indent">Kategori Pelanggaran: Sedang</p>
        <p class="indent">Sanksi:</p>
        <p class="indent-2">Pelanggaran ke-1: SP I</p>
    @endif

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

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 8 END --}}

{{-- =========================================================
    PAGE 9
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    @if ($contract->category === 'non-managerial' || $contract->category === 'managerial')
        <p class="indent">Kategori Pelanggaran: <strong>Ringan / Berat / Mendesak</strong></p>
        <p class="indent">Sanksi:</p>
        <p class="indent-2">a. Apabila berdampak ringan dan tidak menimbulkan kerugian material yang signifikan: Surat Peringatan Pertama dan Terakhir</p>
        <p class="indent-2">b. Apabila menimbulkan kerugian material besar, kecelakaan serius, gangguan operasional, potensi fatalitas, kebakaran, ledakan, atau pelanggaran K3 berat: Pemutusan Hubungan Kerja (PHK)</p>
        <p>
            8. <strong>Senjata dan Minuman Keras:</strong> Pekerja dilarang membawa, menyimpan, menggunakan,
            atau mengancam dengan senjata tajam, senjata api, maupun minuman keras di lingkungan kerja.
        </p>
    @endif

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
    

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 9 END --}}

{{-- =========================================================
    PAGE 10
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">b. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

    <p>13. Merokok pada waktu jam istirahat di area yang dilarang merokok/area terbatas di wilayah User.</p>
    <p class="indent">Sanksi:</p>

    <p class="indent-2">a. Tidak menyebabkan Kebakaran atau kerugian materil</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">b. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

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

    <p>
        16. <strong>Manipulasi MCU/Kesehatan:</strong> Pekerja dilarang memanipulasi pemeriksaan
        kesehatan atau menggunakan identitas orang lain atau diwakilkan orang lain dalam pelaksanaan
        Medical Check-Up.
    </p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>
        17. <strong>Pencurian:</strong> Terbukti mengambil barang atau aset perusahaan, kepemilikan
        pekerja lain yang bukan miliknya secara tidak sah di lingkungan kerja.
    </p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

 

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 10 END --}}

{{-- =========================================================
    PAGE 11
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')
       <p>
        18. <strong>Etika Verbal:</strong> Pekerja dilarang berkata kasar, menghina, atau merendahkan
        rekan kerja di lingkungan kerja.
    </p>
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

 

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 11 END --}}

{{-- =========================================================
    PAGE 12
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')
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


    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 12 END --}}

{{-- =========================================================
    PAGE 13
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')
     <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p

    <p><strong>E. LAIN-LAIN</strong></p>

    <p>
        32. <strong>Diskresi Perusahaan:</strong> Perbuatan atau tindakan Pekerja yang belum diatur
        secara khusus dalam aturan perusahaan atau kontrak kerja ini, namun berdasarkan penilaian
        objektif terbukti merusak citra dan atau merugikan Perusahaan, mengganggu operasional, melanggar
        kepatutan kerja, atau menimbulkan risiko terhadap keselamatan, keamanan, dan ketertiban kerja.
    </p>
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
        Pekerja bersedia sewaktu -- waktu dialih tugaskan oleh Perusahaan ke bagian / jabatan / daerah
        lain sesuai keperluan yang akan diatur kemudian.
    </p>

    <div class="pasal-title">PASAL 12</div>
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
    <p class="formula">(Masa Kerja (bulan) / 12) x Gaji Pokok).</p>

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

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 13 END --}}

{{-- =========================================================
    PAGE 14
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    <p class="indent">
        b. Pekerja membayar ganti rugi kepada Perusahaan sebesar Upah Pekerja sampai batas waktu
        berakhirnya jangka waktu PKWT berdasarkan gaji pokok. (Sesuai Pasal 17 PP 35/2021).
    </p>
    <p class="indent">
        c. Pembayaran Uang Kompensasi sebagaimana dimaksud pada butir (a) dapat diperhitungkan
        (dikompensasikan) dengan kewajiban pembayaran ganti rugi oleh Pekerja kepada Perusahaan.
    </p>

    <p>
        4. Pekerja tidak hadir selama 5 (Lima) hari dalam 1 (satu) bulan secara berturut -- turut, tanpa
        izin atau tanpa alasan yang bisa dipertanggung jawabkan dan atau telah dipanggil secara patut dan
        tertulis sebanyak 2 (dua) kali maka dapat di PHK karena mangkir (PP 35 pasal 51).
    </p>
    <p>
        5. Pekerja tidak berhak menuntut ganti rugi kontrak dan hanya akan menerima pendapatan sampai
        saat tanggal pemutusan Perjanjian Kerja Waktu Tertentu jika :
    </p>
    <p class="indent">a. Pekerja yang mengundurkan diri atau yang mangkir.</p>
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

    <div class="pasal-title">PASAL 13</div>
    <div class="pasal-subtitle">PERSELISIHAN</div>

    <p>
        Bila timbul suatu perselisihan mengenai pelaksanaan Perjanjian kerja ini, akan diselesaikan
        secara musyawarah dan kekeluargaan. Bila tidak tercapai kesepakatan maka akan diselesaikan
        menurut peraturan perundang -- undangan yang berlaku di Wilayah Republik Indonesia.
    </p>

    <table class="paraf-table">
        <tr><td colspan="2" class="paraf-title">Paraf</td></tr>
        <tr><td class="paraf-title">Karyawan</td><td class="paraf-title">HRD</td></tr>
        <tr>
            <td class="paraf-box">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image" alt="Employee Signature">
                @endif
            </td>
            <td class="paraf-box-hrd">
                @if ($contract->hrd_qr_path)
                    <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-3" alt="QR HRD Approval">
                @else
                    <div class="text-muted fs-8">Belum di-approve</div>
                @endif
            </td>
        </tr>
    </table>
</div>
{{-- PAGE 14 END --}}

{{-- =========================================================
    PAGE 15
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    <div class="pasal-title">PASAL 14</div>
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

    <div class="signature-wrapper">
        <div class="signature-column">
            <div><strong>Pekerja</strong></div>
            <div>&nbsp;</div>
            <div class="signature-space-2"></div>
            <div class="signature-image-wrapper-2">
                @if ($contract->employee_signature)
                    <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image-2" alt="Employee Signature">
                @endif
            </div>
            <div class="signature-name-2">
                {{ $contract->employee_name ?? '........................' }}
            </div>
            <div class="signature-title">&nbsp;</div>
        </div>

        <div class="signature-column">
 <div class="d-flex align-items-center mb-1">
                    <div>
                        <div class="d-flex align-items-center" style="padding-left: 50px;">
                            <!-- Teks dikunci di sini -->
                            <strong>PT BUKAKA TEKNIK UTAMA Tbk</strong>

                            <!-- Gambar dibungkus wadah dengan lebar statis agar tidak mendorong teks -->
                            <div style="width: 40px; margin-left: 10px;">
                                @if ($contract->hrd_qr_path)
                                    <img src="{{ asset('images/head_hrd_asya.jpeg') }}" alt=""
                                        style="width: 30px; height: 20px; opacity: 0.9; display: block;">
                                @endif
                            </div>
                        </div>
                        <div><strong>Cabang Balikpapan</strong></div>
                    </div>

                </div>
            <div class="signature-image-wrapper">
                @if ($contract->head_qr_path)
                    <img src="{{ asset('storage/' . $contract->head_qr_path) }}" class="signature-image-10" alt="QR Head Approval">
                @endif
            </div>
            <div class="signature-name">IR. Muslimin Sanafi</div>
            <div class="signature-title">Head Of Balikpapan Branch</div>
        </div>
    </div>

    @include('partials.document-footer')
</div>
{{-- PAGE 15 END --}}

@endsection


{{-- =========================================================
    FLOATING SIGN BUTTON
========================================================= --}}
@if ($canSign)
    <button type="button"
            class="floating-sign-btn {{ $isEditing ? 'is-edit' : '' }}"
            data-bs-toggle="modal"
            data-bs-target="#kt_modal_sign">
        <i class="ki-outline ki-pencil"></i>
        {{ $isEditing ? 'Edit Signature' : 'Sign Contract' }}
    </button>
@endif

<a href="{{ url()->previous() }}" class="floating-sign-btn-2">
    <i class="ki-outline ki-arrow-right"></i>
    Back
</a>


{{-- =========================================================
    SIGNATURE MODAL
========================================================= --}}



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
@if ($canSign)
<div class="modal fade" id="kt_modal_sign" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $isEditing ? 'Edit Tanda Tangan' : 'Tanda Tangan Contract' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="sign-contract-form"
                  action="{{ route('employee.contracts.sign', $contract->id) }}"
                  method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label fw-bold">Tanda Tangan</label>
                        <div class="signature-pad-wrapper">
                            <canvas id="signature-pad" class="signature-pad-canvas"></canvas>
                            <button type="button"
                                    id="signature-clear"
                                    class="btn btn-sm btn-light-danger signature-clear-btn">
                                <i class="ki-outline ki-trash"></i> Clear
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="signature" id="signature_data">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="agreement" id="contract-agreement">
                        <label class="form-check-label" for="contract-agreement">
                            Saya telah membaca, memahami, dan menyetujui seluruh isi Contract ini.
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-outline ki-pencil"></i>
                        {{ $isEditing ? 'Update Tanda Tangan' : 'Tandatangani Contract' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('signature-pad');
    if (!canvas) return;

    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)',
        minWidth: 0.8,
        maxWidth: 2.5
    });

    function resizeCanvas() {
        const width = canvas.offsetWidth;
        const height = canvas.offsetHeight;
        if (width === 0 || height === 0) return;
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = width * ratio;
        canvas.height = height * ratio;
        canvas.getContext('2d').setTransform(1, 0, 0, 1, 0, 0);
        canvas.getContext('2d').scale(ratio, ratio);
        signaturePad.clear();
    }

    const modal = document.getElementById('kt_modal_sign');

    modal.addEventListener('shown.bs.modal', function () {
        setTimeout(function () {
            requestAnimationFrame(function () { resizeCanvas(); });
        }, 300);
    });

    modal.addEventListener('hidden.bs.modal', function () {
        signaturePad.clear();
        document.getElementById('signature_data').value = '';
    });

    document.getElementById('signature-clear')
        .addEventListener('click', function () { signaturePad.clear(); });

    const form = document.getElementById('sign-contract-form');

    form.addEventListener('submit', function (e) {
        if (signaturePad.isEmpty()) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Tanda tangan belum ada',
                text: 'Silakan tanda tangan terlebih dahulu.'
            });
            return;
        }

        const agreement = document.getElementById('contract-agreement');
        if (!agreement.checked) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Persetujuan diperlukan',
                text: 'Silakan centang persetujuan terlebih dahulu.'
            });
            return;
        }

        document.getElementById('signature_data').value = signaturePad.toDataURL('image/png');
    });

    window.addEventListener('resize', function () {
        if (modal.classList.contains('show')) resizeCanvas();
    });
});
</script>
@endpush