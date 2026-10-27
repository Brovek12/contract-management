@extends('layouts.document')

@section('title', $contract->title)

@section('document-style')
    @include('admin.hrd.contracts.partials.show-styles-project')
<style>
    /* =========================================
       PENGATURAN KETAT UNTUK 1 HALAMAN A4
       ========================================= */
   /* =========================================
   PENGATURAN KETAT UNTUK 1 HALAMAN A4
   ========================================= */
body {
    background-color: #f0f0f0;
}

.document-page {
    width: 210mm;
    height: 297mm;
    padding: 10mm 15mm !important;
    margin: 0 auto;
    background: white;
    box-sizing: border-box;
    font-size: 12.6pt !important; /* Standar font dokumen */
    line-height: 1.15 !important;
    overflow: hidden;
    position: relative;
}

/* Hilangkan style bawaan tabel yang bikin renggang */
.document-page table {
    font-size: 12.6pt !important;
    margin-bottom: 0 !important;
}
.document-page p {
    font-size: 12.6pt !important;
    margin-bottom: 6px !important;
    text-align: justify;
    line-height: 1.15 !important;
}

/* Rapatkan Judul (H4) */
.doc-harian h4 {
    font-size: 12.6pt !important;
    font-weight: bold;
    margin-bottom: 2px !important;
    line-height: 1.2;
}

.text-center.mb-4 {
    margin-bottom: 12px !important; /* Jarak judul ke isi */
}

/* Tabel Data Karyawan & Perusahaan */
.doc-harian .table-borderless {
    margin-bottom: 8px !important;
}
.doc-harian .table-borderless td {
    padding: 1px 2px !important;
    vertical-align: top;
}

/* Tabel Ketentuan (Poin 1-9) */
.doc-harian .table-ketentuan {
    margin-bottom: 8px !important;
}
.doc-harian .table-ketentuan td {
    padding: 2px 4px !important;
    vertical-align: top;
}

/* Paragraf Penutup (Samakan fontnya) */
p.mt-4.text-justify {
    margin-top: 10px !important;
    margin-bottom: 10px !important;
    font-size: 12.6pt !important; /* Dibuat sama rata */
}

/* Area Tanda Tangan */
.signature-wrapper {
    margin-top: 10px !important;
    display: flex;
    justify-content: space-between;
    page-break-inside: avoid;
}

.signature-column {
    width: 48%;
    text-align: center;
}
</style>
@endsection

@section('document-content')

    @php
        $editableStatuses = ['sent', 'viewed', 'signed'];
        $isEditing = $contract->status === 'signed' && $contract->employee_signature;
        $canSign = auth()->user()->hasRole('Employee')
            && in_array($contract->status, $editableStatuses);
    @endphp

    @include('admin.hrd.contracts.partials.show-progress', ['contract' => $contract])

    {{-- =========================================================
    PAGE 1 — SURAT PERJANJIAN HARIAN
    ========================================================== --}}
    <div class="document-page">
        @include('partials.document-header')

        {{-- Hapus mt-4 agar tidak turun terlalu jauh --}}
        <div class="doc-harian">
            <!-- Header Dokumen -->
            <div class="text-center mb-4">
                <h4>PERJANJIAN KERJA KARYAWAN HARIAN</h4>
                <h4>No. {{ $contract->contract_number }}</h4>
            </div>
<p class="mb-3">
    Pada hari ini, 
    <strong>{{ $contract->created_at ? $contract->created_at->locale('id')->translatedFormat('l') : '................' }}</strong>, 
    tanggal 
    <strong>{{ $contract->created_at ? $contract->created_at->locale('id')->translatedFormat('d F Y') : '................' }}</strong> 
    diadakan perjanjian kerja harian antara:
