
@extends('layouts.app')

@section('title', 'Contract')

@section('style')

@endsection

@section('pageTitle', 'Contract')
@section('mainSection', 'Contract Management')
@section('currentSection', 'Contract')

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
                                List Contract
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
                                    placeholder="Cari Contract..."
                                    style="height: calc(1.5em + 0.75rem + 2px);" />

                            </div>
                            <!--end::Search-->

                            <!--begin::Add-->
                            @can('create-contracts')
                                <div class="dropdown">
    <button
        class="btn btn-sm btn-primary btn-active-light-primary me-6 dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >
        <i class="ki-duotone ki-plus fs-3"></i>
        Tambah
    </button>

    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="{{ route('contracts.create', ['type' => 'phm']) }}">
                <i class="ki-duotone ki-document fs-3 me-2"></i>
                Contract PHM
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('contracts.create', ['type' => 'phss']) }}">
                <i class="ki-duotone ki-document fs-3 me-2"></i>
                Contract PHSS
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('contracts.create', ['type' => 'phkt']) }}">
                <i class="ki-duotone ki-document fs-3 me-2"></i>
                Contract PHKT
            </a>
        </li>
    </ul>
</div>
                            @endcan
                            <!--end::Add-->

                        </div>

                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="p-0 card-body">

                        <!--begin::Table container-->
                        <div class="table-responsive table-bordered">

                            <!--begin::Table-->
                            <table class="table text-center align-middle gs-0 gy-4" id="contractTable">

                                <!--begin::Table head-->
                                <thead>
                                    <tr class="p-0 fw-bold text-muted">

                                        <th class="text-center bg-light">
                                            No
                                        </th>

                                        <th class="text-center bg-light">
                                            Contract Number
                                        </th>

                                        <th class="text-center bg-light">
                                            Employee
                                        </th>

                                        <th class="text-center bg-light">
                                            Project
                                        </th>

                                        <th class="text-center bg-light">
                                            Title
                                        </th>

                                        <th class="text-center bg-light">
                                            Start Date
                                        </th>

                                        <th class="text-center bg-light">
                                            End Date
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

                                            <!-- Contract Number -->
                                            <td class="text-center">
                                                {{ $item->contract_number }}
                                            </td>

                                            <!-- Employee -->
                                            <td class="text-start ps-4">

                                                <span class="text-gray-900 fw-semibold">
                                                    {{ $item->user->name ?? '-' }}
                                                </span>

                                                <br>

                                                <small class="text-muted">
                                                    {{ $item->user->employee_number ?? '-' }}
                                                </small>

                                            </td>

                                            <!-- Project -->
                                            <td class="text-center">
                                                {{ $item->project->name ?? '-' }}
                                            </td>

                                            <!-- Title -->
                                            <td class="text-start">
                                                {{ $item->title }}
                                            </td>

                                            <!-- Start Date -->
                                            <td class="text-center">
                                                {{ $item->start_date?->format('d M Y') ?? '-' }}
                                            </td>

                                            <!-- End Date -->
                                            <td class="text-center">
                                                {{ $item->end_date?->format('d M Y') ?? '-' }}
                                            </td>

                                            <!-- Status -->
                                            <td class="text-center">

                                                @if ($item->status === 'draft')

                                                    <span class="badge badge-light-secondary">
                                                        Draft
                                                    </span>

                                                @elseif ($item->status === 'sent')

                                                    <span class="badge badge-light-warning">
                                                        Sent
                                                    </span>

                                                @elseif ($item->status === 'viewed')

                                                    <span class="badge badge-light-info">
                                                        Viewed
                                                    </span>

                                                @elseif ($item->status === 'signed')

                                                    <span class="badge badge-light-info">
                                                        Need Head HRD Approval
                                                    </span>
                                                @elseif ($item->status === 'signed-hrd')

                                                    <span class="badge badge-light-info">
                                                        Need Head Approval
                                                    </span>
                                                @elseif ($item->status === 'signed-head')

                                                    <span class="badge badge-light-success">
                                                        Complete
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

                                            <!-- Aksi -->
                                            <td class="text-center">

                                                @can('read-contracts')
                                                    <a href="{{ route('contracts.show', $item->id) }}"
                                                        class="btn btn-icon btn-sm"
                                                        title="Detail Contract">

                                                        <i class="ki-outline ki-eye text-primary fs-2"></i>

                                                    </a>
                                                @endcan

                                                
