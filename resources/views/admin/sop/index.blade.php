@extends('layouts.app')
@section('title', 'SOP')
@section('style')
<style>
    /* Styling dropdown */
.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

.dropdown-item:hover {
    background: #f8f9fa;
}

.bg-success.text-white .dropdown-item:hover {
    background: #28a745 !important;
}

/* Hover effect */
.hover-effect:hover {
    transform: translateX(5px);
    transition: all 0.2s;
}

/* Sticky header */
.sticky-top {
    position: sticky;
    top: 0;
    z-index: 10;
}

/* Scrollbar */
.dropdown-menu::-webkit-scrollbar {
    width: 4px;
}

.dropdown-menu::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.dropdown-menu::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}
</style>

@endsection

@section('pageTitle', 'SOP')
@section('mainSection', 'Menu Utama')
@section('currentSection', 'SOP')

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
                                List SOP
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
    id="sopTable"
>
    <thead>
        <tr class="p-0 fw-bold text-muted">
            <th class="text-center bg-light">No</th>
            <th class="text-center bg-light">Nama</th>
            <th class="text-center bg-light">Kode</th>
            <th class="text-center bg-light">Tanggal Kadaluarsa</th>
            <th class="text-center bg-light">Vendor</th>
            <th class="text-center bg-light">PDF</th>
            <th class="text-center bg-light">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td class="text-center">
                    {{ $index + 1 }}
                </td>

                <td class="text-center">
                    {{ $item->nama }}
                </td>

                <td class="text-center">
                    {{ $item->kode }}
                </td>

                <td class="text-center">
                    {{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->translatedFormat('d M Y') }}
                </td>

                <td class="text-center">
                    {{ $item->vendor }}
                </td>

                <td class="text-center align-middle">
                    @if ($item->file_pdf)
                        @php
                            $histories = $allData->where('nama', $item->nama)->sortByDesc('rev');
                        @endphp
                        
                        @if($histories->count() > 0)
                            <button type="button" 
                                    class="btn btn-outline-secondary" 
                                    style="padding: 8px 18px; border-radius: 8px;"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#historyModal{{ $item->id }}">
                                <i class="fas fa-history me-1"></i> 
                                <strong>Rev {{ $item->rev }}</strong>
                                <span class="badge bg-primary text-white ms-2" style="font-size: 12px; padding: 3px 8px;">
                                    {{ $histories->count() }}
                                </span>
                            </button>

                            <div class="modal fade" id="historyModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-file-pdf text-danger"></i> 
                                                History Revisi - {{ $item->nama }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                                            @foreach($histories as $history)
                                                <div class="d-flex justify-content-between align-items-center p-3 border-bottom 
                                                            {{ $history->rev == $item->rev ? 'bg-success text-white rounded' : '' }}">
                                                    <div>
                                                        <div style="font-size: 15px;">
                                                            <i class="fas fa-file-pdf {{ $history->rev == $item->rev ? 'text-white' : 'text-danger' }}"></i>
                                                            <strong>Rev {{ $history->rev }}</strong>
                                                            @if($history->rev == $item->rev)
                                                                <span class="badge bg-light text-dark ms-2">Aktif</span>
                                                            @endif
                                                        </div>
                                                        <small class="{{ $history->rev == $item->rev ? 'text-white-50' : 'text-muted' }}">
                                                            <i class="far fa-calendar-alt"></i> 
                                                            {{ $history->created_at->format('d/m/Y H:i') }}
                                                        </small>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('alat-kesehatan.pdf', $history->id) }}" 
                                                           target="_blank" 
                                                           class="btn btn-sm {{ $history->rev == $item->rev ? 'btn-light' : 'btn-outline-danger' }}">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </a>
                                                        <a href="{{ route('alat-kesehatan.pdf', $history->id) }}" 
                                                           download 
                                                           class="btn btn-sm {{ $history->rev == $item->rev ? 'btn-light' : 'btn-outline-secondary' }}">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    @else
                        <span class="text-muted">-</span>
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
                        action="{{ route('sop.destroy', $item->id) }}"
                        method="POST"
                        style="display:none;"
                    >
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>

            @include('admin.sop.modal-edit')
        @endforeach
    </tbody>
</table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
     @foreach ($data as $index => $item)
    @can('read-dashboard')
        @if($item->file_pdf)
            <div class="menu-item">
                <div class="menu-link">
                    <span class="menu-icon">
                        <i class="fa fa-file-pdf text-danger fs-2"></i>
                    </span>
                    <span class="menu-title">
                        {{ $item->nama_alat ?? $item->name ?? 'PDF ' . ($index + 1) }}
                    </span>
                </div>
                <div class="px-3 pb-3">
                    <embed 
                        src="{{ route('alat-kesehatan.pdf', $item->id) }}" 
                        type="application/pdf"
                        width="100%" 
                        height="1000px"
                        style="border-radius: 4px;"
                    >
                </div>
            </div>
        @endif
    @endcan
@endforeach

    @include('admin.sop.modal-add')
@endsection

@section('script')
    <script>
   function previewPDF(url, title) {
    Swal.fire({
        title: title,
        html: `<embed src="${url}" type="application/pdf" width="100%" height="500px">`,
        width: '80%',
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: 'Download',
        cancelButtonColor: '#dc3545',
        preConfirm: () => {
            window.open(url, '_blank');
        }
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
            window.open(url, '_blank');
        }
    });
}
        $(document).ready(function() {
            var table = $('#sopTable').DataTable({
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
