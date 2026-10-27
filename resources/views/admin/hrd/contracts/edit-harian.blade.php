@extends('layouts.app')

@section('title', 'Edit Contract Harian')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="py-3 app-toolbar py-lg-6">
    <div id="kt_app_toolbar_container" class="container-xxl d-flex flex-stack">
        <div class="gap-2 d-flex flex-column justify-content-center">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('contracts.index') }}" class="btn btn-sm btn-light-primary">
                    <i class="ki-outline ki-arrow-left fs-3"></i> Kembali
                </a>
                <div>
                    <h1 class="page-heading text-gray-900 fw-bold fs-3 m-0">
                        Edit Contract {{ strtoupper($contract->type) }}
                    </h1>
                    <span class="text-gray-500 fs-7">
                        Kategori: <strong>{{ ucfirst($contract->category) }}</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="type" value="{{ $contract->type }}">
            <input type="hidden" name="category" value="{{ $contract->category }}">

            <!-- INFORMASI CONTRACT -->
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title"><h2 class="fw-bold text-gray-900">Informasi Contract</h2></div>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">No. Contract</label>
                            <input type="text" name="contract_number" class="form-control" placeholder="Contoh: PKWT/001/2026" value="{{ old('contract_number', $contract->contract_number) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Contract</label>
                            <input type="date" name="contract_date" id="contract-date" class="form-control" value="{{ old('contract_date', optional($contract->contract_date)->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', optional($contract->start_date)->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Berakhir</label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', optional($contract->end_date)->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="required form-label fw-semibold">Judul Contract</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Perjanjian Kerja Karyawan Harian" value="{{ old('title', $contract->title) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Head of Branch</label>
                            <select name="head_user_id" class="form-select" data-control="select2" data-placeholder="Pilih Head of Branch">
                                <option value=""></option>
                                @foreach ($heads as $head)
                                    <option value="{{ $head->id }}" {{ old('head_user_id', $contract->head_user_id) == $head->id ? 'selected' : '' }}>
                                        {{ $head->name }} @if ($head->employee_number) - {{ $head->employee_number }} @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DATA EMPLOYEE -->
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title"><h2 class="fw-bold text-gray-900">Data Employee</h2></div>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Employee</label>
                            <select name="user_id" id="employee-select" class="form-select" data-control="select2" data-placeholder="Pilih Employee" required>
                                <option value=""></option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" data-name="{{ $employee->name }}" {{ old('user_id', $contract->user_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }} @if ($employee->employee_number) - {{ $employee->employee_number }} @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Employee</label>
                            <input type="text" name="employee_name" id="employee-name" class="form-control bg-light" value="{{ old('employee_name', $contract->employee_name) }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control" placeholder="Nomor Induk Karyawan" value="{{ old('nik', $contract->nik) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. KTP</label>
                            <input type="text" name="ktp_number" class="form-control" placeholder="Nomor KTP" value="{{ old('ktp_number', $contract->ktp_number) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control" placeholder="Contoh: Balikpapan" value="{{ old('birth_place', $contract->birth_place) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth-date" class="form-control" value="{{ old('birth_date', optional($contract->birth_date)->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Umur</label>
                            <input type="number" name="age_at_contract" id="age-at-contract" class="form-control bg-light" value="{{ old('age_at_contract', $contract->age_at_contract) }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="gender" class="form-select" data-control="select2">
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('gender', $contract->gender) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $contract->gender) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="address" class="form-control" rows="1" placeholder="Alamat employee">{{ old('address', $contract->address) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PENEMPATAN & UPAH HARIAN -->
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title"><h2 class="fw-bold text-gray-900">Penempatan & Detail Harian</h2></div>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Project (Opsional)</label>
                            <select name="project_id" class="form-select" data-control="select2" data-placeholder="Pilih Project">
                                <option value=""></option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $contract->project_id) == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Posisi / Jabatan</label>
                            <input type="text" name="position" class="form-control" placeholder="Contoh: Helper" value="{{ old('position', $contract->position) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Lokasi Kerja</label>
                            <input type="text" name="work_location" class="form-control" placeholder="Contoh: Balikpapan" value="{{ old('work_location', $contract->work_location) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Domisili</label>
                            <input type="text" name="domicile" class="form-control" placeholder="Contoh: Balikpapan" value="{{ old('domicile', $contract->domicile) }}" required>
                        </div>

                        <div class="col-md-12 mt-5">
                            <h4 class="fw-bold text-gray-800 mb-3">Pengaturan Jam & Pembayaran</h4>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jam Kerja</label>
                            <div class="input-group">
                                <input type="number" name="work_hours" class="form-control" placeholder="8" value="{{ old('work_hours', $contract->work_hours ?? '8') }}">
                                <span class="input-group-text">Jam</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Jam Istirahat</label>
                            <div class="input-group">
                                <input type="number" name="break_hours" class="form-control" placeholder="1" value="{{ old('break_hours', $contract->break_hours ?? '1') }}">
                                <span class="input-group-text">Jam</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Hari Kerja</label>
                            <div class="input-group">
                                <input type="number" name="work_days" class="form-control" placeholder="6" value="{{ old('work_days', $contract->work_days ?? '6') }}">
                                <span class="input-group-text">Hari</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Hari Libur</label>
                            <div class="input-group">
                                <input type="number" name="off_days" class="form-control" placeholder="1" value="{{ old('off_days', $contract->off_days ?? '1') }}">
                                <span class="input-group-text">Hari</span>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="form-label fw-semibold">Tanggal Pembayaran</label>
                            <div class="input-group">
                                <span class="input-group-text">Tanggal</span>
                                <input type="number" name="payment_date" class="form-control" placeholder="05" min="1" max="31" value="{{ old('payment_date', $contract->payment_date ?? '05') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6 mt-4">
                            <label class="required form-label fw-semibold">Upah Per Hari</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control currency-input" data-target="basic_salary" placeholder="0" value="{{ old('basic_salary', $contract->basic_salary) ? number_format((float) old('basic_salary', $contract->basic_salary), 0, ',', '.') : '' }}" inputmode="numeric" autocomplete="off" required>
                                <span class="input-group-text">/ Hari</span>
                            </div>
                            <input type="hidden" name="basic_salary" id="basic_salary" value="{{ old('basic_salary', $contract->basic_salary) }}">
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department" id="employee-department" class="form-control" placeholder="Masukkan department" value="{{ old('department', $contract->department) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTION -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('contracts.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-outline ki-save-2 fs-3"></i> Update Contract
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {
    // 1. Auto Fill Employee Name
    function fillEmployeeData() {
        let employeeId = $('#employee-select').val();
        if (!employeeId) { $('#employee-name').val(''); return; }
        let selectedOption = $('#employee-select').find('option:selected');
        $('#employee-name').val(selectedOption.attr('data-name') || '');
    }
    $('#employee-select').on('select2:select', function () { fillEmployeeData(); });
    $('#employee-select').on('change', function () { fillEmployeeData(); });

    // 2. Hitung Umur Otomatis
    function calculateAge() {
        let birthDateValue = $('#birth-date').val();
        let contractDateValue = $('#contract-date').val();
        if (!birthDateValue) { $('#age-at-contract').val(''); return; }
        
        let birthDate = new Date(birthDateValue + 'T00:00:00');
        let contractDate = contractDateValue ? new Date(contractDateValue + 'T00:00:00') : new Date();
        let age = contractDate.getFullYear() - birthDate.getFullYear();
        let m = contractDate.getMonth() - birthDate.getMonth();
        
        if (m < 0 || (m === 0 && contractDate.getDate() < birthDate.getDate())) { age--; }
        $('#age-at-contract').val((age >= 0 && age <= 100) ? age : '');
    }
    $('#birth-date').on('change', calculateAge);
    $('#contract-date').on('change', calculateAge);

    // 3. Format Rupiah
    $(document).on('input blur', '.currency-input', function () {
        let $input = $(this);
        let rawValue = $input.val().replace(/\D/g, '');
        $('#' + $input.data('target')).val(rawValue);
        $input.val(rawValue !== '' ? new Intl.NumberFormat('id-ID').format(rawValue) : '');
    });

    // Init
    fillEmployeeData();
    calculateAge();
});
</script>
@endsection