@can('edit-contracts')

    {{-- EDIT CONTRACT --}}
    <a href="{{ route('contracts.edit', $item->id) }}"
       class="btn btn-icon btn-sm"
       title="Edit Contract">

        <i class="ki-outline ki-pencil text-warning fs-2"></i>

    </a>


    {{-- SEND CONTRACT --}}
    @if ($item->status === 'draft')

    {{-- Send Contract --}}
    <button type="button"
            class="btn btn-icon btn-sm"
            onclick="confirmSend({{ $item->id }})"
            title="Send Contract">

        <i class="ki-outline ki-send text-primary fs-2"></i>

    </button>

    <form
        id="send-form-{{ $item->id }}"
        action="{{ route('contracts.send', $item->id) }}"
        method="POST"
        style="display:none;">

        @csrf

    </form>


@elseif ($item->status === 'signed')

    {{-- HRD Approval --}}
    <button type="button"
            class="btn btn-icon btn-sm"
            onclick="confirmApproveHRD({{ $item->id }})"
            title="Approve HRD">

        <i class="ki-outline ki-check-circle text-primary fs-2"></i>

    </button>

    <form
        id="approve-hrd-form-{{ $item->id }}"
        action="{{ route('contracts.approve.hrd', $item->id) }}"
        method="POST"
        style="display:none;">

        @csrf

    </form>


@elseif ($item->status === 'signed-hrd')

    {{-- Head Approval --}}
    <button type="button"
            class="btn btn-icon btn-sm"
            onclick="confirmApproveHead({{ $item->id }})"
            title="Approve Head">

        <i class="ki-outline ki-check-circle text-primary fs-2"></i>

    </button>

    <form
        id="approve-head-form-{{ $item->id }}"
        action="{{ route('contracts.approve.head', $item->id) }}"
        method="POST"
        style="display:none;">

        @csrf

    </form>


@elseif ($item->status === 'signed-head')

    {{-- Complete --}}
    <span class="badge badge-light-success">
        Complete
    </span>

@endif

@endcan


                                                @can('delete-contracts')
                                                    <button type="button"
                                                        class="btn btn-icon btn-sm btn-delete"
                                                        onclick="confirmDelete({{ $item->id }})"
                                                        title="Delete Contract">

                                                        <i class="ki-outline ki-trash text-danger fs-2"></i>

                                                    </button>

                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('contracts.destroy', $item->id) }}"
                                                        method="POST"
                                                        style="display:none;">

                                                        @csrf
                                                        @method('DELETE')

                                                    </form>
                                                @endcan

                                            </td>

                                        </tr>
                                            {{-- @include('admin.hrd.contracts.modal-edit', [
        'item' => $item
    ]) --}}

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

            var table = $('#contractTable').DataTable({

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
                        "targets": [0, 8]
                    }
                ]

            });

            $('[data-kt-docs-table-filter="search"]').on('keyup', function() {

                table.search(this.value).draw();

            });

        });


        function confirmDelete(contractId) {

            Swal.fire({

                title: 'Apakah Anda yakin?',

                text: "Contract ini akan dihapus secara permanen!",

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: 'var(--bs-primary)',

                cancelButtonColor: 'var(--bs-danger)',

                confirmButtonText: 'Ya, hapus!',

                cancelButtonText: 'Batal',

                reverseButtons: true

            }).then((result) => {

                if (result.isConfirmed) {

                    document
                        .getElementById('delete-form-' + contractId)
                        .submit();

                }

            });

        }
        function confirmSend(contractId) {

    Swal.fire({

        title: 'Kirim Contract?',

        text: 'Contract akan dikirim ke employee yang dipilih.',

        icon: 'question',

        showCancelButton: true,

        confirmButtonColor: 'var(--bs-primary)',

        cancelButtonColor: 'var(--bs-danger)',

        confirmButtonText: 'Ya, kirim!',

        cancelButtonText: 'Batal',

        reverseButtons: true

    }).then((result) => {

        if (result.isConfirmed) {

            document
                .getElementById('send-form-' + contractId)
                .submit();

        }

    });

}
 function confirmApproveHRD(id) {
        Swal.fire({
            title: 'Approve Contract?',
            text: 'Contract akan disetujui oleh Head HRD.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Approve',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light'
            },
            buttonsStyling: false
        }).then((result) => {

            if (result.isConfirmed) {
                document.getElementById('approve-hrd-form-' + id).submit();
            }

        });
    }


    function confirmApproveHead(id) {
        Swal.fire({
            title: 'Approve Contract?',
            text: 'Contract akan diselesaikan setelah approval Head.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Approve',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light'
            },
            buttonsStyling: false
        }).then((result) => {

            if (result.isConfirmed) {
                document.getElementById('approve-head-form-' + id).submit();
            }

        });
    }

    </script>

@endsection
