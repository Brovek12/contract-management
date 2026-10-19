@extends('layouts.document')

@section('title', $contract->title)

@section('document-style')
    @include('admin.hrd.contracts.partials.show-styles-project')
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
    PAGE 1 — Header + Pihak + Pasal 1
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    <div class="doc-title">{{ $contract->title }}</div>
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
            <td class="data-value">PT. Bukaka Teknik Utama Tbk. Cabang Balikpapan</td>
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

    <p>
        Dalam perjanjian kerja ini bertindak untuk dan atas nama Perusahaan PT. Bukaka Teknik Utama Tbk.
        Cabang Balikpapan yang berlokasi di Balikpapan, selanjutnya disebut sebagai pihak pertama,
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
            <td class="data-label">UMUR</td>
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
        Kedua belah pihak telah sepakat untuk mengadakan suatu perjanjian kerja yang mengatur dan memuat
        syarat – syarat kerja sebagai berikut:
    </p>

    <div class="pasal-title">PASAL 1</div>
    <div class="pasal-subtitle">MASA BERLAKU</div>

    <p>
        Pihak Perusahaan mengadakan ikatan kerja dengan pihak Karyawan untuk waktu tertentu terhitung dari
        tanggal <strong>{{ $contract->start_date?->translatedFormat('d F Y') ?? '................' }}</strong>
        sampai dengan tanggal
        <strong>{{ $contract->end_date?->translatedFormat('d F Y') ?? '................' }}</strong>
    </p>
    
    @include('admin.hrd.contracts.partials.project.pasal2-hari-jam-kerja', [
        'contract' => $contract,
        'type'     => $type,
    ])

    @include('admin.hrd.contracts.partials.project.pasal3-status-pekerja', [
        'contract' => $contract,
        'type'     => $type,
    ])

    @include('admin.hrd.contracts.partials.project.pasal4-domisili', [
        'contract' => $contract,
        'type'     => $type,
    ])

</div>
{{-- PAGE 1 END --}}


{{-- =========================================================
    PAGE 2 — Pasal 2, 3, 4
========================================================== --}}
{{-- PAGE 2 END --}}


