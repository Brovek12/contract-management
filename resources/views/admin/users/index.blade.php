@extends('layouts.app')
@section('title', 'Pengguna Aplikasi')
@section('style')

@endsection

@section('pageTitle', 'Pengguna')
@section('mainSection', 'Konfigurasi')
@section('currentSection', 'Pengguna')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="mb-5 card mb-xl-8">
                    <!--begin::Header-->
                    <div class="p-0 pt-5 border-0 card-header">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="mb-1 card-label fw-bold fs-3 ps-6">List Pengguna</span>
                        </h3>
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <div class="my-1 d-flex align-items-center position-relative me-5 rounded-3">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-6"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" data-kt-docs-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-15"
                                    placeholder="Cari Nama, Email, No HP, Hak Akses"
                                    style="height: calc(1.5em + 0.75rem + 2px);" />
                            </div>

                            <div class="col">
                                <a href="#" class="py-1 btn btn-light rounded-3 btn-sm me-6" style="height: 60%;"
                                    data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-start">
                                    <i class="mb-1 ki-outline ki-filter me-1" style="color: #333333"></i>
                                    <span class="text-dark-600 fw-semibold">Filter</span>
                                </a>

                                <!--begin::Menu-->
                                <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-active-bg menu-state-color fw-semibold fs-base w-175px"
                                    data-kt-menu="true" style="position: absolute; z-index: 1000;">
                                    <!--begin::Menu item-->
                                    <div class="px-3 my-0 menu-item menu-status">
                                        <a href="#" class="px-3 py-2 menu-link status-item" data-status="">
                                            <span class="menu-title">Semua Jabatan</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    @foreach ($role as $item)
                                        <!--begin::Menu item-->
                                        <div class="px-3 my-0 menu-item menu-status">
                                            <a href="#" class="px-3 py-2 menu-link status-item"
                                                data-status="{{ $item->id }}">
                                                <span class="menu-title">{{ $item->name }}</span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    @endforeach
                                </div>
                                <!--end::Menu-->
                            </div>

                            @can('create-users')
                                <button type="button" class="btn btn-sm btn-primary btn-active-light-primary me-6"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_add">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    Tambah
                                </button>
                            @endcan

                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="p-0 card-body">
                        <!--begin::Table container-->
                        <div class="table-responsive table-bordered">
                            <!--begin::Wrapper-->


                            <!--end::Wrapper-->
                            <!--begin::Table-->
                            <table class="table text-center align-middle gs-0 gy-4" id="userTable">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="p-0 fw-bold text-muted">
                                        <th class="text-center bg-light">No</th>
                                        <th class="text-center bg-light">Foto</th>
                                        <th class="text-center bg-light">Nama</th>
                                        <th class="text-center bg-light">Email</th>
                                        <th class="text-center bg-light">Username</th>
                                        <th class="text-center bg-light">Nomor HP</th>
                                        <th class="text-center bg-light">Hak Akses</th>
                                        {{-- <th class="text-center bg-light">Gudang</th> --}}
                                        {{-- <th class="text-center bg-light">Status</th> --}}
                                        <th class="text-center bg-light">Aksi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($data as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                @if ($item->foto)
                                                    <img src="{{ asset($item->foto) }}" alt="User Foto"
                                                        class="rounded-circle"
                                                        style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #DBDFE9">
                                                @else
                                                    <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="No Foto"
                                                        class="rounded-circle"
                                                        style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #DBDFE9">
                                                @endif
                                            </td>
                                            <td class="ps-4">
                                                <a href="{{ route('user.show', $item->id) }}"
                                                    class="mb-1 text-gray-900 text-hover-primary">
                                                    {{ $item->name }}
                                                </a>
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td class="text-center">{{ $item->phone ?? '-' }}</td>
                                            <td>{{ $item->getRoleNames()->first() ?? 'N/A' }}</td>
                                          
                                          <td class="text-center">
    {{-- TOMBOL BARU: Riwayat Kontrak --}}
    @can('read-contracts')
        <button type="button" class="btn btn-icon btn-sm btn-view-contracts" 
                data-id="{{ $item->id }}" 
                data-name="{{ $item->name }}" 
                data-bs-toggle="modal" 
                data-bs-target="#modalTrackRecord"
                title="Riwayat Kontrak">
            <i class="ki-outline ki-document text-primary text-hover-info fs-2"></i>
        </button>
    @endcan

    @can('edit-users')
        <button type="button" class="btn btn-icon btn-sm" data-bs-toggle="modal"
            data-bs-target="#kt_modal_edit{{ $item->id }}">
            <i class="ki-outline ki-pencil text-warning text-hover-info fs-2"></i>
        </button>
    @endcan

    @can('delete-users')
        <button type="button" class="btn btn-icon btn-sm btn-delete"
            onclick="confirmDelete({{ $item->id }})">
            <i class="ki-outline ki-trash text-danger text-hover-info fs-2"></i>
        </button>
    @endcan

    <form id="delete-form-{{ $item->id }}"
        action="{{ route('user.destroy', $item->id) }}" method="POST"
        style="display:none;">
        @csrf
        @method('DELETE')
    </form>
</td>
                                        </tr>
                                        @include('admin.users.modal-edit')
                                    @endforeach
                                </tbody>

                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
                <!--end::Tables Widget 12-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @include('admin.users.modal-add')
    <!--begin::Modal Track Record-->
<div class="modal fade" id="modalTrackRecord" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Riwayat Kontrak: <span id="trackUserName"></span></h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <div class="modal-body">
                <!-- Loader -->
                <div id="trackLoader" class="text-center py-10 d-none">
                    <span class="spinner-border text-primary" role="status"></span>
                    <div class="text-muted mt-2">Memuat data kontrak...</div>
                </div>
                
                <!-- Tabel Kontrak -->
                <div class="table-responsive" id="trackTableWrapper">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>No</th>
                                <th>No. Kontrak</th>
                                <th>Posisi / Judul</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="trackTableBody">
                            <!-- Data diisi via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
   

@endsection

@section('script')
    <script>
        // ============================================
// TRACK RECORD KONTRAK USER
// ============================================
$(document).on('click', '.btn-view-contracts', function () {
    let userId = $(this).data('id');
    let userName = $(this).data('name');

    // Set nama user di judul modal
    $('#trackUserName').text(userName);

    // Tampilkan loader, sembunyikan tabel
    $('#trackLoader').removeClass('d-none');
    $('#trackTableWrapper').addClass('d-none');
    $('#trackTableBody').html('');

    // AJAX Request
    $.ajax({
        url: '/users/' + userId + '/contracts',
        type: 'GET',
        success: function (data) {
            $('#trackLoader').addClass('d-none');
            $('#trackTableWrapper').removeClass('d-none');

            if (data.length === 0) {
                $('#trackTableBody').html('<tr><td colspan="6" class="text-center text-muted">Belum ada riwayat kontrak.</td></tr>');
                return;
            }

            let html = '';
            $.each(data, function (index, contract) {
                // Format tanggal (Jika null, tampilkan '-')
                let startDate = contract.start_date ? new Date(contract.start_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) : '-';
                let endDate = contract.end_date ? new Date(contract.end_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) : '-';
                
                // Badge Status
                let statusBadge = contract.status === 'signed-head' ? 'badge-light-success' : (contract.status === 'draft' ? 'badge-light-secondary' : 'badge-light-warning');
                
                html += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td><strong>${contract.contract_number || '-'}</strong></td>
                        <td>${contract.title || '-'} <br> <small class="text-muted">${contract.position || '-'}</small></td>
                        <td class="text-center">${startDate}</td>
                        <td class="text-center">${endDate}</td>
                        <td class="text-center"><span class="badge ${statusBadge}">${contract.status}</span></td>
                    </tr>
                `;
            });

            $('#trackTableBody').html(html);
        },
        error: function () {
            $('#trackLoader').addClass('d-none');
            $('#trackTableWrapper').removeClass('d-none');
            $('#trackTableBody').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat data kontrak.</td></tr>');
        }
    });
});
        $(document).ready(function() {
            var table = $('#userTable').DataTable({
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

        function confirmDelete(userId) {
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
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }

        document.querySelectorAll('.menu-status .status-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                const selectedRole = this.getAttribute('data-status');
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                if (selectedRole) {
                    params.set('role', selectedRole);
                } else {
                    params.delete('role');
                }

                window.location.search = params.toString();
            });
        });
    </script>
@endsection
