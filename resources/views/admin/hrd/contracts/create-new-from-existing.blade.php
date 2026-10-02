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
                                    <option value="gp-mahal-um-ut-fungsi-pls" {{ $type === 'gp-mahal-um-ut-fungsi-pls' ? 'selected' : '' }}>GP + Kemahalan + UM + UT + Fungsional + Pulsa</option>
                                    <option value="gp-mahal-um-ut"            {{ $type === 'gp-mahal-um-ut' ? 'selected' : '' }}>GP + Kemahalan + UM + UT</option>
                                </optgroup>

                                <optgroup label="Project" data-category="project">
                                    <option value="pep-lokal-buny"          {{ $type === 'pep-lokal-buny' ? 'selected' : '' }}>PEP Lokal Bunyu</option>
                                    <option value="elis-phkt-5-2"           {{ $type === 'elis-phkt-5-2' ? 'selected' : '' }}>ELIS PHKT 5.2</option>
                                    <option value="elis-phkt-6-1"           {{ $type === 'elis-phkt-6-1' ? 'selected' : '' }}>ELIS PHKT 6.1</option>
                                    <option value="eni-muara-bakau-lembur"  {{ $type === 'eni-muara-bakau-lembur' ? 'selected' : '' }}>ENI Muara Bakau (Lembur)</option>
                                    <option value="eni-muara-bakau-all-in"  {{ $type === 'eni-muara-bakau-all-in' ? 'selected' : '' }}>ENI Muara Bakau (All In)</option>
                                    <option value="ipfms-dobu"              {{ $type === 'ipfms-dobu' ? 'selected' : '' }}>IPFMS Dobu</option>
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

                        {{-- Contract Number — KOSONG --}}
                        <div class="col-md-6">
                            <label class="required form-label fw-semibold">No. Contract</label>
                            <input type="text" name="contract_number" class="form-control"
                                   placeholder="Contoh: PKWT/001/2026"
                                   value="{{ old('contract_number') }}" required>
                            <div class="text-muted fs-7 mt-2">
                                Contract sebelumnya: <strong>{{ $source->contract_number }}</strong>
                            </div>
                        </div>

                        {{-- Contract Date — default hari ini --}}
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
    // BIRTH DATE / CONTRACT DATE → AGE
    // =========================================================

    $('#birth-date').on('change', calculateAge);
    $('#contract-date').on('change', calculateAge);

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
        let monthDiff = contractDate.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && contractDate.getDate() < birthDate.getDate())) {
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

    function initCurrencyInputs() {
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
    }

    $(document).on('input', '.currency-input', function () {
        syncCurrencyInput($(this));
    });

    $(document).on('blur', '.currency-input', function () {
        syncCurrencyInput($(this));
    });

    initCurrencyInputs();


    // =========================================================
    // TYPE & CATEGORY — Dynamic Allowance Fields
    // =========================================================

    // Aktif/nonaktifkan optgroup sesuai category
    function filterTypesByCategory() {
        let category = $('#category-select').val();
        let $typeSelect = $('#type-select');

        $typeSelect.find('optgroup').each(function () {
            let groupCategory = $(this).data('category');
            $(this).prop('disabled', category && groupCategory !== category);
        });

        // Kalau type saat ini tidak sesuai category → reset
        let selectedType = $typeSelect.val();
        if (selectedType) {
            let selectedGroup = $typeSelect.find('option:selected').closest('optgroup');
            let groupCategory = selectedGroup.data('category');

            if (category && groupCategory !== category) {
                $typeSelect.val('').trigger('change.select2');
                $('#allowance-section').html('');
            }
        }

        $typeSelect.trigger('change.select2');
    }

    // Update toolbar text
    function updateToolbar() {
        let type = $('#type-select').val() || '';
        let category = $('#category-select').val() || '';

        $('#toolbar-type').text(type.toUpperCase() || '-');
        $('#toolbar-category').text(category ? category.charAt(0).toUpperCase() + category.slice(1) : '-');
    }

    // AJAX re-render allowance fields
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

                // Update toolbar
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

    // Bind event
    $('#category-select').on('change', function () {
        filterTypesByCategory();
        updateToolbar();
    });

    $('#type-select').on('change', function () {
        reloadAllowanceFields();
    });


    // =========================================================
    // INITIAL LOAD
    // =========================================================

    fillEmployeeData();
    calculateAge();
    filterTypesByCategory();
    updateToolbar();

});
</script>
@endsection