{{-- =========================================================
    PAGE 3 — PASAL 5: MEDICAL CHECK UP DAN TRAINING
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    @include('admin.hrd.contracts.partials.sandmon.pasal5-mcu', [
        'contract' => $contract,
        'type'     => $type,
    ])
     <div class="pasal-title">PASAL 6</div>
    <div class="pasal-subtitle">PENDAPATAN DAN KESEJAHTERAAN KARYAWAN</div>

    <p>1. Selama berlakunya Perjanjian Kerja Waktu Tertentu ini, pihak Perusahaan memberikan imbalan sesuai dengan MOU Tender SA14040807A Sand Monitoring Services for PHM) sebagai berikut :</p>

    @include('admin.hrd.contracts.partials.project.pasal5-pendapatan', [
        'contract' => $contract,
        'type'     => $type,
    ])
      <p>2. Karyawan diikutsertakan dalam Program BPJS Ketenagakerjaan yang meliputi (MOU Pasal 4 Point 12) :</p>
    <p class="indent">a. Jaminan Kematian</p>
    <p class="indent">b. Jaminan Kecelakaan Kerja</p>
    <p class="indent">c. Jaminan Hari Tua</p>
    <p class="indent">d. Jaminan Pensiun</p>

    <p>3. Karyawan diikutsertakan dalam Program BPJS Kesehatan untuk Jaminan Pemeliharaan dengan kelas rawat sesuai peraturan yang berlaku dari BPJS Kesehatan. (MOU Pasal 4 Point 12)</p>

    <p>4. Karyawan diikutsertakan dalam program jaminan kesehatan tambahan In Health Gold kelas 1A hingga anak ke 3 (tiga) (MOU Pasal 4 Point 11 Sub Point a).</p>

    <p>5. Gaji dibayarkan pada tanggal 09 setiap bulannya. Apabila tanggal 09 jatuh di Hari Libur, Maka Tanggal Penggajian akan dimajukan Dengan perhitungan satu periode timesheet dari lapangan yang telah di setujui. Apabila pembayaran gaji mengalami keterlambatan maka perusahaan akan mendapatkan sanksi terkait keterlambatan pembayaran gaji sesuai dengan Peraturan Pemerintah Nomor 36 Tahun 2021 (MOU Pasal 5 Point 3)</p>

   


    @include('partials.document-footer')
</div>
{{-- PAGE 3 END --}}




{{-- =========================================================
    PAGE 5 — PASAL 7: ALAT PELINDUNG DIRI + PASAL 8: LEMBUR
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')
     <p>6. Potongan Ketidakhadiran (MOU Pasal 4 Point 3-5)</p>
    <p class="indent">a. Jika dalam 1 periode Timesheet (14 hari kerja) Karyawan berhalangan hadir dalam keadaan sakit dengan menunjukan Surat Dokter maka Perusahaan hanya akan membayarkan Gaji Pokok + Tunjangan Tetap kepada Karyawan yang mengacu pada perhitungan pada Pasal 6 Poin 1.</p>
    <p class="indent">b. Jika dalam 1 periode Timesheet (14 hari kerja) Karyawan berhalangan hadir Karena Sakit yang di sebabkan oleh kecelakaan kerja dengan menunjukan surat dokter dan persetujuan dari Site Supervisor beserta Pertamina Hulu Mahakam (PHM) maka Perusahaan akan membayarkan THP kepada Karyawan.</p>
    <p class="indent">c. Bila dalam 1 Periode Timesheet (14 hari kerja) Karyawan hanya dapat hadir beberapa hari (kurang dari 14 hari) maka Perusahaan akan memotong EWHC dan Tunjangan Harian sesuai dengan hari yang di tinggalkan. Apabila dalam 1 Periode Timesheet Karyawan diminta hadir lebih dari 14 hari kerja, maka Perusahaan akan memberikan tambahan harian nilai EWHC sesuai dengan jumlah hari yang ditambahkan Perhitungan harian nilai EWHC dan Tunjangan Harian adalah Total dari nilai EWHC dan Tunjangan Harian dibagi 14 hari. (Pengecualian Pasal 13).</p>

    <p>7. Pajak pendapatan (Pph Pasal 21) ditanggung sepenuhnya oleh Perusahaan untuk kemudian disetorkan ke Kas Negara.</p>

    @include('admin.hrd.contracts.partials.sandmon.pasal7-ppe', [
        'contract' => $contract,
        'type'     => $type,
    ])

    @include('admin.hrd.contracts.partials.project.pasal7-lembur', [
        'contract' => $contract,
        'type'     => $type,
    ])

    {{-- <table class="paraf-table">
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
    </table> --}}

    @include('partials.document-footer')
</div>
{{-- PAGE 5 END --}}


{{-- =========================================================
    PAGE 6 — PASAL 9: KETENTUAN UPAH WAKTU SAKIT
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    <div class="pasal-title">PASAL 9</div>
    <div class="pasal-subtitle">KETENTUAN UPAH WAKTU SAKIT</div>

    <p>1. Pembayaran upah waktu sakit diatur sebagai berikut :</p>
    <p class="indent">a. 4 ( Empat ) bulan pertama dibayar 100 %. ( Rumus : Gaji Pokok + Tunjangan Tetap x 100% )</p>
    <p class="indent">b. 4 ( Empat ) bulan kedua dibayar 75 %. ( Rumus : Gaji Pokok + Tunjangan Tetap x 75% )</p>
    <p class="indent">c. 4 ( Empat ) bulan ketiga dan seterusnya dibayar 50 %. ( Rumus : Gaji Pokok + Tunjangan Tetap x 50% )</p>
    <p class="indent">Pernyataan sehat dan dapat bekerja kembali harus dengan surat pernyataan dokter yang merawat.</p>

    <p>2. Maksimal setelah 1 (satu) tahun, apabila Karyawan yang bersangkutan tidak bisa melaksanakan kewajibannya (bekerja), maka perusahaan melakukan pemutusan hubungan kerja (PHK), berdasarkan ketentuan perundangan yang berlaku.</p>
    <div class="pasal-title">PASAL 10</div>
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
    <p class="indent">Sanksi :</p>
    <p class="indent-2">- Pelanggaran ke-1: Teguran tertulis</p>
    <p class="indent-2">- Pelanggaran ke-2: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">- Pelanggaran ke-3: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">- Pelanggaran ke-4: Surat Peringatan Ketiga (SP III)</p>

    {{-- <table class="paraf-table">
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
    </table> --}}

    @include('partials.document-footer')
</div>
{{-- PAGE 6 END --}}


{{-- =========================================================
    PAGE 7 — PASAL 10: PENEGAKAN DISIPLIN (bagian 1)
========================================================== --}}



{{-- =========================================================
    PAGE 8 — PASAL 10: PENEGAKAN DISIPLIN (bagian 2)
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

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
    <p class="indent">4. Kelahiran anak;</p>
    <p class="indent">5. Kematian anggota keluarga inti;</p>
    <p class="indent">6. Perubahan identitas kependudukan (ktp, kk, atau dokumen sejenis);</p>
    <p class="indent">7. Perubahan data rekening bank untuk pembayaran upah;</p>
    <p class="indent">8. Perubahan pihak yang menjadi ahli waris atau penerima manfaat hak ketenagakerjaan.</p>

    <p><strong>Sanksi :</strong> Surat Peringatan Pertama (SP I)</p>
    <div class="pasal-title">PASAL 11</div>
    <div class="pasal-subtitle">PELANGGARAN TATA TERTIB</div>

    <p><strong>Ketentuan Umum:</strong></p>

    <p>1. Setiap Pekerja wajib mematuhi seluruh tata tertib, kode etik, serta standar prosedur kerja Perusahaan, termasuk kepatuhan penuh terhadap aturan HSE (Health, Safety, and Environment) demi menjamin keselamatan jiwa, keamanan aset, dan kelestarian lingkungan kerja.</p>
    <p>2. Pelanggaran terhadap ketentuan ini dikenakan sanksi sesuai tingkat kesalahan dan dampaknya, mulai dari Surat Peringatan (SP I, II, III), Skorsing, hingga Pemutusan Hubungan Kerja (PHK), berdasarkan regulasi ketenagakerjaan yang berlaku serta kebijakan internal Perusahaan.</p>
    <p>3. Khusus untuk jenis pelanggaran yang diklasifikasikan sebagai Pelanggaran Mendesak, Perusahaan berhak menjatuhkan sanksi Pemutusan Hubungan Kerja (PHK) secara langsung tanpa melalui tahapan pemberian Surat Peringatan secara berturut-turut, sebagaimana diatur dalam Pasal 52 ayat (2) Peraturan Pemerintah No. 35 Tahun 2021.</p>
    <p>4. Khusus sanksi PHK atas pelanggaran berulang dan atau pelanggaran berat-mendesak, maka Perusahaan tidak berkewajiban membayarkan ganti rugi sisa masa kontrak sebagaimana dimaksud dalam Pasal 62 Undang-Undang Nomor 13 Tahun 2003.</p>

    {{-- <table class="paraf-table">
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
    </table> --}}

    @include('partials.document-footer')
</div>
{{-- PAGE 8 END --}}


{{-- =========================================================
    PAGE 9 — PASAL 11: PELANGGARAN TATA TERTIB (bagian 1)
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

    

    <p><strong>A. Ketertiban dan Kepatuhan Kerja</strong></p>

    <p>1. <strong>Standar Penampilan:</strong> Pekerja pria dilarang berambut panjang, gondrong, atau menguncir rambut yang tidak sesuai dengan ketentuan kerapian dan standar penampilan Perusahaan.</p>
    <p class="indent">Kategori Pelanggaran: Ringan</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama (SP I)</p>
    <p class="indent-2">Pelanggaran ke-2: Surat Peringatan Kedua (SP II)</p>
    <p class="indent-2">Pelanggaran ke-3: Skorsing 1 (satu) minggu</p>

    <p>2. <strong>Penyalahgunaan Waktu Kerja:</strong> Pekerja dilarang berdagang bukan untuk kepentingan perusahaan dan tidak berkaitan dengan tugas dan tanggung jawab pekerjaan pada jam kerja.</p>
    <p class="indent">Kategori Pelanggaran: Sedang</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: SP I</p>
    <p class="indent-2">Pelanggaran ke-2: SP II</p>
    <p class="indent-2">Pelanggaran ke-3: SP III atau Skorsing</p>

    <p>3. <strong>Insubordinasi:</strong> Pekerja dilarang menolak atau mengabaikan perintah atasan yang sah dan berkaitan langsung dengan pelaksanaan tugas pekerjaan.</p>
    <p class="indent">Kategori Pelanggaran: Sedang</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: SP I</p>
    <p class="indent-2">Pelanggaran ke-2: SP II</p>
    <p class="indent-2">Pelanggaran ke-3: SP III atau Skorsing</p>
    <p>4. <strong>Mengabaikan Prosedur Kerja:</strong> Pekerja wajib mematuhi prosedur kerja sesuai surat edaran instruksi teknis, serta program kerja yang ditetapkan oleh Perusahaan atau User.</p>
    <p class="indent">Kategori Pelanggaran: Sedang - Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>
     <p>5. <strong>Keterangan Tidak Benar:</strong> Pekerja dilarang memberikan laporan, data, atau informasi yang tidak benar terkait aset, pekerjaan, atau kegiatan operasional Perusahaan.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Skorsing</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>6. <strong>Kerahasiaan Perusahaan:</strong> Pekerja terbukti membocorkan informasi atau rahasia internal Perusahaan tanpa izin yang sah.</p>
    <p class="indent">Kategori Pelanggaran: Mendesak</p>
    <p class="indent">Sanksi: PHK</p>

    <p>7. <strong>Kerusakan Materiil:</strong> Pekerja melakukan tindakan yang mengakibatkan kerusakan atau kerugian terhadap aset Perusahaan/User atau mempersulit kegiatan perusahaan dan atau menyebabkan kecelakaan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Ringan / Berat / Mendesak</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Apabila berdampak ringan dan tidak menimbulkan kerugian material yang signifikan: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">b. Apabila menimbulkan kerugian material besar, kecelakaan serius, gangguan operasional, potensi fatalitas, kebakaran, ledakan, atau pelanggaran K3 berat: Pemutusan Hubungan Kerja (PHK)</p>


    {{-- <table class="paraf-table">
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
    </table> --}}

    @include('partials.document-footer')
</div>
{{-- PAGE 9 END --}}



{{-- =========================================================
    PAGE 11 — PASAL 11 (bagian 3) — Rokok + Perilaku
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')
     <p>8. <strong>Senjata dan Minuman Keras:</strong> Pekerja dilarang membawa, menyimpan, menggunakan, atau mengancam dengan senjata tajam, senjata api, maupun minuman keras di lingkungan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Berat / Mendesak</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Apabila hanya membawa: Skorsing</p>
    <p class="indent-2">b. Apabila menimbulkan kerugian material besar, kecelakaan serius, gangguan operasional, potensi fatalitas, kebakaran, ledakan, atau pelanggaran K3 berat: Pemutusan Hubungan Kerja (PHK)</p>

    <p>9. <strong>Narkotika:</strong> Pekerja dilarang membawa, menyimpan, menjual, membeli, atau mengonsumsi narkotika dan zat adiktif terlarang di dalam maupun di luar lingkungan kerja.</p>
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
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">b. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

    <p>13. Merokok pada waktu jam istirahat di area yang dilarang merokok/area terbatas di wilayah User.</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">a. Tidak menyebabkan Kebakaran atau kerugian materil</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2" style="margin-left:20mm !important;">Pelanggaran ke-2: PHK</p>
    <p class="indent-2">b. Menyebabkan Kebakaran atau kerugian materil besar : PHK</p>

    
{{-- 
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
    </table> --}}

    @include('partials.document-footer')
</div>
{{-- PAGE 11 END --}}


{{-- =========================================================
    PAGE 12 — PASAL 11 (bagian 4)
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')
    <p><strong>C. PERILAKU, ETIKA &amp; INFORMASI ELEKTRONIK</strong></p>

    <p>14. <strong>Penggunaan Perangkat Elektronik Terlarang:</strong> Pekerja membawa, menggunakan HP atau perangkat elektronik sejenis di area yang dilarang/ area terbatas yang ditetapkan Perusahaan/User.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>15. <strong>Pemalsuan Administrasi:</strong> Pekerja dilarang menggunakan atau menyerahkan dokumen palsu (ijazah, sertifikat, surat keterangan dokter atau surat keterangan resmi lainnya) yang berhubungan dengan prosedur kerja atau kepentingan hubungan kerja.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Surat Peringatan Pertama dan Terakhir</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <p>16. <strong>Manipulasi MCU/Kesehatan:</strong> Pekerja dilarang memanipulasi pemeriksaan kesehatan atau menggunakan identitas orang lain atau diwakilkan orang lain dalam pelaksanaan Medical Check-Up.</p>
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

    {{-- <table class="paraf-table">
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
    </table> --}}

    @include('partials.document-footer')
</div>
{{-- PAGE 12 END --}}


{{-- =========================================================
    PAGE 13 — PASAL 11 (bagian 5) + PASAL 12: ALIH TUGAS
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

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

    <p>25. <strong>Kecerobohan Alat Kerja</strong>: Menggunakan peralatan/perangkat kerja, bahan-bahan baku serta barang lain milik perusahaan/user secara sengaja ceroboh hingga menimbulkan kerusakan atau kerugian bagi perusahaan.</p>
    <p class="indent">Kategori Pelanggaran: Berat</p>
    <p class="indent">Sanksi:</p>
    <p class="indent-2">Pelanggaran ke-1: Skorsing minimal 1 (satu) minggu</p>
    <p class="indent-2">Pelanggaran ke-2: PHK</p>

    <div class="pasal-title">PASAL 12</div>
    <div class="pasal-subtitle">ALIH TUGAS</div>

    <p>Karyawan bersedia sewaktu – waktu dialih tugaskan oleh Perusahaan ke bagian / jabatan / daerah lain sesuai keperluan yang akan diatur kemudian.</p>
     @include('admin.hrd.contracts.partials.sandmon.pasal13-kelonggaran', [
        'contract' => $contract,
        'type'     => $type,
    ])
     <div class="pasal-title">PASAL 14</div>
    <div class="pasal-subtitle">AKHIR PERJANJIAN KERJA</div>

    <p>1. Karyawan mengajukan pengunduran diri. pengunduran diri atau yang dikualifikasikan mengundurkan diri maka Karyawan tidak berhak menuntut ganti rugi dan hanya akan menerima pendapatan sampai saat tanggal pemutusan Perjanjian Kerja Waktu Tertentu ini.</p>

    {{-- <table class="paraf-table">
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
    </table> --}}

    @include('partials.document-footer')
</div>
{{-- PAGE 13 END --}}


{{-- =========================================================
    PAGE 14 — PASAL 13: KELONGGARAN UNTUK TIDAK BEKERJA
========================================================== --}}

{{-- PAGE 14 END --}}


{{-- =========================================================
    PAGE 15 — PASAL 14: AKHIR PERJANJIAN KERJA + PASAL 15: PERSELISIHAN
========================================================== --}}
<div class="document-page">
    @include('partials.document-header')

   
    <p>2. Pemberitahuan pengunduran diri dilakukan selambat – lambatnya 30 (Tiga Puluh) hari sebelumnya.</p>
    <p>3. Karyawan yang mengundurkan diri wajib menyelesaikan tanggungjawab pekerjaan / alih tugas kepada Karyawan yang ditunjuk atasan.</p>
    <p>4. Apabila karyawan mengundurkan diri kurang dari 30 (tiga puluh) hari, maka karyawan wajib membayar ganti rugi kepada perusahaan sebesar THP bulan terakhir bekerja.</p>
    <p>5. Karyawan yang mengundurkan diri wajib mengembalikan APD kepada perusahaan</p>
    <p>6. Karyawan diberhentikan karena kesalahan Karyawan yang telah terbukti dan berdasarkan putusan peradilan yang berkekuatan hukum tetap</p>
    <p>7. Hasil evaluasi Karyawan dinilai tidak mampu dan tidak cakap oleh Perusahaan / User dalam melaksanakan tugasnya dan sudah di tempatkan di bidang lain yang sesuai apabila ada, dan / atau melanggar tata tertib yang ditetapkan oleh Perusahaan / User.</p>
    <p>8. Karyawan tidak hadir selama 5 (Lima) hari dalam 1 (satu) bulan secara berturut – turut, tanpa izin atau tanpa alasan yang bisa dipertanggung jawabkan dan telah dipanggil secara patut dan tertulis sebanyak 2 (dua) kali maka diklasifikasikan mengundurkan diri.</p>
    <p>9. Karyawan melanggar perjanjian pasal 9 dan atau pasal 10 Perjanjian Kerja Waktu Tertentu.</p>
    <p>10. Force Majeure</p>
    <p>11. Karyawan Meninggal dunia.</p>

    <div class="pasal-title">PASAL 15</div>
    <div class="pasal-subtitle">PERSELISIHAN</div>

    <p>Bila timbul suatu perselisihan mengenai pelaksanaan Perjanjian kerja ini, akan diselesaikan secara musyawarah dan kekeluargaan. Bila tidak tercapai kesepakatan maka akan diselesaikan menurut peraturan perundang – undangan yang berlaku di Wilayah Republik Indonesia.</p>
    <div class="pasal-title">PASAL 16</div>
    <div class="pasal-subtitle">KETENTUAN LAIN</div>

    <p>1. Menjelang masa berlaku Perjanjian Kerja ini berakhir, dan perusahaan menilai masih memerlukan Karyawan, maka perusahaan akan melakukan pemberitahuan kepada Karyawan sebelum masa kontrak berakhir, untuk kemudian diperpanjang/diperbarui oleh kedua belah pihak.</p>
    <p>2. Apabila proyek yang sedang berjalan dalam proses menunggu atau Karyawan berkurang, maka perusahaan berhak meng-stand by-kan Karyawan dengan upah (gaji pokok) tetap di bayar atau Karyawan bersedia ditempatkan atau dilibatkan dalam proyek lain yang sedang dikerjakan oleh perusahaan</p>
    <p>3. Apabila proyek Karyawan telah habis, tetapi perusahaan mendapatkan Karyawan/project lain dan perusahaan membutuhkan Karyawan dan kinerja Karyawan (performance) dianggap memenuhi syarat untuk mengerjakan project tersebut, maka Karyawan akan ditawarkan untuk dilibatkan dalam proyek tersebut.</p>
    <p>4. Apabila karyawan mengajukan izin wajib koordinasi dengan back to back untuk menggantikan sementara (tukar hari). Jika back to back tidak mau menggantikan sementara atau menolak perintah atasan untuk menggantikan sementara maka akan di berlakukan sanksi (Pasal 11 Ayat 3).</p>
    <p>5. Para Pihak sepakat bahwa Perjanjian Kerja ini dapat ditandatangani secara langsung maupun tidak langsung, termasuk melalui tanda tangan elektronik, hasil pemindaian (scan), foto, atau media elektronik lainnya. Tanda tangan dan dokumen tersebut diakui sah, mengikat, dan mempunyai kekuatan hukum yang sama dengan naskah asli sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.</p>
    <p>6. Salinan Perjanjian Kerja ini dalam bentuk hasil pemindaian (scan), fotokopi, atau dokumen elektronik lainnya dinyatakan sah dan dapat dipergunakan sebagai alat bukti hukum yang mengikat Para Pihak.</p>
    <p>7. Perjanjian Kerja ini disepakati dan ditandatangani oleh Para Pihak dalam keadaan sadar, sehat jasmani dan rohani, tanpa adanya paksaan atau tekanan dari pihak manapun. Dengan ditandatanganinya Perjanjian Kerja ini, Para Pihak menyatakan telah membaca, memahami, dan menyetujui seluruh isi Perjanjian Kerja ini.</p>

    <div class="signature-wrapper">
        <div class="signature-column">
            <div><strong>Karyawan</strong></div>
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
            <div><strong>PT. BUKAKA TEKNIK UTAMA Tbk</strong></div>
            <div><strong>CABANG BALIKPAPAN</strong></div>
            <div class="signature-image-wrapper">
                @if ($contract->head_qr_path)
                    <img src="{{ asset('storage/' . $contract->head_qr_path) }}" class="signature-image-10" alt="QR Head Approval">
                @endif
            </div>
            <div class="signature-name">Muslimin Sanafi</div>
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