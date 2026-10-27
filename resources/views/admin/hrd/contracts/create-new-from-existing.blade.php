@extends('layouts.app')

@section('title', 'Tambah Contract (Clone)')

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
                        Tambah Contract <span id="toolbar-type">{{ strtoupper($type) }}</span>
                    </h1>

                    <span class="text-gray-500 fs-7">
                        Kategori: <strong id="toolbar-category">{{ ucfirst($category) }}</strong> &mdash;
                        Berdasarkan contract <strong>{{ $source->contract_number }}</strong>
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

            {{-- ================================================== --}}
            {{-- TYPE & CATEGORY --}}
            {{-- ================================================== --}}
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <h2 class="fw-bold text-gray-900">Tipe & Kategori Contract</h2>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-5">

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Category</label>
                            <select name="category" id="category-select" class="form-select"
                                    data-control="select2"
                                    data-placeholder="Pilih Category" required>
                                <option value=""></option>
                                <option value="managerial"     {{ $category === 'managerial' ? 'selected' : '' }}>Managerial</option>
                                <option value="non-managerial" {{ $category === 'non-managerial' ? 'selected' : '' }}>Non-Managerial</option>
                                <option value="project"        {{ $category === 'project' ? 'selected' : '' }}>Project</option>
                            </select>
                        </div>

                        {{-- Type --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Type</label>
                            <select name="type" id="type-select" class="form-select"
                                    data-control="select2"
                                    data-placeholder="Pilih Type" required>
                                <option value=""></option>

                                <optgroup label="Managerial" data-category="managerial">
                                    <option value="all-in"                {{ $type === 'all-in' ? 'selected' : '' }}>All In</option>
                                    <option value="gp-mahal-um-ut-fungsi" {{ $type === 'gp-mahal-um-ut-fungsi' ? 'selected' : '' }}>GP + Kemahalan + UM + UT + Fungsional</option>
                                    <option value="gp-um-ut-fungsi"       {{ $type === 'gp-um-ut-fungsi' ? 'selected' : '' }}>GP + UM + UT + Fungsional</option>
                                </optgroup>

                                <optgroup label="Non-Managerial" data-category="non-managerial">
                                    <option value="security"                  {{ $type === 'security' ? 'selected' : '' }}>Security</option>
                                    <option value="ob"                        {{ $type === 'ob' ? 'selected' : '' }}>OB</option>
                                    <option value="gp-um-ut-laut"             {{ $type === 'gp-um-ut-laut' ? 'selected' : '' }}>GP + UM + UT + Laut</option>
                                    <option value="gp-um-ut"                  {{ $type === 'gp-um-ut' ? 'selected' : '' }}>GP + UM + UT</option>
                                    <option value="gp-mahal-um-ut-fungsi"     {{ $type === 'gp-mahal-um-ut-fungsi' ? 'selected' : '' }}>GP + Kemahalan + UM + UT + Fungsional</option>
                                    <option value="gp-mahal-um-ut-fungsi-pls" {{ $type === 'gp-mahal-um-ut-fungsi-pls' ? 'selected' : '' }}>GP + Kemahalan + UM + UT + Fungsional + Pulsa</option>
                                    <option value="gp-mahal-um-ut"            {{ $type === 'gp-mahal-um-ut' ? 'selected' : '' }}>GP + Kemahalan + UM + UT</option>
                                </optgroup>

                                <optgroup label="Project — ENI" data-category="project">
                                    <option value="eni-civil-all-in"          {{ $type === 'eni-civil-all-in' ? 'selected' : '' }}>ENI Civil (All In)</option>
                                    <option value="eni-civil-reguler"         {{ $type === 'eni-civil-reguler' ? 'selected' : '' }}>ENI Civil (Reguler)</option>
                                    <option value="eni-smallcapital-all-in"   {{ $type === 'eni-smallcapital-all-in' ? 'selected' : '' }}>ENI Small Capital (All In)</option>
                                    <option value="eni-smallcapital-reguler"  {{ $type === 'eni-smallcapital-reguler' ? 'selected' : '' }}>ENI Small Capital (Reguler)</option>
                                    <option value="eni-muara-bakau-lembur"    {{ $type === 'eni-muara-bakau-lembur' ? 'selected' : '' }}>ENI Muara Bakau (Lembur)</option>
                                    <option value="eni-muara-bakau-all-in"    {{ $type === 'eni-muara-bakau-all-in' ? 'selected' : '' }}>ENI Muara Bakau (All In)</option>
                                </optgroup>

                                <optgroup label="Project — Warlok / Medco" data-category="project">
                                    <option value="warlok-all-in"             {{ $type === 'warlok-all-in' ? 'selected' : '' }}>Warlok Medco (All In)</option>
                                    <option value="warlok-lembur"             {{ $type === 'warlok-lembur' ? 'selected' : '' }}>Warlok Medco (Lembur)</option>
                                    <option value="warlok-security"           {{ $type === 'warlok-security' ? 'selected' : '' }}>Warlok Medco (Security)</option>
                                </optgroup>

                                <optgroup label="Project — ELIS PHKT" data-category="project">
                                    <option value="elis-phkt-5-2"             {{ $type === 'elis-phkt-5-2' ? 'selected' : '' }}>ELIS PHKT 5.2</option>
                                    <option value="elis-phkt-6-1"             {{ $type === 'elis-phkt-6-1' ? 'selected' : '' }}>ELIS PHKT 6.1</option>
                                </optgroup>

                                <optgroup label="Project — PHSS Major" data-category="project">
                                    <option value="phss-major-ai-1"           {{ $type === 'phss-major-ai-1' ? 'selected' : '' }}>PHSS Major (All In Type 1)</option>
                                    <option value="phss-major-ai-2"           {{ $type === 'phss-major-ai-2' ? 'selected' : '' }}>PHSS Major (All In Type 2)</option>
                                    <option value="phss-major-ai-3"           {{ $type === 'phss-major-ai-3' ? 'selected' : '' }}>PHSS Major (All In Type 3)</option>
                                    <option value="phss-driver"               {{ $type === 'phss-driver' ? 'selected' : '' }}>PHSS Major (Driver)</option>
                                    <option value="phss-humas"                {{ $type === 'phss-humas' ? 'selected' : '' }}>PHSS Major (Humas)</option>
                                    <option value="phss-reguler"              {{ $type === 'phss-reguler' ? 'selected' : '' }}>PHSS Major (Reguler)</option>
                                    <option value="phss-security"             {{ $type === 'phss-security' ? 'selected' : '' }}>PHSS Major (Security)</option>
                                </optgroup>

                                <optgroup label="Project — Sand Monitoring" data-category="project">
                                    <option value="sandmon-teknisi-1"         {{ $type === 'sandmon-teknisi-1' ? 'selected' : '' }}>Sand Monitoring (Teknisi 1)</option>
                                    <option value="sandmon-teknisi-2"         {{ $type === 'sandmon-teknisi-2' ? 'selected' : '' }}>Sand Monitoring (Teknisi 2)</option>
                                </optgroup>

                                <optgroup label="Project — Lain-lain" data-category="project">
                                    <option value="pep-lokal-buny"            {{ $type === 'pep-lokal-buny' ? 'selected' : '' }}>PEP Lokal Bunyu</option>
                                    <option value="sched-5-2"                 {{ $type === 'sched-5-2' ? 'selected' : '' }}>Schedule 5-2 Rev. 2026</option>
                                    <option value="lawe-lawe-reguler"         {{ $type === 'lawe-lawe-reguler' ? 'selected' : '' }}>LAWE LAWE (Reguler)</option>
                                    <option value="lawe-lawe-all-in"          {{ $type === 'lawe-lawe-all-in' ? 'selected' : '' }}>LAWE LAWE (All In)</option>
                                    <option value="ipfms-dobu"                {{ $type === 'ipfms-dobu' ? 'selected' : '' }}>IPFMS Dobu Tetap</option>
                                    <option value="ipfms-dobu-2"                {{ $type === 'ipfms-dobu-2' ? 'selected' : '' }}>IPFMS Dobu Tidak Tetap</option>
                                </optgroup>
                            </select>
                        </div>

                    </div>
                </div>
            </div>


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
                            <div class="text-muted fs-7 mt-2">
                                Contract sebelumnya: <strong>{{ $source->contract_number }}</strong>
                            </div>
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
                                   value="{{ old('start_date', optional($source->start_date)->format('Y-m-d')) }}"
                                   required>
                        </div>

                        {{-- End Date --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Tanggal Berakhir</label>
                            <input type="date" name="end_date" class="form-control"
                                   value="{{ old('end_date', optional($source->end_date)->format('Y-m-d')) }}"
                                   required>
                        </div>

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Judul Contract</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $source->title) }}" required>
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
                                        {{ old('head_user_id', $source->head_user_id) == $head->id ? 'selected' : '' }}>
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
                                            {{ old('user_id', $source->user_id) == $employee->id ? 'selected' : '' }}>
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
                                   value="{{ old('employee_name', $source->employee_name) }}" readonly>
                        </div>

                        {{-- Grade: muncul untuk managerial & non-managerial, tidak untuk project --}}
                        <div class="col-md-6" id="grade-wrapper"
                             style="{{ in_array($category, ['managerial', 'non-managerial']) ? '' : 'display: none;' }}">
                            <label class="form-label fw-semibold">Golongan / Grade</label>
                            <select name="grade" id="grade-select" class="form-select"
                                    data-control="select2"
                                    data-placeholder="Pilih Grade">
                                <option value=""></option>
                            </select>
                        </div>

                        {{-- Department --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department" id="employee-department"
                                   class="form-control"
                                   placeholder="Masukkan department"
                                   value="{{ old('department', $source->department) }}">
                        </div>

                        {{-- NIK --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control"
                                   placeholder="Nomor Induk Karyawan"
                                   value="{{ old('nik', $source->nik) }}">
                        </div>

                        {{-- KTP --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. KTP</label>
                            <input type="text" name="ktp_number" class="form-control"
                                   placeholder="Nomor KTP"
                                   value="{{ old('ktp_number', $source->ktp_number) }}">
                        </div>

                        {{-- Birth Place --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control"
                                   placeholder="Contoh: Balikpapan"
                                   value="{{ old('birth_place', $source->birth_place) }}">
                        </div>

                        {{-- Birth Date --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth-date" class="form-control"
                                   value="{{ old('birth_date', optional($source->birth_date)->format('Y-m-d')) }}">
                        </div>

                        {{-- Age --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Umur</label>
                            <input type="number" name="age_at_contract" id="age-at-contract"
                                   class="form-control bg-light"
                                   value="{{ old('age_at_contract', $source->age_at_contract) }}" readonly>
                            <div class="text-muted fs-7 mt-2">Otomatis berdasarkan tanggal lahir.</div>
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="gender" class="form-select" data-control="select2">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ old('gender', $source->gender) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('gender', $source->gender) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        {{-- Address --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="address" class="form-control" rows="3"
                                      placeholder="Alamat employee">{{ old('address', $source->address) }}</textarea>
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
                                        {{ old('project_id', $source->project_id) == $project->id ? 'selected' : '' }}>
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
                                   value="{{ old('position', $source->position) }}" required>
                        </div>

                        {{-- Work Location --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Lokasi Kerja</label>
                            <input type="text" name="work_location" class="form-control"
                                   placeholder="Contoh: Balikpapan"
                                   value="{{ old('work_location', $source->work_location) }}" required>
                        </div>

                        {{-- Domicile --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">Domisili</label>
                            <input type="text" name="domicile" class="form-control"
                                   placeholder="Contoh: Balikpapan dan sekitarnya"
                                   value="{{ old('domicile', $source->domicile) }}" required>
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
                                       value="{{ old('basic_salary', $source->basic_salary) ? number_format((float) old('basic_salary', $source->basic_salary), 0, ',', '.') : '' }}"
                                       inputmode="numeric"
                                       autocomplete="off"
                                       required>

                                <span class="input-group-text">/ Bulan</span>
                            </div>

                            <input type="hidden" name="basic_salary" id="basic_salary"
                                   value="{{ old('basic_salary', $source->basic_salary) }}">
                        </div>

                    </div>
                </div>
            </div>


            {{-- ================================================== --}}
            {{-- TUNJANGAN (dynamic container) --}}
            {{-- ================================================== --}}
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
                    'ipfms-dobu-2',
                ];
            @endphp

            <div id="allowance-section">
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
                                @include('admin.hrd.contracts.partials.create-pasal5', [
                                    'contract' => $source,
                                    'type'     => $type,
                                ])
                            </div>
                        </div>
                    </div>
                @endif
            </div>


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
    // 1. EMPLOYEE & AGE
    // =========================================================
    function fillEmployeeData() {
        let employeeId = $('#employee-select').val();
        if (!employeeId) {
            $('#employee-name').val('');
            return;
        }
        let employeeName = $('#employee-select').find('option:selected').attr('data-name');
        $('#employee-name').val(employeeName || '');
    }

    $('#employee-select').on('select2:select change', function () {
        fillEmployeeData();
    });

    $('#birth-date, #contract-date').on('change', function () {
        calculateAge();
    });

    function calculateAge() {
        let birthDateValue = $('#birth-date').val();
        let contractDateValue = $('#contract-date').val();
        if (!birthDateValue) {
            $('#age-at-contract').val('');
            return;
        }
        let birthDate = new Date(birthDateValue + 'T00:00:00');
        let contractDate = contractDateValue ? new Date(contractDateValue + 'T00:00:00') : new Date();
        let age = contractDate.getFullYear() - birthDate.getFullYear();
        let monthDifference = contractDate.getMonth() - birthDate.getMonth();
        if (monthDifference < 0 || (monthDifference === 0 && contractDate.getDate() < birthDate.getDate())) {
            age--;
        }
        if (age >= 0 && age <= 100) $('#age-at-contract').val(age);
        else $('#age-at-contract').val('');
    }


    // =========================================================
    // 2. CURRENCY FORMATTER (HANYA UNTUK INPUT MANUAL)
    // =========================================================
    function syncCurrencyInput($input) {
        let rawValue = $input.val().replace(/\D/g, '');
        let targetId = $input.data('target');
        
        if(targetId) {
            $('#' + targetId).val(rawValue); // Simpan angka mentah ke hidden input
        }

        if (rawValue !== '') {
            $input.val(new Intl.NumberFormat('id-ID').format(rawValue)); // Format ke tampilan
        } else {
            $input.val('');
        }
    }

    function initCurrencyInputs() {
        $('.currency-input').each(function () {
            let $input = $(this);
            let targetId = $input.data('target');
            let raw = $('#' + targetId).val() || $input.val(); 
            
            if (raw && raw !== '' && raw !== '0') {
                $input.val(new Intl.NumberFormat('id-ID').format(raw));
            } else {
                $input.val('');
            }
        });
    }

    // Hanya gunakan event 'input' agar tidak bentrok
    $(document).on('input', '.currency-input', function () {
        syncCurrencyInput($(this));
    });

    initCurrencyInputs();


    // =========================================================
    // 3. KALKULASI SANDMON (EWHC & ANNUAL LEAVE)
    // =========================================================
    function getCleanNumber(val) {
        if (!val) return 0;
        return parseFloat(val.toString().replace(/[^0-9,-]+/g,"").replace(",", ".")) || 0;
    }

    function calculateSandmon() {
        const housingInput = document.querySelector('input[data-target="housing_allowance"]');
        const transportInput = document.querySelector('input[data-target="transport_allowance"]');
        
        if (!housingInput || !transportInput) return; // Bukan form sandmon

        // PERBAIKAN: Ambil dari input teks (data-target="basic_salary"), BUKAN id="basic_salary"
        let basicText = $('input[data-target="basic_salary"]').val(); 
        let basic = getCleanNumber(basicText);
        
        let housing = getCleanNumber(housingInput.value);
        let transport = getCleanNumber(transportInput.value);

        let thp = basic + housing + transport;
        let ewhc = thp * 0.65;
        let annualLeave = basic / 12;

        let ewhcFormatted = new Intl.NumberFormat('id-ID').format(Math.round(ewhc));
        let annualFormatted = new Intl.NumberFormat('id-ID').format(Math.round(annualLeave));

        // Isi tampilan
        $('#ewhc_allowance_display').val(ewhcFormatted);
        $('#annual_leave_display').val(annualFormatted);

        // Isi hidden input untuk DB
        $('#ewhc_allowance').val(Math.round(ewhc));
        $('#annual_leave_allowance').val(Math.round(annualLeave));
    }

    // Jalankan saat pertama kali load
    calculateSandmon();

    // Jalankan ulang setelah 0.5 detik (mengalahkan plugin formatter template)
    setTimeout(function() {
        calculateSandmon();
    }, 500);

    // Dengarkan perubahan secara realtime
    $(document).on('input', 'input[data-target="basic_salary"], input[data-target="housing_allowance"], input[data-target="transport_allowance"]', function() {
        calculateSandmon();
    });


    // =========================================================
    // 4. GRADE & TYPE DYNAMIC (Bawaan Anda)
    // =========================================================
    const GRADE_OPTIONS = {
        'managerial': [
            { value: 'M-8', label: 'M-8' },
            { value: 'M-7', label: 'M-7' },
            { value: 'M-5-6', label: 'M-5-6' },
            { value: 'M-3-4', label: 'M-3-4' },
        ],
        'non-managerial': [
            { value: 'NM-5-6', label: 'NM-5-6' },
            { value: 'NM-3-4', label: 'NM-3-4' },
            { value: 'NM-1-2', label: 'NM-1-2' },
        ],
    };

    const SAVED_GRADE = @json(old('grade', $source->grade ?? ''));

    function renderGradeOptions() {
        const category = $('#category-select').val();
        const $wrapper = $('#grade-wrapper');
        const $select  = $('#grade-select');

        $select.html('<option value=""></option>');

        if (!category || !GRADE_OPTIONS[category]) {
            $wrapper.hide();
            $select.removeAttr('required');
            $select.trigger('change.select2');
            return;
        }

        $wrapper.show();
        $select.attr('required', 'required');

        let groupLabel = category === 'managerial' ? 'Managerial' : 'Non-Managerial';
        let $optgroup  = $('<optgroup>').attr('label', groupLabel);

        GRADE_OPTIONS[category].forEach(function (g) {
            let $opt = $('<option>').attr('value', g.value).text(g.label);
            if (SAVED_GRADE === g.value) {
                $opt.attr('selected', 'selected');
            }
            $optgroup.append($opt);
        });

        $select.append($optgroup);
        $select.trigger('change.select2');
    }

    function filterTypesByCategory() {
        let category = $('#category-select').val();
        let $typeSelect = $('#type-select');

        $typeSelect.find('optgroup').each(function () {
            let groupCategory = $(this).data('category');
            $(this).prop('disabled', category && groupCategory !== category);
        });

        let selectedType = $typeSelect.val();
        if (selectedType) {
            let selectedGroup = $typeSelect.find('option:selected').closest('optgroup');
            let groupCategory = selectedGroup.data('category');

            if (category && groupCategory !== category) {
                $typeSelect.val('').trigger('change');
                $('#allowance-section').html('');
            }
        }
        $typeSelect.trigger('change.select2');
    }

    function updateToolbar() {
        let type = $('#type-select').val() || '';
        let category = $('#category-select').val() || '';
        $('#toolbar-type').text(type.toUpperCase() || '-');
        $('#toolbar-category').text(category ? category.charAt(0).toUpperCase() + category.slice(1) : '-');
    }

    function reloadAllowanceFields() {
        let type = $('#type-select').val();

        if (!type) {
            $('#allowance-section').html('');
            updateToolbar();
            return;
        }

        $.ajax({
            url: '{{ route("contracts.allowance-fields") }}',
            type: 'GET',
            data: { type: type },
            success: function (response) {
                if (response.html && response.html.trim() !== '') {
                    let cardHtml = `
                        <div class="card mb-5">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="fw-bold text-gray-900">
                                        Tunjangan ${type.toUpperCase()}
                                    </h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-5">
                                    ${response.html}
                                </div>
                            </div>
                        </div>
                    `;
                    $('#allowance-section').html(cardHtml);
                } else {
                    $('#allowance-section').html('');
                }

                // Re-init currency input untuk field tunjangan baru
                initCurrencyInputs();
                calculateSandmon(); // Hitung ulang jika tipe baru sandmon

                updateToolbar();
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Tidak dapat memuat field tunjangan.'
                });
            }
        });
    }

    // Bind Event
    $('#category-select').on('change', function () {
        renderGradeOptions();
        filterTypesByCategory();
        updateToolbar();
    });

    $('#type-select').on('change', function () {
        reloadAllowanceFields();
        updateToolbar();
    });


    // =========================================================
    // 5. AUTO-FILL DEPARTMENT
    // =========================================================
    const departmentMap = {
        'eni-civil-all-in'         : 'ENI - Civil and Structure Maintenance Services Project',
        'eni-civil-reguler'        : 'ENI - Civil and Structure Maintenance Services Project',
        'eni-smallcapital-all-in'  : 'ENI SMALL CAPITAL-Modification and Improvement for Facility Support Services',
        'eni-smallcapital-reguler' : 'ENI SMALL CAPITAL-Modification and Improvement for Facility Support Services',
        'eni-muara-bakau-lembur'   : 'ENI Muara Bakau Project',
        'eni-muara-bakau-all-in'   : 'ENI Muara Bakau Project',
        'warlok-all-in'            : 'Tarakan Blanket Construction Services - Medco EP',
        'warlok-lembur'            : 'Tarakan Blanket Construction Services - Medco EP',
        'warlok-security'          : 'Tarakan Blanket Construction Services - Medco EP',
        'elis-phkt-5-2'            : 'Installation of Fire & Gas Detector System At STN Terminal (ELIS PHKT)',
        'elis-phkt-6-1'            : 'ELIS PHKT Project (Maintenance)',
        'phss-major-ai-1'          : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-major-ai-2'          : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-major-ai-3'          : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-driver'              : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-humas'               : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-reguler'             : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'phss-security'            : 'PHSS - Major Construction OPLL Fase 2 Paket II',
        'sandmon-teknisi-1'        : 'Sand Monitoring Services for PHM',
        'sandmon-teknisi-2'        : 'Sand Monitoring Services for PHM',
        'pep-lokal-buny'           : 'PEP Project - Lokal Buny',
        'sched-5-2'                : 'Project Schedule 5-2',
        'lawe-lawe-reguler'        : 'CIMS Project - Lawe Lawe',
        'lawe-lawe-all-in'         : 'CIMS Project - Lawe Lawe',
        'ipfms-dobu'               : 'IPFMS - Dobu',
        'ipfms-dobu-2'               : 'IPFMS - Dobu',
    };

    function autoFillDepartment() {
        let type = $('#type-select').val();
        let departmentValue = departmentMap[type] || '';
        $('#employee-department').val(departmentValue);
    }

    $('#type-select').on('change', function () {
        autoFillDepartment();
    });


    // =========================================================
    // 6. INITIAL LOAD
    // =========================================================
    fillEmployeeData();
    calculateAge();
    renderGradeOptions();
    filterTypesByCategory();
    updateToolbar();

});
</script>
@endsection