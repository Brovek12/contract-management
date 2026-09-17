@extends('layouts.app')

@section('title', 'Tambah Contract')

@section('content')

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="py-3 app-toolbar py-lg-6">

    <div id="kt_app_toolbar_container"
         class="container-xxl d-flex flex-stack">

        <div class="gap-2 d-flex flex-column justify-content-center">

            <div class="d-flex align-items-center gap-3">

                <a href="{{ route('contracts.index') }}"
                   class="btn btn-sm btn-light-primary">

                    <i class="ki-outline ki-arrow-left fs-3"></i>

                    Kembali

                </a>

                <div>

                   <h1 class="page-heading text-gray-900 fw-bold fs-3 m-0">
    Tambah Contract {{ strtoupper($type) }}
</h1>

                    <span class="text-gray-500 fs-7">
                        Buat contract kerja baru berdasarkan data employee
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>
<!--end::Toolbar-->


<!--begin::Content-->
<div id="kt_app_content"
     class="app-content flex-column-fluid">

    <div id="kt_app_content_container"
         class="app-container container-xxl">


        <form action="{{ route('contracts.store') }}"
              method="POST">

            @csrf


            <!-- ================================================== -->
            <!-- INFORMASI CONTRACT -->
            <!-- ================================================== -->

            <div class="card mb-5">

                <div class="card-header">

                    <div class="card-title">

                        <h2 class="fw-bold text-gray-900">
                            Informasi Contract
                        </h2>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-5">


                        {{-- Contract Number --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                No. Contract
                            </label>

                            <input
                                type="text"
                                name="contract_number"
                                class="form-control"
                                placeholder="Contoh: PKWT/001/2026"
                                value="{{ old('contract_number') }}"
                                required>

                        </div>


                        {{-- Contract Date --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Tanggal Contract
                            </label>

                            <input
                                type="date"
                                name="contract_date"
                                id="contract-date"
                                class="form-control"
                                value="{{ old('contract_date', date('Y-m-d')) }}"
                                required>

                        </div>


                        {{-- Start Date --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                class="form-control"
                                value="{{ old('start_date') }}"
                                required>

                        </div>


                        {{-- End Date --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Tanggal Berakhir
                            </label>

                            <input
                                type="date"
                                name="end_date"
                                class="form-control"
                                value="{{ old('end_date') }}"
                                required>

                        </div>


                        {{-- Title --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Judul Contract
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                placeholder="Contoh: Perjanjian Kerja Waktu Tertentu"
                                value="{{ old('title', 'Perjanjian Kerja Waktu Tertentu') }}"
                                required>

                        </div>


                        {{-- Head of Branch --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Head of Branch
                            </label>

                            <select
                                name="head_user_id"
                                class="form-select"
                                data-control="select2"
                                data-placeholder="Pilih Head of Branch">

                                <option value=""></option>

                                @foreach ($heads as $head)

                                    <option
                                        value="{{ $head->id }}"
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

                        <h2 class="fw-bold text-gray-900">
                            Data Employee
                        </h2>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-5">


                        {{-- Employee --}}
                        <div class="col-12">

                            <label class="required form-label fw-semibold">
                                Employee
                            </label>

                            <select
                                name="user_id"
                                id="employee-select"
                                class="form-select"
                                data-control="select2"
                                data-placeholder="Pilih Employee"
                                required>

                                <option value=""></option>

                                @foreach ($employees as $employee)

                                    <option
                                        value="{{ $employee->id }}"
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


                        {{-- Employee Name --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nama Employee
                            </label>

                            <input
                                type="text"
                                name="employee_name"
                                id="employee-name"
                                class="form-control bg-light"
                                value="{{ old('employee_name') }}"
                                readonly>

                        </div>


                        {{-- Department --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Department
                            </label>

                            <input
                                type="text"
                                name="department"
                                id="employee-department"
                                class="form-control"
                                placeholder="Masukkan department"
                                value="{{ old('department') }}">

                        </div>


                        {{-- NIK --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                NIK
                            </label>

                            <input
                                type="text"
                                name="nik"
                                class="form-control"
                                placeholder="Nomor Induk Kependudukan"
                                value="{{ old('nik') }}">

                        </div>


                        {{-- KTP --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                No. KTP
                            </label>

                            <input
                                type="text"
                                name="ktp_number"
                                class="form-control"
                                placeholder="Nomor KTP"
                                value="{{ old('ktp_number') }}">

                        </div>


                        {{-- Birth Place --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Tempat Lahir
                            </label>

                            <input
                                type="text"
                                name="birth_place"
                                class="form-control"
                                placeholder="Contoh: Balikpapan"
                                value="{{ old('birth_place') }}">

                        </div>


                        {{-- Birth Date --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                name="birth_date"
                                id="birth-date"
                                class="form-control"
                                value="{{ old('birth_date') }}">

                        </div>


                        {{-- Age --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Umur
                            </label>

                            <input
                                type="number"
                                name="age_at_contract"
                                id="age-at-contract"
                                class="form-control bg-light"
                                value="{{ old('age_at_contract') }}"
                                readonly>

                            <div class="text-muted fs-7 mt-2">
                                Otomatis berdasarkan tanggal lahir.
                            </div>

                        </div>


                        {{-- Gender --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Jenis Kelamin
                            </label>

                            <select
                                name="gender"
                                class="form-select"
                                data-control="select2">

                                <option value="">
                                    Pilih Jenis Kelamin
                                </option>

                                <option value="Laki-laki"
                                    {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>

                                <option value="Perempuan"
                                    {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>

                            </select>

                        </div>


                        {{-- Address --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Alamat
                            </label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
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

                        <h2 class="fw-bold text-gray-900">
                            Penempatan & Pendapatan
                        </h2>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-5">


                        {{-- Project --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Project
                            </label>

                            <select
                                name="project_id"
                                class="form-select"
                                data-control="select2"
                                data-placeholder="Pilih Project">

                                <option value=""></option>

                                @foreach ($projects as $project)

                                    <option
                                        value="{{ $project->id }}"
                                        {{ old('project_id') == $project->id ? 'selected' : '' }}>

                                        {{ $project->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Position --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Posisi
                            </label>

                            <input
                                type="text"
                                name="position"
                                class="form-control"
                                placeholder="Contoh: Welder"
                                value="{{ old('position') }}"
                                required>

                        </div>


                        {{-- Work Location --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Lokasi Kerja
                            </label>

                            <input
                                type="text"
                                name="work_location"
                                class="form-control"
                                placeholder="Contoh: Balikpapan"
                                value="{{ old('work_location') }}"
                                required>

                        </div>


                        {{-- Domicile --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Domisili
                            </label>

                            <input
                                type="text"
                                name="domicile"
                                class="form-control"
                                placeholder="Contoh: Balikpapan dan sekitarnya"
                                value="{{ old('domicile') }}"
                                required>

                        </div>


                        {{-- Basic Salary --}}
                        <div class="col-md-6">

                            <label class="required form-label fw-semibold">
                                Gaji Pokok
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="basic_salary"
                                    class="form-control"
                                    placeholder="0"
                                    value="{{ old('basic_salary') }}"
                                    min="0"
                                    required>

                                <span class="input-group-text">
                                    / Bulan
                                </span>

                            </div>

                        </div>
                        @if ($type === 'phm')

    <div class="card mb-5">

        <div class="card-header">
            <div class="card-title">
                <h2 class="fw-bold text-gray-900">
                    Tunjangan PHM
                </h2>
            </div>
        </div>

        <div class="card-body">

            <div class="row g-5">

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Tunjangan Kendaraan
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">Rp</span>

                        <input
                            type="number"
                            name="vehicle_allowance"
                            class="form-control"
                            value="{{ old('vehicle_allowance', 0) }}"
                            min="0">

                        <span class="input-group-text">
                            / Bulan
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Tunjangan Kesehatan
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">Rp</span>

                        <input
                            type="number"
                            name="health_allowance"
                            class="form-control"
                            value="{{ old('health_allowance', 0) }}"
                            min="0">

                        <span class="input-group-text">
                            / Bulan
                        </span>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endif

                    </div>

                </div>

            </div>


            <!-- ================================================== -->
            <!-- ACTION -->
            <!-- ================================================== -->

            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-end gap-3">

                        <a href="{{ route('contracts.index') }}"
                           class="btn btn-light">

                            Batal

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary">

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

    function fillEmployeeData() {

        let employeeId = $('#employee-select').val();
        if (!employeeId) {

            $('#employee-name').val('');

            return;
        }

        let selectedOption = $('#employee-select').find('option:selected');

        let employeeName = selectedOption.attr('data-name');
        $('#employee-name').val(employeeName || '');
    }


    // =========================================================
    // EMPLOYEE — handle Select2 & native change
    // =========================================================

    // Event dari Select2
    $('#employee-select').on('select2:select', function (e) {
        fillEmployeeData();
    });

    // Event native change (fallback & programmatic trigger)
    $('#employee-select').on('change', function () {

        fillEmployeeData();
    });


    // =========================================================
    // BIRTH DATE
    // =========================================================

    $('#birth-date').on('change', function () {

        calculateAge();
    });


    // =========================================================
    // CONTRACT DATE
    // =========================================================

    $('#contract-date').on('change', function () {
        calculateAge();
    });


    // =========================================================
    // CALCULATE AGE
    // =========================================================

    function calculateAge() {

        let birthDateValue = $('#birth-date').val();

        let contractDateValue = $('#contract-date').val();
        if (!birthDateValue) {

            $('#age-at-contract').val('');

            return;
        }


        let birthDate = new Date(
            birthDateValue + 'T00:00:00'
        );


        let contractDate;

        if (contractDateValue) {

            contractDate = new Date(
                contractDateValue + 'T00:00:00'
            );

        } else {

            contractDate = new Date();

        }


        let age =
            contractDate.getFullYear() -
            birthDate.getFullYear();


        let monthDifference =
            contractDate.getMonth() -
            birthDate.getMonth();


        if (
            monthDifference < 0 ||
            (
                monthDifference === 0 &&
                contractDate.getDate() < birthDate.getDate()
            )
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
    // INITIAL LOAD
    // =========================================================


    // Isi nama employee dari old input (jika ada)
    fillEmployeeData();


    // Hitung age dari old input (jika ada)
    calculateAge();


});
</script>
@endsection