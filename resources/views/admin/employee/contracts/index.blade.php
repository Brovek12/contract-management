@extends('layouts.app')

@section('title', 'Kontrak Saya')

@section('content')

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="py-3 app-toolbar py-lg-6">

    <div id="kt_app_toolbar_container"
         class="container-xxl d-flex flex-stack">

        <!--begin::Page title-->
        <div class="gap-2 d-flex flex-column justify-content-center">

            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                Kontrak Saya
            </h1>

            <span class="text-gray-500 fs-7">
                Daftar kontrak kerja yang diberikan kepada Anda
            </span>

        </div>
        <!--end::Page title-->

    </div>

</div>
<!--end::Toolbar-->


<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">

    <div id="kt_app_content_container"
         class="app-container container-xxl">

        <!--begin::Card-->
        <div class="card">

            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">

                <!--begin::Card title-->
                <div class="card-title">

                    <div class="d-flex align-items-center position-relative my-1">

                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>

                        <input type="text"
                               id="contractSearch"
                               class="form-control form-control-solid w-250px ps-13"
                               placeholder="Cari Contract..." />

                    </div>

                </div>
                <!--end::Card title-->

            </div>
            <!--end::Card header-->


            <!--begin::Card body-->
            <div class="card-body py-4">

                <!--begin::Table-->
                <div class="table-responsive">

                    <table class="table align-middle table-row-dashed fs-6 gy-5"
                           id="contractTable">

                        <thead>

                            <tr class="text-gray-500 fw-bold fs-7 text-uppercase gs-0">

                                <th class="text-center min-w-50px">
                                    No
                                </th>

                                <th class="min-w-180px">
                                    Contract Number
                                </th>

                                <th class="min-w-150px">
                                    Project
                                </th>

                                <th class="min-w-200px">
                                    Judul Contract
                                </th>

                                <th class="min-w-150px">
                                    Periode
                                </th>

                                <th class="text-center min-w-120px">
                                    Status
                                </th>

                                <th class="text-center min-w-100px">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="text-gray-600 fw-semibold">

                            @forelse ($contracts as $item)

                                <tr>

                                    <!--begin::No-->
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <!--end::No-->


                                    <!--begin::Contract Number-->
                                    <td>

                                        <span class="text-gray-800 fw-bold">
                                            {{ $item->contract_number }}
                                        </span>

                                    </td>
                                    <!--end::Contract Number-->


                                    <!--begin::Project-->
                                    <td>

                                        @if ($item->project)

                                            <span class="text-gray-700 fw-semibold">
                                                {{ $item->project->name }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>
                                    <!--end::Project-->


                                    <!--begin::Title-->
                                    <td>

                                        <span class="text-gray-800">
                                            {{ $item->title }}
                                        </span>

                                    </td>
                                    <!--end::Title-->


                                    <!--begin::Periode-->
                                    <td>

                                        <div class="d-flex flex-column">

                                            <span class="text-gray-800 fw-semibold">
                                                {{ $item->start_date->format('d M Y') }}
                                            </span>

                                            <span class="text-muted fs-7">
                                                s/d {{ $item->end_date->format('d M Y') }}
                                            </span>

                                        </div>

                                    </td>
                                    <!--end::Periode-->


                                    <!--begin::Status-->
                                    <td class="text-center">

                                        @if ($item->status === 'sent')

                                            <span class="badge badge-light-primary">
                                                Menunggu Review
                                            </span>

                                        @elseif ($item->status === 'viewed')

                                            <span class="badge badge-light-warning">
                                                Sudah Dilihat
                                            </span>

                                        @elseif ($item->status === 'signed')

                                            <span class="badge badge-light-success">
                                                Sudah Ditandatangani
                                            </span>

                                        @elseif ($item->status === 'expired')

                                            <span class="badge badge-light-danger">
                                                Expired
                                            </span>

                                        @else

                                            <span class="badge badge-light-secondary">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>
                                    <!--end::Status-->


                                    <!--begin::Action-->
                                    <td class="text-center">
                                        @can('read-my-contracts')

                                        <a href="{{ route('contracts.show', $item->id) }}"
                                           class="btn btn-icon btn-sm btn-light-primary"
                                           title="Lihat Contract">

                                            <i class="ki-outline ki-eye fs-2"></i>

                                        </a>
                                        @endcan

                                    </td>
                                    <!--end::Action-->

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7"
                                        class="text-center py-10">

                                        <div class="d-flex flex-column align-items-center">

                                            <i class="ki-duotone ki-document fs-5x text-gray-300 mb-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>

                                            <span class="text-gray-500 fw-semibold fs-6">
                                                Belum ada contract yang diberikan kepada Anda.
                                            </span>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>
                <!--end::Table-->

            </div>
            <!--end::Card body-->

        </div>
        <!--end::Card-->

    </div>

</div>
<!--end::Content-->


@endsection


@push('scripts')

<script>

    $(document).ready(function () {

        let table = $('#contractTable').DataTable({

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],

            ordering: true,

            searching: true,

            columnDefs: [
                {
                    orderable: false,
                    targets: [0, 6]
                }
            ],

            language: {
                search: "",
                searchPlaceholder: "Cari Contract...",
                lengthMenu: "_MENU_",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ contract",
                infoEmpty: "Tidak ada contract",
                zeroRecords: "Contract tidak ditemukan",
                emptyTable: "Belum ada contract"
            }

        });


        /*
        |--------------------------------------------------------------------------
        | Custom Search
        |--------------------------------------------------------------------------
        */

        $('#contractSearch').on('keyup', function () {

            table.search(this.value).draw();

        });

    });

</script>

@endpush