</p>


            <!-- Data Perusahaan -->
            <table class="table table-borderless w-75 mb-3">
                <tr>
                    <td width="25%">Nama</td>
                    <td width="2%">:</td>
                    <td>I.T Anasya</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>Pjs. HRD Coordinator</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jl. Mulawarman KM 21 Manggar Balikpapan</td>
                </tr>
            </table>

            <p class="mb-2">Pihak Kedua (disebut pihak Karyawan)</p>
            <!-- Data Karyawan -->
            <table class="table table-borderless w-75 mb-3">
                <tr>
                    <td width="25%">Nama</td>
                    <td width="2%">:</td>
                    <td>{{ $contract->employee_name }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $contract->nik ?? '................' }}</td>
                </tr>
                <tr>
                    <td>TTL</td>
                    <td>:</td>
                    <td>
                        {{ $contract->birth_place ?? '........' }}, 
                        {{ $contract->birth_date ? \Carbon\Carbon::parse($contract->birth_date)->format('d-m-Y') : '........' }}
                    </td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td>{{ $contract->age_at_contract ?? '........' }} Tahun</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $contract->gender ?? '........' }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $contract->address ?? '................' }}</td>
                </tr>
            </table>

            <p class="mb-2">Kedua belah pihak sepakat untuk mengadakan perjanjian kerja, dengan ketentuan sebagai berikut :</p>

            <!-- Ketentuan-Ketentuan -->
            <table class="table table-ketentuan w-100 mb-2">
                <tr>
                    <td width="4%">1.</td>
                    <td width="20%">Waktu</td>
                    <td width="2%">:</td>
                    <td>{{ $contract->start_date?->format('d M Y') }} sampai {{ $contract->end_date?->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Upah Kerja</td>
                    <td>:</td>
                    <td>
                        Per hari Rp {{ number_format($contract->basic_salary, 0, ',', '.') }} ( {{ $contract->work_hours ?? '8' }} jam kerja dan {{ $contract->break_hours ?? '1' }} jam istirahat).
                        <br>a. Perhitungan kelebihan jam kerja adalah (Upah Kerja / 8) x Jumlah jam lembur.
                        <br>b. Apabila karyawan tidak hadir, maka upah kerja tidak dibayarkan.
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $contract->position }}</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Hari & Jam Kerja</td>
                    <td>:</td>
                    <td>{{ $contract->work_days ?? '6' }} hari kerja banding {{ $contract->off_days ?? '1' }} hari libur, dengan ketentuan sebagai berikut :<br>Mengikuti aturan yang berlaku.</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Waktu Istirahat</td>
                    <td>:</td>
                    <td>Mengikuti aturan yang berlaku di perusahaan.</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Tata tertib</td>
                    <td>:</td>
                    <td>Mengikuti Tata tertib Kedisiplinan yang berlaku di Perusahaan</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Lokasi kerja</td>
                    <td>:</td>
                    <td>{{ $contract->work_location }}</td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>Pembayaran</td>
                    <td>:</td>
                    <td>Dilaksanakan 1 kali dalam sebulan yaitu tanggal {{ $contract->payment_date ?? '05' }} (Transfer Bank).<br>Dihitung berdasarkan absensi / Timesheet kehadiran.</td>
                </tr>
                <tr>
                    <td>9.</td>
                    <td>Fasilitas</td>
                    <td>:</td>
                    <td>BPJS</td>
                </tr>
            </table>

            {{-- Hapus inline style line-height 1.6 agar ikut CSS ketat di atas --}}
            <p class="mt-4 text-justify">
                Perusahaan sewaktu-waktu dapat memutuskan perjanjian kerja secara sepihak apabila kinerja karyawan tidak sesuai dengan standar penilaian, melanggar disiplin dan tata tertib perusahaan.<br>
                Kontrak Harian ini dapat berakhir sebelum tanggal akhir perjanjian jika pekerjaan telah selesai/proyek berakhir.<br>
                Demikian perjanjian ini dibuat secara sadar dan tidak ada paksaan dari siapapun serta ditandatangani oleh kedua belah pihak.
            </p>

            <!-- Tanda Tangan Bawah -->
                       <!-- Tanda Tangan Bawah -->
            <div class="signature-wrapper" style="margin-top: 10px; display: table; width: 100%; table-layout: fixed;">
                
                <!-- KOLOM KIRI (Pekerja) -->
                <div class="signature-column" style="display: table-cell; width: 50%; text-align: center; vertical-align: top;">
                    <div style="font-weight: bold; margin-bottom: 5px;">Pekerja</div>
                    
                    <!-- Area Tanda Tangan -->
                    <div style="height: 50px; margin-bottom: 5px;">
                        @if ($contract->employee_signature)
                            <img src="{{ asset('storage/' . $contract->employee_signature) }}" style="max-height: 50px;" alt="Employee Signature">
                        @endif
                    </div>
                    
                    <div style="font-weight: bold; text-decoration: underline;">{{ $contract->employee_name ?? '........................' }}</div>
                    <div style="font-size: 9.5pt;">&nbsp;</div>
                </div>

                <!-- KOLOM KANAN (Perusahaan) -->
                <div class="signature-column" style="display: table-cell; width: 50%; text-align: center; vertical-align: top;">
                    <!-- Teks dan Logo Kecil -->
                    <div style="display: flex; justify-content: center; align-items: center; font-weight: bold; margin-bottom: 5px;">
                        <span>Pihak Perusahaan</span>
                        <img src="{{ asset('images/algy.jpg') }}" alt="" style="width: 25px; height: 15px; margin-left: 5px; opacity: 0.9;">
                    </div>

                    <!-- Area Tanda Tangan / QR Code -->
                    <div style="height: 50px; margin-bottom: 5px;">
                        @if ($contract->hrd_qr_path)
                            <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" style="max-height: 50px;" alt="QR Head Approval">
                        @endif
                    </div>

                    <!-- Nama dan Jabatan -->
                    <div style="font-weight: bold; text-decoration: underline;">I.T Anasya</div>
                    <div style="font-size: 9.5pt;">PJS. HRD Coordinator</div>
                </div>

            </div>

            @include('partials.document-footer')
            
        </div> {{-- Tutup doc-harian --}}
    </div> {{-- Tutup document-page --}}

@endsection


{{-- =========================================================    
    FLOATING SIGN BUTTON & MODAL
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

    if(modal) {
        modal.addEventListener('shown.bs.modal', function () {
            setTimeout(function () {
                requestAnimationFrame(function () { resizeCanvas(); });
            }, 300);
        });

        modal.addEventListener('hidden.bs.modal', function () {
            signaturePad.clear();
            document.getElementById('signature_data').value = '';
        });
    }

    const clearBtn = document.getElementById('signature-clear');
    if(clearBtn) {
        clearBtn.addEventListener('click', function () { signaturePad.clear(); });
    }

    const form = document.getElementById('sign-contract-form');

    if(form) {
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
    }

    window.addEventListener('resize', function () {
        if (modal && modal.classList.contains('show')) resizeCanvas();
    });
});
</script>
@endpush