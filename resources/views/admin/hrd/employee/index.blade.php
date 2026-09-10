
@extends('layouts.app')

@section('title', 'Employee')

@section('style')

@endsection

@section('pageTitle', 'Employee')
@section('mainSection', 'Contract Management')
@section('currentSection', 'Employee')

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">

            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">

                <!--begin::Card-->
                <div class="mb-5 card mb-xl-8">

                    <!--begin::Header-->
                    <div class="p-0 pt-5 border-0 card-header">

                        <h3 class="card-title align-items-start flex-column">
                            <span class="mb-1 card-label fw-bold fs-3 ps-6">
                                List Employee
                            </span>
                        </h3>

                        <div class="card-toolbar">

                            <!--begin::Search-->
                            <div class="my-1 d-flex align-items-center position-relative me-5 rounded-3">

                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>

                                <input type="text"
                                    data-kt-docs-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-15"
                                    placeholder="Cari Employee..."
                                    style="height: calc(1.5em + 0.75rem + 2px);" />

                            </div>
                            <!--end::Search-->

                        </div>

                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="p-0 card-body">

                        <!--begin::Table container-->
                        <div class="table-responsive table-bordered">

                            <!--begin::Table-->
                            <table class="table text-center align-middle gs-0 gy-4" id="employeeTable">

                                <!--begin::Table head-->
                                <thead>
                                    <tr class="p-0 fw-bold text-muted">

                                        <th class="text-center bg-light">
                                            No
                                        </th>

                                        <th class="text-center bg-light">
                                            Foto
                                        </th>

                                        <th class="text-center bg-light">
                                            Employee Number
                                        </th>

                                        <th class="text-center bg-light">
                                            Nama
                                        </th>

                                        <th class="text-center bg-light">
                                            Email
                                        </th>

                                        <th class="text-center bg-light">
                                            Nomor HP
                                        </th>

                                        <th class="text-center bg-light">
                                            Status
                                        </th>

                                        <th class="text-center bg-light">
                                            Aksi
                                        </th>

                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>

                                    @foreach ($data as $index => $item)

                                        <tr>

                                            <!-- No -->
                                            <td class="text-center">
                                                {{ $index + 1 }}
                                            </td>

                                            <!-- Foto -->
                                            <td class="text-center">

                                                @if ($item->foto)

                                                    <img src="{{ asset($item->foto) }}"
                                                        alt="User Foto"
                                                        class="rounded-circle"
                                                        style="
                                                            width: 50px;
                                                            height: 50px;
                                                            object-fit: cover;
                                                            border: 2px solid #DBDFE9;
                                                        ">

                                                @else

                                                    <img src="{{ asset('assets/media/avatars/blank.png') }}"
                                                        alt="No Foto"
                                                        class="rounded-circle"
                                                        style="
                                                            width: 50px;
                                                            height: 50px;
                                                            object-fit: cover;
                                                            border: 2px solid #DBDFE9;
                                                        ">

                                                @endif

                                            </td>

                                            <!-- Employee Number -->
                                            <td class="text-center">
                                                {{ $item->employee_number }}
                                            </td>

                                            <!-- Nama -->
                                            <td class="text-start ps-4">

                                                <span class="text-gray-900 fw-semibold">
                                                    {{ $item->name }}
                                                </span>

                                            </td>

                                            <!-- Email -->
                                            <td>
                                                {{ $item->email }}
                                            </td>

                                            <!-- Nomor HP -->
                                            <td class="text-center">
                                                {{ $item->phone ?? '-' }}
                                            </td>

                                            <!-- Status -->
                                            <td class="text-center">

                                                @if ($item->is_register == 1)

                                                    <span class="badge badge-light-success">
                                                        Registered
                                                    </span>

                                                @else

                                                    <span class="badge badge-light-warning">
                                                        Not Registered
                                                    </span>

                                                @endif

                                            </td>

                                            <!-- Aksi -->
                                            <td class="text-center">

                                                <a href="#"
                                                    class="btn btn-icon btn-sm"
                                                    title="Detail Employee">

                                                    <i class="ki-outline ki-eye text-primary fs-2"></i>

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>
                                <!--end::Table body-->

                            </table>
                            <!--end::Table-->

                        </div>
                        <!--end::Table container-->

                    </div>
                    <!--end::Body-->

                </div>
                <!--end::Card-->

            </div>
            <!--end::Container-->

        </div>
        <!--end::Post-->

    </div>
    <!--end::Content-->

@endsection


@section('script')

    <script>

        $(document).ready(function() {

            var table = $('#employeeTable').DataTable({

                "searching": true,
                "ordering": true,
                "paging": true,
                "info": true,

                "search": {
                    "smart": false,
                    "regex": false,
                    "caseInsensitive": true
                },

                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": [0, 1, 7]
                    }
                ]

            });

            $('[data-kt-docs-table-filter="search"]').on('keyup', function() {

                table.search(this.value).draw();

            });

        });

    </script>

@endsection