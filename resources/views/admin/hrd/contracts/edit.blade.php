@extends('layouts.app')

@section('title', 'Edit Contract')

@section('content')

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="py-3 app-toolbar py-lg-6">
    <div id="kt_app_toolbar_container" class="container-xxl d-flex flex-stack">
        <div class="gap-2 d-flex flex-column justify-content-center">
            <div class="d-flex align-items-center gap-3">

                <a href="{{ route('contracts.index') }}" class="btn btn-sm btn-light-primary">
                    <i class="ki-outline ki-arrow-left fs-3"></i>
                    Kembali
                </a>

                <div>
                    <h1 class="page-heading text-gray-900 fw-bold fs-3 m-0">
                        Edit Contract {{ strtoupper($contract->type) }}
                    </h1>

                    <span class="text-gray-500 fs-7">
                        Kategori: <strong>{{ ucfirst($contract->category) }}</strong> &mdash;
                        Perbarui data contract
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

            {{-- Hidden: type & category (read-only) --}}
            <input type="hidden" name="type" value="{{ $contract->type }}">
            <input type="hidden" name="category" value="{{ $contract->category }}">

            <!-- ================================================== -->
            <!-- INFORMASI CONTRACT -->
            <!-- ================================================== -->
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h2 class="fw-bold text-gray-900">Informasi Contract</h2>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-5">

                        {{-- Contract Number --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">No. Contract</label>
                            <input type="text" name="contract_number" class="form-control"
                                   placeholder="Contoh: PKWT/001/2026"
                                   value="{{ old('contract_number', $contract->contract_number) }}"
                                   required>
                        </div>

                        {{-- Contract Date --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Contract</label>
                            <input type="date" name="contract_date" id="contract-date" class="form-control"
                                   value="{{ old('contract_date', optional($contract->contract_date)->format('Y-m-d')) }}"
                                   required>
                        </div>

                        {{-- Start Date --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control"
                                   value="{{ old('start_date', optional($contract->start_date)->format('Y-m-d')) }}"
                                   required>
                        </div>

                        {{-- End Date --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Berakhir</label>
                            <input type="date" name="end_date" class="form-control"
                                   value="{{ old('end_date', optional($contract->end_date)->format('Y-m-d')) }}"
                                   required>
                        </div>

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Judul Contract</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $contract->title) }}"
                                   required>
                        </div>

                        {{-- Head of Branch --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Head of Branch</label>
                            <select name="head_user_id" class="form-select"
                                    data-control="select2"
                                    data-placeholder="Pilih Head of Branch">
                                <option value=""></option>
                                @foreach ($heads as $head)
                                    <option value="{{ $head->id }}"
                                        {{ old('head_user_id', $contract->head_user_id) == $head->id ? 'selected' : '' }}>
                                        {{ $head->name }}
                                        @if ($head->employee_number)
                                            - {{ $head->employee_number }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>


            <!-- ================================================== -->
            <!-- DATA EMPLOYEE -->
            <!-- ================================================== -->
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h2 class="fw-bold text-gray-900">Data Employee</h2>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-5">

                        {{-- Employee --}}
                        <div class="col-12">
                            <label class="required form-label fw-semibold">Employee</label>
                            <select name="user_id" id="employee-select" class="form-select"
                                    data-control="select2"
                                    data-placeholder="Pilih Employee" required>
                                <option value=""></option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                            data-name="{{ $employee->name }}"
                                            data-employee-number="{{ $employee->employee_number }}"
                                            data-email="{{ $employee->email }}"
                                            data-phone="{{ $employee->phone }}"
                                            {{ old('user_id', $contract->user_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                        @if ($employee->employee_number)
                                            - {{ $employee->employee_number }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Employee Name --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Employee</label>
                            <input type="text" name="employee_name" id="employee-name"
                                   class="form-control bg-light"
                                   value="{{ old('employee_name', $contract->employee_name) }}" readonly>
                        </div>

                        {{-- Department --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department" id="employee-department"
                                   class="form-control"
                                   placeholder="Masukkan department"
                                   value="{{ old('department', $contract->department) }}">
                        </div>

                        {{-- NIK --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control"
                                   placeholder="Nomor Induk Karyawan"
                                   value="{{ old('nik', $contract->nik) }}">
                        </div>

                        {{-- KTP --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. KTP</label>
                            <input type="text" name="ktp_number" class="form-control"
                                   placeholder="Nomor KTP"
                                   value="{{ old('ktp_number', $contract->ktp_number) }}">
                        </div>

                        {{-- Birth Place --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control"
                                   placeholder="Contoh: Balikpapan"
                                   value="{{ old('birth_place', $contract->birth_place) }}">
                        </div>

                        {{-- Birth Date --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth-date" class="form-control"
                                   value="{{ old('birth_date', optional($contract->birth_date)->format('Y-m-d')) }}">
                        </div>

                        {{-- Age --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Umur</label>
                            <input type="number" name="age_at_contract" id="age-at-contract"
                                   class="form-control bg-light"
                                   value="{{ old('age_at_contract', $contract->age_at_contract) }}" readonly>
                            <div class="text-muted fs-7 mt-2">Otomatis berdasarkan tanggal lahir.</div>
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="gender" class="form-select" data-control="select2">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ old('gender', $contract->gender) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('gender', $contract->gender) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        {{-- Address --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="address" class="form-control" rows="3"
                                      placeholder="Alamat employee">{{ old('address', $contract->address) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>


            <!-- ================================================== -->
            <!-- PENEMPATAN & PENDAPATAN -->
            <!-- ================================================== -->
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h2 class="fw-bold text-gray-900">Penempatan & Pendapatan</h2>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-5">

                        {{-- Project --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Project</label>
                            <select name="project_id" class="form-select"
                                    data-control="select2"
                                    data-placeholder="Pilih Project">
                                <option value=""></option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('project_id', $contract->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Position --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Posisi</label>
                            <input type="text" name="position" class="form-control"
                                   placeholder="Contoh: Welder"
                                   value="{{ old('position', $contract->position) }}" required>
                        </div>

                        {{-- Work Location --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Lokasi Kerja</label>
                            <input type="text" name="work_location" class="form-control"
                                   placeholder="Contoh: Balikpapan"
                                   value="{{ old('work_location', $contract->work_location) }}" required>
                        </div>

                        {{-- Domicile --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Domisili</label>
                            <input type="text" name="domicile" class="form-control"
                                   placeholder="Contoh: Balikpapan dan sekitarnya"
                                   value="{{ old('domicile', $contract->domicile) }}" required>
                        </div>

                        {{-- Basic Salary --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Gaji Pokok</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="text"
                                       class="form-control currency-input"
                                       data-target="basic_salary"
                                       placeholder="0"
                                       value="{{ old('basic_salary', $contract->basic_salary) ? number_format((float) old('basic_salary', $contract->basic_salary), 0, ',', '.') : '' }}"
                                       inputmode="numeric"
                                       autocomplete="off"
                                       required>

                                <span class="input-group-text">/ Bulan</span>
                            </div>

                            <input type="hidden" name="basic_salary" id="basic_salary"
                                   value="{{ old('basic_salary', $contract->basic_salary) }}">
                        </div>

                    </div>
                </div>
            </div>


            {{-- ================================================== --}}
            {{-- TUNJANGAN (dinamis per type)                        --}}
            {{-- ================================================== --}}
            @php
                $allowanceTypes = [
                    'all-in',
                    'gp-mahal-um-ut-fungsi',
                    'gp-um-ut-fungsi',
                    'security',
                    'ob',
                    'gp-um-ut-laut',
                    'gp-um-ut',
                    'gp-mahal-um-ut-fungsi-pls',
                    'gp-mahal-um-ut',
                    'pep-lokal-buny',
                    'elis-phkt-5-2',
                    'elis-phkt-6-1',
                    'eni-muara-bakau-lembur',
                    'eni-muara-bakau-all-in',
                    'ipfms-dobu',
                ];
            @endphp

            @if (in_array($contract->type, $allowanceTypes))
                <div class="card mb-5">
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold text-gray-900">
                                Tunjangan {{ strtoupper($contract->type) }}
                            </h2>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-5">
                            @include('admin.hrd.contracts.partials.create-pasal5', [
                                'contract' => $contract,
                                'type'     => $contract->type,
                            ])
                        </div>
                    </div>
                </div>
            @endif


            <!-- ================================================== -->
            <!-- ACTION -->
            <!-- ================================================== -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('contracts.index') }}" class="btn btn-light">Batal</a>

                        <button type="submit" class="btn btn-primary">
                            <i class="ki-outline ki-save-2 fs-3"></i>
                            Update Contract
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

    // =========================================================
    // EMPLOYEE
    // =========================================================

    function fillEmployeeData() {
        let employeeId = $('#employee-select').val();
        if (!employeeId) {
            $('#employee-name').val('');
            return;
        }
        let selectedOption = $('#employee-select').find('option:selected');
        let employeeName   = selectedOption.attr('data-name');
        $('#employee-name').val(employeeName || '');
    }

    $('#employee-select').on('select2:select', function () {
        fillEmployeeData();
    });

    $('#employee-select').on('change', function () {
        fillEmployeeData();
    });


    // =========================================================
    // BIRTH DATE / CONTRACT DATE -> AGE
    // =========================================================

    $('#birth-date').on('change', function () {
        calculateAge();
    });

    $('#contract-date').on('change', function () {
        calculateAge();
    });

    function calculateAge() {
        let birthDateValue    = $('#birth-date').val();
        let contractDateValue = $('#contract-date').val();

        if (!birthDateValue) {
            $('#age-at-contract').val('');
            return;
        }

        let birthDate = new Date(birthDateValue + 'T00:00:00');

        let contractDate;
        if (contractDateValue) {
            contractDate = new Date(contractDateValue + 'T00:00:00');
        } else {
            contractDate = new Date();
        }

        let age = contractDate.getFullYear() - birthDate.getFullYear();
        let monthDifference = contractDate.getMonth() - birthDate.getMonth();

        if (
            monthDifference < 0 ||
            (monthDifference === 0 && contractDate.getDate() < birthDate.getDate())
        ) {
            age--;
        }

        if (age >= 0 && age <= 100) {
            $('#age-at-contract').val(age);
        } else {
            $('#age-at-contract').val('');
        }
    }


    // =========================================================
    // CURRENCY FORMATTER
    // =========================================================

    function syncCurrencyInput($input) {
        let rawValue = $input.val().replace(/\D/g, '');
        let targetId = $input.data('target');

        $('#' + targetId).val(rawValue);

        if (rawValue !== '') {
            $input.val(new Intl.NumberFormat('id-ID').format(rawValue));
        } else {
            $input.val('');
        }
    }

    // Inisialisasi awal: sinkronkan tampilan dari hidden input
    $('.currency-input').each(function () {
        let $input   = $(this);
        let targetId = $input.data('target');
        let raw      = $('#' + targetId).val();

        if (raw && raw !== '' && raw !== '0') {
            $input.val(new Intl.NumberFormat('id-ID').format(raw));
        } else {
            $input.val('');
        }
    });

    $(document).on('input', '.currency-input', function () {
        syncCurrencyInput($(this));
    });

    $(document).on('blur', '.currency-input', function () {
        syncCurrencyInput($(this));
    });


    // =========================================================
    // INITIAL LOAD
    // =========================================================

    fillEmployeeData();
    calculateAge();

});
</script>
@endsection