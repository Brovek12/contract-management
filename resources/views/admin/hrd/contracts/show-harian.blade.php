@extends('layouts.document')

@section('title', $contract->title)

@section('document-style')
    @include('admin.hrd.contracts.partials.show-styles-project')

    <style>
        /* Tambahan CSS khusus untuk merapikan dokumen Harian */
        .doc-harian { font-size: 14px; line-height: 1.5; color: #000; }
        .doc-harian h2 { font-size: 24px; font-weight: 900; letter-spacing: 2px; margin-bottom: 0; }
        .doc-harian h4 { font-size: 16px; font-weight: bold; text-decoration: underline; margin-top: 5px; margin-bottom: 5px; }
        .doc-harian p { margin-bottom: 10px; }
        .doc-harian .table-borderless > tbody > tr > td { padding: 2px 5px; border: none; font-size: 14px; }
        .doc-harian .table-ketentuan > tbody > tr > td { padding: 5px; border: none; vertical-align: top; }
        .doc-harian .ttd-box { margin-top: 50px; text-align: center; }
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

        <div class="doc-harian mt-4">
            <!-- Header Dokumen -->
            <div class="text-center mb-4">
                <h4>PERJANJIAN KERJA KARYAWAN HARIAN</h4>
                <h4>No. {{ $contract->contract_number }}</h4>
            </div>

            <p class="mb-4">
                Pada hari ini ................, tanggal ................ diadakan perjanjian kerja harian antara :<br>
                Pihak Pertama (disebut pihak Perusahaan)
            </p>

            <!-- Data Perusahaan -->
            <table class="table table-borderless w-75 mb-4">
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
            <table class="table table-borderless w-75 mb-4">
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

            <p class="mb-3">Kedua belah pihak sepakat untuk mengadakan perjanjian kerja, dengan ketentuan sebagai berikut :</p>

            <!-- Ketentuan-Ketentuan -->
            <table class="table table-ketentuan w-100">
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

            <p class="mt-4 text-justify" style="line-height: 1.6;">
                Perusahaan sewaktu-waktu dapat memutuskan perjanjian kerja secara sepihak apabila kinerja karyawan tidak sesuai dengan standar penilaian, melanggar disiplin dan tata tertib perusahaan.<br>
                Kontrak Harian ini dapat berakhir sebelum tanggal akhir perjanjian jika pekerjaan telah selesai/proyek berakhir.<br>
                Demikian perjanjian ini dibuat secara sadar dan tidak ada paksaan dari siapapun serta ditandatangani oleh kedua belah pihak.
            </p>

            <!-- Tanda Tangan Bawah -->
            <div class="signature-wrapper">
            <div class="signature-column">
                <div><strong>Pekerja</strong></div>
                <div>&nbsp;</div>
                <div class="signature-space-2"></div>
                <div class="signature-image-wrapper-2">
                    @if ($contract->employee_signature)
                        <img src="{{ asset('storage/' . $contract->employee_signature) }}" class="signature-image-2"
                            alt="Employee Signature">
                    @endif
                </div>
                <div class="signature-name-2">
                    {{ $contract->employee_name ?? '........................' }}
                </div>
                <div class="signature-title">&nbsp;</div>
            </div>

            <div class="signature-column">
                <!-- Bungkus teks dan gambar dengan d-flex agar sejajar ke samping -->

                <div class="d-flex align-items-center mb-1">
                    <div>
                        <div class="d-flex align-items-center" style="padding-left: 50px;">
                            <!-- Teks dikunci di sini -->
                            <strong>Pihak Perusahaan</strong>

                            <!-- Gambar dibungkus wadah dengan lebar statis agar tidak mendorong teks -->
                            <div style="width: 40px; margin-left: 10px;">
                                    <img src="{{ asset('images/algy.jpg') }}" alt=""
                                        style="width: 30px; height: 20px; opacity: 0.9; display: block;">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- QR Code Head Approval -->
                <div class="signature-image-wrapper">
                    @if ($contract->hrd_qr_path)
                        <img src="{{ asset('storage/' . $contract->hrd_qr_path) }}" class="signature-image-10"
                            alt="QR Head Approval">
                    @endif
                </div>

                <!-- Nama dan Jabatan -->
                <div class="signature-name">I.T Anasya</div>
                <div class="signature-title">PJS. HRD Coordinator</div>
            </div>
        </div>

        @include('partials.document-footer')
    </div>
        </div>

        @include('partials.document-footer')
    </div>

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