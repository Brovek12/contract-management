@extends('layouts.app')
@section('title', 'Project')
@section('style')
@endsection

@section('pageTitle', 'Project')
@section('mainSection', 'Menu Utama')
@section('currentSection', 'Project')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="mb-5 card mb-xl-8">

                    <div class="p-0 pt-5 border-0 card-header">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="mb-1 card-label fw-bold fs-3 ps-6">
                                List Project
                            </span>
                        </h3>

                        <div class="card-toolbar">
                            <div class="my-1 d-flex align-items-center position-relative me-5 rounded-3">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>

                                <input
                                    type="text"
                                    data-kt-docs-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-15"
                                    placeholder="Cari..."
                                    style="height: calc(1.5em + 0.75rem + 2px);"
                                />
                            </div>

                            <button
                                type="button"
                                class="btn btn-sm btn-primary btn-active-light-primary me-6"
                                data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add"
                            >
                                <i class="ki-duotone ki-plus fs-3"></i>
                                Tambah
                            </button>
                        </div>
                    </div>

                    <div class="p-0 card-body">
                        <div class="table-responsive table-bordered">
                          <table
    class="table text-center align-middle gs-0 gy-4"
    id="projectsTable"
>
    <thead>
        <tr class="p-0 fw-bold text-muted">

                                    <th class="text-center bg-light">
                                        No
                                    </th>

                                    <th class="text-center bg-light">
                                        Kode
                                    </th>

                                    <th class="text-center bg-light">
                                        Nama Project
                                    </th>

                                    <th class="text-center bg-light">
                                        Lokasi
                                    </th>

                                    <th class="text-center bg-light">
                                        Status
                                    </th>

                                    <th class="text-center bg-light">
                                        Aksi
                                    </th>

                                </tr>
    </thead>

    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td class="text-center">
                    {{ $index + 1 }}
                </td>

                <td class="text-center">
                    {{ $item->code }}
                </td>

                <td class="text-center">
                    {{ $item->name }}
                </td>


                <td class="text-center">
                    {{ $item->location }}
                </td>

                <td class="text-center">

                                            @if ($item->is_active)

                                                <span class="badge badge-light-success">
                                                    Aktif
                                                </span>

                                            @else

                                                <span class="badge badge-light-danger">
                                                    Tidak Aktif
                                                </span>

                                            @endif

                                        </td>

                <td class="text-center">
                    <button
                        type="button"
                        class="btn btn-icon btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#kt_modal_edit{{ $item->id }}"
                        title="Edit"
                    >
                        <i class="ki-outline ki-pencil text-warning text-hover-info fs-2"></i>
                    </button>

                    <button
                        type="button"
                        class="btn btn-icon btn-sm btn-delete"
                        onclick="confirmDelete({{ $item->id }})"
                        title="Hapus"
                    >
                        <i class="ki-outline ki-trash text-danger text-hover-info fs-2"></i>
                    </button>

                    <form
                        id="delete-form-{{ $item->id }}"
                        action="{{ route('projects.destroy', $item->id) }}"
                        method="POST"
                        style="display:none;"
                    >
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>

            @include('admin.hrd.project.modal-edit')
        @endforeach
    </tbody>
</table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    

    @include('admin.hrd.project.modal-add')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#projectsTable').DataTable({
                "searching": true,
                "ordering": true,
                "paging": true,
                "info": true,
                "search": {
                    "smart": false,
                    "regex": false,
                    "caseInsensitive": true
                }
            });

            $('[data-kt-docs-table-filter="search"]').on('keyup', function() {
                table.search(this.value).draw();
            });
        });

        function confirmDelete(pelangganId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--bs-primary)',
                cancelButtonColor: 'var(--bs-danger)',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + pelangganId).submit();
                }
            });
        }

    </script>
@endsection
