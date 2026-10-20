@extends('layouts.app')

@section('title', 'Tambah Contract')

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
                        Tambah Contract {{ strtoupper($type) }}
                    </h1>

                    <span class="text-gray-500 fs-7">
                        Kategori: <strong>{{ ucfirst($category) }}</strong> &mdash;
                        Buat contract kerja baru berdasarkan data employee
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

        <form action="{{ route('contracts.store') }}" method="POST">
            @csrf

            {{-- Hidden: type & category --}}
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="category" value="{{ $category }}">

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
                                   value="{{ old('contract_number') }}" required>
                        </div>

                        {{-- Contract Date --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Contract</label>
                            <input type="date" name="contract_date" id="contract-date" class="form-control"
                                   value="{{ old('contract_date', date('Y-m-d')) }}" required>
                        </div>

                        {{-- Start Date --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control"
                                   value="{{ old('start_date') }}" required>
                        </div>

                        {{-- End Date --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Berakhir</label>
                            <input type="date" name="end_date" class="form-control"
                                   value="{{ old('end_date') }}" required>
                        </div>

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Judul Contract</label>
                            <input type="text" name="title" class="form-control"
                                   placeholder="Contoh: Perjanjian Kerja Waktu Tertentu"
                                   value="{{ old('title', 'Perjanjian Kerja Waktu Tertentu') }}" required>
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
                                        {{ old('head_user_id') == $head->id ? 'selected' : '' }}>
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
                        <div class="col-md-6">
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
                                            {{ old('user_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                        @if ($employee->employee_number)
                                            - {{ $employee->employee_number }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if ($category === 'managerial' || $category === 'non-managerial')
    <div class="col-md-6">
        <label class="form-label">Golongan / Grade</label>
        <select name="grade" id="grade-select" class="form-select"
                data-control="select2"
                data-placeholder="Pilih Grade" required>
            <option value=""></option>

            <optgroup label="Managerial">
                <option value="M-8" {{ old('grade') == 'M-8' ? 'selected' : '' }}>M-8</option>
                <option value="M-7" {{ old('grade') == 'M-7' ? 'selected' : '' }}>M-7</option>
                <option value="M-5-6" {{ old('grade') == 'M-5-6' ? 'selected' : '' }}>M-5-6</option>
                <option value="M-3-4" {{ old('grade') == 'M-3-4' ? 'selected' : '' }}>M-3-4</option>
            </optgroup>

            <optgroup label="Non-Managerial">
                <option value="NM-5-6" {{ old('grade') == 'NM-5-6' ? 'selected' : '' }}>NM-5-6</option>
                <option value="NM-3-4" {{ old('grade') == 'NM-3-4' ? 'selected' : '' }}>NM-3-4</option>
                <option value="N-1-2" {{ old('grade') == 'NM-1-2' ? 'selected' : '' }}>NM-1-2</option>
            </optgroup>
        </select>
    </div>
@endif

                        {{-- Employee Name --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Employee</label>
                            <input type="text" name="employee_name" id="employee-name"
                                   class="form-control bg-light"
                                   value="{{ old('employee_name') }}" readonly>
                        </div>

                        {{-- Department --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department" id="employee-department"
                                   class="form-control"
                                   placeholder="Masukkan department"
                                   value="{{ old('department') }}">
                        </div>

                        {{-- NIK --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control"
                                   placeholder="Nomor Induk Karyawan"
                                   value="{{ old('nik') }}">
                        </div>

                        {{-- KTP --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. KTP</label>
                            <input type="text" name="ktp_number" class="form-control"
                                   placeholder="Nomor KTP"
                                   value="{{ old('ktp_number') }}">
                        </div>

                        {{-- Birth Place --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control"
                                   placeholder="Contoh: Balikpapan"
                                   value="{{ old('birth_place') }}">
                        </div>

                        {{-- Birth Date --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth-date" class="form-control"
                                   value="{{ old('birth_date') }}">
                        </div>

                        {{-- Age --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Umur</label>
                            <input type="number" name="age_at_contract" id="age-at-contract"
                                   class="form-control bg-light"
                                   value="{{ old('age_at_contract') }}" readonly>
                            <div class="text-muted fs-7 mt-2">Otomatis berdasarkan tanggal lahir.</div>
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="gender" class="form-select" data-control="select2">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        {{-- Address --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="address" class="form-control" rows="3"
                                      placeholder="Alamat employee">{{ old('address') }}</textarea>
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
                                        {{ old('project_id') == $project->id ? 'selected' : '' }}>
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
                                   value="{{ old('position') }}" required>
                        </div>

                        {{-- Work Location --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Lokasi Kerja</label>
                            <input type="text" name="work_location" class="form-control"
                                   placeholder="Contoh: Balikpapan"
                                   value="{{ old('work_location') }}" required>
                        </div>

                        {{-- Domicile --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Domisili</label>
                            <input type="text" name="domicile" class="form-control"
                                   placeholder="Contoh: Balikpapan dan sekitarnya"
                                   value="{{ old('domicile') }}" required>
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
                                       value="{{ old('basic_salary') ? number_format((float) old('basic_salary'), 0, ',', '.') : '' }}"
                                       inputmode="numeric"
                                       autocomplete="off"
                                       required>

                                <span class="input-group-text">/ Bulan</span>
                            </div>

                            <input type="hidden" name="basic_salary" id="basic_salary"
                                   value="{{ old('basic_salary') }}">
                        </div>

                    </div>
                </div>
            </div>


@php
    // Semua tipe yang punya blok tunjangan
    $allowanceTypes = [
        // =====================
        // Managerial
        // =====================
        'all-in',
        'gp-mahal-um-ut-fungsi',
        'gp-um-ut-fungsi',

        // =====================
        // Non-Managerial
        // =====================
        'security',
        'ob',
        'gp-um-ut-laut',
        'gp-um-ut',
        'gp-mahal-um-ut-fungsi-pls',
        'gp-mahal-um-ut',

        // =====================
        // Project — ENI
        // =====================
        'eni-civil-all-in',
        'eni-civil-reguler',
        'eni-smallcapital-all-in',
        'eni-smallcapital-reguler',
        'eni-muara-bakau-lembur',
        'eni-muara-bakau-all-in',

        // =====================
        // Project — Warlok / Medco
        // =====================
        'warlok-all-in',
        'warlok-lembur',
        'warlok-security',

        // =====================
        // Project — ELIS PHKT
        // =====================
        'elis-phkt-5-2',
        'elis-phkt-6-1',

        // =====================
        // Project — PHSS Major
        // =====================
        'phss-major-ai-1',
        'phss-major-ai-2',
        'phss-major-ai-3',
        'phss-driver',
        'phss-humas',
        'phss-reguler',
        'phss-security',

        // =====================
        // Project — Sand Monitoring
        // =====================
        'sandmon-teknisi-1',
        'sandmon-teknisi-2',

        // =====================
        // Project — Lain-lain
        // =====================
        'pep-lokal-buny',
        'sched-5-2',
        'lawe-lawe-reguler',
        'lawe-lawe-all-in',
        'ipfms-dobu',
    ];
@endphp
@if (in_array($type, $allowanceTypes))
    <div class="card mb-5">
        <div class="card-header">
            <div class="card-title">
                <h2 class="fw-bold text-gray-900">
                    Tunjangan {{ strtoupper($type) }}
                </h2>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-5">
                @include('admin.hrd.contracts.partials.create-pasal5')
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
                            Simpan Draft
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

        let rawValue = $input.val().replace(/\D/g, '');  // ambil digit saja
        let targetId = $input.data('target');

        // Set hidden input dengan angka mentah
        $('#' + targetId).val(rawValue);

        // Format tampilan
        if (rawValue !== '') {
            $input.val(new Intl.NumberFormat('id-ID').format(rawValue));
        } else {
            $input.val('');
        }
    }

    // Inisialisasi awal: sinkronkan tampilan dari hidden input (old input)
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

    // Bind event input
    $(document).on('input', '.currency-input', function () {
        syncCurrencyInput($(this));
    });

    // Pastikan sinkron saat blur (misal user paste atau edit cepat)
    $(document).on('blur', '.currency-input', function () {
        syncCurrencyInput($(this));
    });


    // =========================================================
    // INITIAL LOAD
    // =========================================================

    fillEmployeeData();
    calculateAge();

});
$(document).ready(function () {
    
    // =========================================================
    // AUTO-FILL DEPARTMENT BERDASARKAN TYPE
    // =========================================================
    const departmentMap = {
        // ENI
        'eni-civil-all-in'         : 'ENI - Civil and Structure Maintenance Services Project',
        'eni-civil-reguler'        : 'ENI - Civil and Structure Maintenance Services Project',
        'eni-smallcapital-all-in'  : 'ENI SMALL CAPITAL-Modification and Improvement for Facility Support Services',
        'eni-smallcapital-reguler' : 'ENI SMALL CAPITAL-Modification and Improvement for Facility Support Services',
        'eni-muara-bakau-lembur'   : 'ENI Muara Bakau Project',
        'eni-muara-bakau-all-in'   : 'ENI Muara Bakau Project',

        // Warlok / Medco
        'warlok-all-in'            : 'Tarakan Blanket Construction Services - Medco EP',
        'warlok-lembur'            : 'Tarakan Blanket Construction Services - Medco EP',
        'warlok-security'          : 'Tarakan Blanket Construction Services - Medco EP',

        // ELIS PHKT
        'elis-phkt-5-2'            : 'Installation of Fire & Gas Detector System At STN Terminal (ELIS PHKT)',
        'elis-phkt-6-1'            : 'ELIS PHKT Project (Maintenance)',

        // PHSS Major
        'phss-major-ai-1'          : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-major-ai-2'          : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-major-ai-3'          : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-driver'              : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-humas'               : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-reguler'             : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-security'            : 'PHSS - Major Construction OPLL Fase 2 Paket II',

        // Sand Monitoring
        'sandmon-teknisi-1'        : 'Sand Monitoring Services for PHM',
        'sandmon-teknisi-2'        : 'Sand Monitoring Services for PHM',

        // Lain-lain
        'pep-lokal-buny'           : 'PEP Project - Lokal Buny',
        'sched-5-2'                : 'Project Schedule 5-2',
        'lawe-lawe-reguler'        : 'CIMS Project - Lawe Lawe',
        'lawe-lawe-all-in'         : 'CIMS Project - Lawe Lawe',
        'ipfms-dobu'               : 'IPFMS - Dobu',
    };

    function autoFillDepartment() {
        // Ambil nilai type (bisa dari select dropdown atau hidden input)
        let type = $('#type-select').val() || $('input[name="type"]').val();
        
        // Ambil value department dari mapping
        let departmentValue = departmentMap[type] || '';

        // Isi ke input field
        $('#employee-department').val(departmentValue);
    }

    // Jalankan saat halaman pertama kali dimuat
    autoFillDepartment();

    // Jalankan setiap kali dropdown Type diubah (khusus create-new-from-existing)
    $('#type-select').on('change', function () {
        autoFillDepartment();
    });

});
</script>
@endsection