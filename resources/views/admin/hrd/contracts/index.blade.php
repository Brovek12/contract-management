@extends('layouts.app')

@section('title', 'Contract')

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
                <div class="card mb-5 mb-xl-8">

                    <!--begin::Header-->
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">List Contract</span>
                            <span class="text-muted fw-semibold fs-7">Manage all contract data</span>
                        </h3>

                        <div class="card-toolbar">
                            <button type="button" id="btnExportExcel" class="btn btn-sm btn-light-success me-2">
                                <i class="ki-duotone ki-file-down fs-3"></i>
                                Export Excel
                            </button>
                            @can('create-contracts')
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ki-duotone ki-plus fs-3"></i>
                                        Add
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalManajerial">
                                                <i class="ki-duotone ki-briefcase fs-3 me-2"></i>
                                                Manajerial
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalNonManajerial">
                                                <i class="ki-duotone ki-people fs-3 me-2"></i>
                                                Non-Manajerial
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalProject">
                                                <i class="ki-duotone ki-project fs-3 me-2"></i>
                                                Project
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalHarian">
                                                <i class="ki-duotone ki-calendar fs-3 me-2"></i> Harian
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                {{-- Modals --}}
                                @include('admin.hrd.contracts.modal.modal_manajerial')
                                @include('admin.hrd.contracts.modal.modal_non_manajerial')
                                @include('admin.hrd.contracts.modal.modal_project')
                                @include('admin.hrd.contracts.modal.modal_harian')
                            @endcan
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Filter-->
                    <div class="card-body border-top pt-5 pb-4">
                        <div class="row g-3 align-items-end">

                            {{-- Search --}}
                            <div class="col-md-3">
                                <label class="form-label fw-semibold fs-7 mb-2">Search</label>
                                <div class="position-relative">
                                    <i
                                        class="ki-outline ki-magnifier fs-3 position-absolute ms-4 top-50 translate-middle-y"></i>
                                    <input type="text" id="filterSearch" data-kt-docs-table-filter="search"
                                        class="form-control form-control-solid ps-12" placeholder="Cari Contract...">
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-7 mb-2">Category</label>
                                <select id="filterCategory" data-control="select2" data-placeholder="All Category"
                                    data-allow-clear="true" class="form-select form-select-solid">
                                    <option value=""></option>
                                    <option value="managerial">Managerial</option>
                                    <option value="non-managerial">Non-Managerial</option>
                                    <option value="project">Project</option>
                                    <option value="harian">Harian</option>
                                </select>
                            </div>

                            {{-- Type --}}
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-7 mb-2">Type</label>
                                <select id="filterType" data-control="select2" data-placeholder="All Type"
                                    data-allow-clear="true" class="form-select form-select-solid">
                                    <option value=""></option>

                                    {{-- MANAGERIAL --}}
                                    <optgroup label="Managerial">
                                        <option value="gp-um-ut-fungsi">gp-um-ut-fungsi</option>
                                        <option value="gp-mahal-um-ut-fungsi">gp-mahal-um-ut-fungsi</option>
                                        <option value="all-in">all-in</option>
                                    </optgroup>

                                    {{-- NON-MANAGERIAL --}}
                                    <optgroup label="Non-Managerial">
                                        <option value="security">security</option>
                                        <option value="ob">ob</option>
                                        <option value="gp-um-ut-laut">gp-um-ut-laut</option>
                                        <option value="gp-um-ut">gp-um-ut</option>
                                        <option value="gp-mahal-um-ut-fungsi-pls">gp-mahal-um-ut-fungsi-pls</option>
                                        <option value="gp-mahal-um-ut">gp-mahal-um-ut</option>
                                    </optgroup>

                                    {{-- PROJECT --}}
                                    <optgroup label="Project">
                                        <option value="pep-lokal-buny">pep-lokal-buny</option>
                                        <option value="elis-phkt-5-2">elis-phkt-5-2</option>
                                        <option value="elis-phkt-6-1">elis-phkt-6-1</option>
                                        <option value="eni-muara-bakau-lembur">eni-muara-bakau-lembur</option>
                                        <option value="eni-muara-bakau-all-in">eni-muara-bakau-all-in</option>
                                        <option value="ipfms-dobu">ipfms-dobu Tidak Tetap</option>
                                        <option value="ipfms-dobu-2">ipfms-dobu Tetap</option>
                                    </optgroup>
                                    <optgroup label="Harian">
                                        <option value="harian-biasa">harian-biasa</option>
                                    </optgroup>
                                </select>
                            </div>

                            {{-- Project --}}
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-7 mb-2">Project</label>
                                <select id="filterProject" data-control="select2" data-placeholder="Semua Project"
                                    data-allow-clear="true" class="form-select form-select-solid">
                                    <option value=""></option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->name }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-7 mb-2">Status</label>
                                <select id="filterStatus" data-control="select2" data-placeholder="Semua Status"
                                    data-allow-clear="true" class="form-select form-select-solid">
                                    <option value=""></option>
                                    <option value="draft">Draft</option>
                                    <option value="signed-hrd">Ready to Send</option>
                                    <option value="signed">Need GM Approval</option>
                                    <option value="signed-head">Complete</option>
                                    <option value="stop">Stop</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>

                            {{-- Start Date From --}}
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-7 mb-2">Start Date From</label>
                                <input type="date" id="filterStartDate" class="form-control form-control-solid">
                            </div>

                            {{-- Start Date To --}}
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-7 mb-2">Start Date To</label>
                                <input type="date" id="filterEndDate" class="form-control form-control-solid">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-7 mb-2">End Date</label>
                                <input type="date" id="filterEndDateOnly" class="form-control form-control-solid">
                            </div>

                            {{-- Reset --}}
                            <div class="col-md-1">
                                <button type="button" id="resetFilter" class="btn btn-light w-100" title="Reset Filter">
                                    <i class="ki-outline ki-arrows-circle fs-2"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    <!--end::Filter-->

                    <!--begin::Body-->
                    <div class="card-body pt-0">

                        <!--begin::Bulk Action Bar-->
                        <div id="bulkActionBar"
                            class="d-none alert bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-5">
                            <i class="ki-outline ki-information-5 fs-2hx text-primary me-4 mb-5 mb-sm-0"></i>

                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h4 class="fw-semibold mb-1">
                                    <span id="selectedCount">0</span> contract dipilih
                                </h4>
                                <span class="text-muted fs-7" id="bulkActionInfo">
                                    Pilih aksi yang ingin dijalankan untuk contract yang dipilih.
                                </span>
                            </div>

                            <div class="d-flex flex-row-fluid justify-content-end gap-2 ms-sm-5 mt-3 mt-sm-0"
                                id="bulkActionButtons">
                                {{-- Tombol bulk akan dirender oleh JavaScript --}}
                            </div>
                        </div>
                        <!--end::Bulk Action Bar-->

                        <div class="table-responsive">
                            <table
                                class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4 datatable-custom"
                                style="font-size: 10px;" id="contractTable">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        {{-- CHECK ALL --}}
                                        <th class="text-center min-w-30px">
                                            <div
                                                class="form-check form-check-sm form-check-custom form-check-solid d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" id="checkAll" />
                                            </div>
                                        </th>

                                        <th class="text-center min-w-50px">No</th>
                                        <th class="text-center min-w-125px">Contract Number</th>
                                        <th class="text-center min-w-125px">Category</th>
                                        <th class="text-center min-w-150px">Type</th>
                                        <th class="text-center min-w-150px">Employee</th>
                                        <th class="text-center min-w-125px">Project</th>
                                        <th class="text-center min-w-125px">Owner</th>
                                        <th class="text-center min-w-150px">Title</th>
                                        <th class="text-center min-w-100px">Start Date</th>
                                        <th class="text-center min-w-100px">End Date</th>
                                        <th class="text-center min-w-150px">Status</th>
                                        <th class="text-center min-w-125px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $typeCategoryMap = [
                                            'gp-um-ut-fungsi' => 'managerial',
                                            'gp-mahal-um-ut-fungsi' => 'managerial',
                                            'all-in' => 'managerial',
                                            'security' => 'non-managerial',
                                            'ob' => 'non-managerial',
                                            'gp-um-ut-laut' => 'non-managerial',
                                            'gp-um-ut' => 'non-managerial',
                                            'gp-mahal-um-ut-fungsi-pls' => 'non-managerial',
                                            'gp-mahal-um-ut' => 'non-managerial',
                                            'pep-lokal-buny' => 'project',
                                            'elis-phkt-5-2' => 'project',
                                            'elis-phkt-6-1' => 'project',
                                            'eni-muara-bakau-lembur' => 'project',
                                            'eni-muara-bakau-all-in' => 'project',
                                            'ipfms-dobu' => 'project',
                                            'harian-biasa' => 'harian',
                                        ];

                                        $categoryBadgeMap = [
                                            'managerial' => ['badge-light-primary', 'Managerial'],
                                            'non-managerial' => ['badge-light-success', 'Non-Managerial'],
                                            'project' => ['badge-light-warning', 'Project'],
                                            'harian' => ['badge-light-warning', 'Harian'],
                                        ];
                                    @endphp

                                    @foreach ($data as $index => $item)
                                        @php
                                            $rowType = $item->type ?? '';
                                            $rowCategory = $item->category ?? ($typeCategoryMap[$rowType] ?? '');
                                            [$catBadgeClass, $catBadgeLabel] = $categoryBadgeMap[$rowCategory] ?? ['badge-light-secondary', $rowCategory ?: '-'];
                                        @endphp
                                        <tr>
                                            {{-- CHECK PER ROW --}}
                                            <td class="text-center">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid d-flex justify-content-center">
                                                    <input class="form-check-input row-checkbox" type="checkbox"
                                                        value="{{ $item->id }}" data-status="{{ $item->status }}" />
                                                </div>
                                            </td>

                                            <td class="text-center">{{ $index + 1 }}</td>

                                            <td class="text-center fw-semibold">
                                                {{ $item->contract_number }}
                                            </td>

                                            {{-- CATEGORY --}}
                                            <td class="text-center" data-category="{{ $rowCategory }}">
                                                <span class="badge {{ $catBadgeClass }}">
                                                    {{ $catBadgeLabel }}
                                                </span>
                                            </td>

                                            {{-- TYPE --}}
                                            <td class="text-center" data-type="{{ $rowType }}">
                                                <span class="badge badge-light-primary">
                                                    {{ $rowType ?: '-' }}
                                                </span>
                                            </td>

                                            <td class="text-start">
                                                <span class="text-gray-900 fw-semibold d-block">
                                                    {{ $item->user->name ?? '-' }}
                                                </span>
                                                <small class="text-muted">
                                                    {{ $item->user->employee_number ?? '-' }}
                                                </small>
                                            </td>

                                            <td class="text-center">
                                                {{ $item->project->name ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->project->owner ?? '-' }}
                                            </td>

                                            <td class="text-start">
                                                {{ $item->title }}
                                            </td>

                                            {{-- Start Date --}}
                                            <td class="text-center" data-order="{{ $item->start_date?->format('Y-m-d') }}">
                                                {{ $item->start_date?->format('d M Y') ?? '-' }}
                                            </td>

                                            {{-- End Date --}}
                                            <td class="text-center" data-order="{{ $item->end_date?->format('Y-m-d') }}">
                                                {{ $item->end_date?->format('d M Y') ?? '-' }}
                                            </td>

                                            {{-- Status --}}
                                            <td class="text-center">
                                                @php
                                                   $statusAction = null;
                                                    $isHarian = ($item->category === 'harian' || $item->type === 'harian-biasa');
                                                    if ($isHarian) {
                                                        $statusMap = [
                                                            'draft' => ['badge-light-secondary', 'Draft and Checking'],
                                                            'sent' => ['badge-light-warning', 'Sent'],
                                                            'signed-hrd' => ['badge-light-success', 'Complete'], // <-- TAMBAHKAN INI
                                                        ];
                                                    }
                                                     else {
                                                        // Mapping Kontrak (yang sudah kamu buat sebelumnya)
                                                        $statusMap = [
                                                            'draft' => ['badge-light-secondary', 'Draft'],
                                                            'signed-hrd' => ['badge-light-info', 'Ready to Send'],
                                                            'sent' => ['badge-light-warning', 'Sent'],
                                                            'viewed' => ['badge-light-info', 'Viewed'],
                                                            'signed' => ['badge-light-primary', 'Need GM Approval'],
                                                            'signed-head' => ['badge-light-success', 'Complete'],
                                                            'stop' => ['badge-light-danger', 'Stop'],
                                                        ];
                                                    }

                                                    // Ambil badge dan label, jika status tidak ditemukan pakai fallback
                                                    [$badgeClass, $badgeLabel] = $statusMap[$item->status] ?? ['badge-light-secondary', ucfirst($item->status)];
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                                            </td>

                                            {{-- AKSI --}}
                                            <td class="text-center">
                                                @php
                                                    $statusAction = null;
                                                    $isHarian = ($item->category === 'harian' || $item->type === 'harian-biasa');

                                                    // ==========================================
                                                    // FLOW KHUSUS HARIAN
                                                    // ==========================================
                                                    if ($isHarian) {
                                                        // 1. DRAFT (Harian) -> Langsung Kirim ke Karyawan
                                                        if ($item->status === 'draft' && auth()->user()->can('edit-contracts')) {
                                                            $statusAction = [
                                                                'route' => route('contracts.send', $item->id),
                                                                'formId' => "send-form-{$item->id}",
                                                                'onclick' => "confirmSend({$item->id})",
                                                                'icon' => 'ki-user-tick',
                                                                'label' => 'Send to Employee',
                                                                'color' => 'text-info',
                                                            ];
                                                        }
                                                        // 2. SIGNED (Karyawan TTD) -> Head HRD TTD (Selesai)
                                                        elseif ($item->status === 'signed' && auth()->user()->can('edit-contracts')) {
                                                            $statusAction = [
                                                                'route' => route('contracts.approve.hrd', $item->id),
                                                                'formId' => "approve-hrd-form-{$item->id}",
                                                                'onclick' => "confirmApproveHRD({$item->id})",
                                                                'icon' => 'ki-send',
                                                                'label' => 'Send to Head HRD',
                                                                'color' => 'text-primary',
                                                            ];
                                                        }
                                                    }
                                                    // ==========================================
                                                    // FLOW BIASA (PROJECT / MANAGERIAL / DLL)
                                                    // ==========================================
                                                    else {
                                                        // 1. DRAFT -> Paraf HRD
                                                        if ($item->status === 'draft' && auth()->user()->can('edit-contracts')) {
                                                            $statusAction = [
                                                                'route' => route('contracts.approve.hrd', $item->id),
                                                                'formId' => "approve-hrd-form-{$item->id}",
                                                                'onclick' => "confirmApproveHRD({$item->id})",
                                                                'icon' => 'ki-send',
                                                                'label' => 'Send to Head HRD',
                                                                'color' => 'text-primary',
                                                            ];
                                                        }
                                                        // 2. SIGNED-HRD -> Kirim ke Karyawan
                                                        elseif ($item->status === 'signed-hrd' && auth()->user()->can('edit-contracts')) {
                                                            $statusAction = [
                                                                'route' => route('contracts.send', $item->id),
                                                                'formId' => "send-form-{$item->id}",
                                                                'onclick' => "confirmSend({$item->id})",
                                                                'icon' => 'ki-user-tick',
                                                                'label' => 'Send to Employee',
                                                                'color' => 'text-info',
                                                            ];
                                                        }
                                                        // 3. SIGNED (Karyawan TTD) -> Approve GM
                                                        elseif ($item->status === 'signed' && auth()->user()->can('approve-contracts-head')) {
                                                            $statusAction = [
                                                                'route' => route('contracts.approve.head', $item->id),
                                                                'formId' => "approve-gm-form-{$item->id}",
                                                                'onclick' => "confirmApproveHead({$item->id})",
                                                                'icon' => 'ki-check-circle',
                                                                'label' => 'Approve General Manager',
                                                                'color' => 'text-success',
                                                            ];
                                                        }
                                                    }
                                                @endphp

                                                @if (
                                                        auth()->user()->can('read-contracts') ||
                                                        auth()->user()->can('edit-contracts') ||
                                                        auth()->user()->can('delete-contracts') ||
                                                        auth()->user()->can('approve-contracts-hrd') ||
                                                        auth()->user()->can('approve-contracts-head')
                                                    )
                                                    <div class="dropdown" data-bs-strategy="fixed">
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                                                            data-bs-toggle="dropdown" data-bs-strategy="fixed" aria-expanded="false"
                                                            title="Aksi">
                                                            <i class="ki-outline ki-dots-vertical fs-4"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-menu-end">

                                                            {{-- View --}}
                                                            @can('read-contracts')
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('contracts.show', $item->id) }}">
                                                                        <i class="ki-outline ki-eye fs-4 me-2 text-primary"></i>
                                                                        Lihat Detail
                                                                    </a>
                                                                </li>
                                                            @endcan

                                                            {{-- Edit --}}
                                                            @can('edit-contracts')
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('contracts.edit', $item->id) }}">
                                                                        <i class="ki-outline ki-pencil fs-4 me-2 text-warning"></i>
                                                                        Edit Contract
                                                                    </a>
                                                                </li>
                                                                @if(!in_array($item->type, ['harian-biasa']))
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('contracts.create-new-from-existing', $item->id) }}">
                                                                            <i class="ki-outline ki-plus fs-4 me-2 text-success"></i>
                                                                            Add New Contract
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                {{-- Stop Contract hanya muncul jika belum complete/stop --}}
                                                                @if(!in_array($item->status, ['signed-head', 'stop']))
                                                                    <li>
                                                                        <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                                            onclick="confirmStop({{ $item->id }})">
                                                                            <i class="ki-outline ki-cross-circle fs-4 me-2"></i>
                                                                            Stop Contract
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endcan

                                                            {{-- Aksi status (Send / Approve HRD / Approve GM) --}}
                                                            @if ($statusAction)
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        onclick="{{ $statusAction['onclick'] }}">
                                                                        <i
                                                                            class="ki-outline {{ $statusAction['icon'] }} fs-4 me-2 {{ $statusAction['color'] }}"></i>
                                                                        {{ $statusAction['label'] }}
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            {{-- Delete --}}
                                                            @can('delete-contracts')
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                                        onclick="confirmDelete({{ $item->id }})">
                                                                        <i class="ki-outline ki-trash fs-4 me-2"></i>
                                                                        Hapus Contract
                                                                    </a>
                                                                </li>
                                                            @endcan
                                                        </ul>
                                                    </div>
                                                @endif

                                                {{-- Form tersembunyi untuk aksi status --}}
                                                @if ($statusAction)
                                                    <form id="{{ $statusAction['formId'] }}" action="{{ $statusAction['route'] }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                    </form>
                                                @endif

                                                {{-- Form tersembunyi Stop --}}
                                                {{-- Form tersembunyi Stop --}}
                                                <form id="stop-form-{{ $item->id }}"
                                                    action="{{ route('contracts.stop', $item->id) }}" method="POST"
                                                    style="display:none;">
                                                    @csrf
                                                    @method('PUT') <!-- TAMBAHKAN INI -->
                                                </form>

                                                {{-- Form tersembunyi delete --}}
                                                @can('delete-contracts')
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('contracts.destroy', $item->id) }}" method="POST"
                                                        style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
        // ============================================
        // Index kolom
        // ============================================
        const COL = {
            CHECKBOX: 0,
            NO: 1,
            CATEGORY: 3,
            TYPE: 4,
            PROJECT: 6,
            START: 9,
            END: 10,
            STATUS: 11,
            ACTION: 12,
        };

        // ============================================
        // Permission flags dari Blade
        // ============================================
        const PERMISSIONS = {
            canEdit: @json(auth()->user()->can('edit-contracts')),
            canDelete: @json(auth()->user()->can('delete-contracts')),
        };

        // ============================================
        // Mapping status → definisi bulk action
        // ============================================
        const BULK_ACTIONS = {
            'draft': {
                label: 'Send Semua ke Head HRD',
                icon: 'ki-send',
                btnClass: 'btn-primary',
                route: '{{ route("contracts.bulk-approve-hrd") }}', // Ganti sesuai route bulk Anda
                confirmTitle: 'Kirim Semua ke Head HRD?',
                confirmText: 'Semua contract draft yang dipilih akan dikirim ke Head HRD.',
                confirmBtn: 'Ya, kirim!',
            },
            'signed-hrd': {
                label: 'Send Semua ke Employee',
                icon: 'ki-user-tick',
                btnClass: 'btn-info',
                route: '{{ route("contracts.bulk-send") }}',
                confirmTitle: 'Kirim Semua ke Employee?',
                confirmText: 'Semua contract yang dipilih akan dikirim ke Employee.',
                confirmBtn: 'Ya, kirim!',
            },
            'signed': {
                label: 'Approve GM Semua',
                icon: 'ki-check-circle',
                btnClass: 'btn-success',
                route: '{{ route("contracts.bulk-stop") }}', // Sesuaikan dengan route bulk stop
                confirmTitle: 'Approve GM Semua?',
                confirmText: 'Semua contract yang dipilih akan disetujui oleh General Manager.',
                confirmBtn: 'Ya, approve!',
            },
        };

        $(document).ready(function () {

            // ============================================
            // Inisialisasi Select2
            // ============================================
            $('[data-control="select2"]').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            // ============================================
            // Inisialisasi DataTable
            // ============================================
            var table = $('#contractTable').DataTable({
                searching: true,
                ordering: true,
                paging: true,
                info: true,
                pageLength: 50,
                lengthMenu: [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
                search: {
                    smart: false,
                    regex: false,
                    caseInsensitive: true
                },
                columnDefs: [
                    { orderable: false, targets: [COL.CHECKBOX, COL.NO, COL.ACTION] }
                ]
            });

            // ============================================
            // CUSTOM FILTER: START DATE & END DATE ONLY
            // ============================================
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    if (settings.nTable.id !== 'contractTable') return true;

                    var startFrom = $('#filterStartDate').val();
                    var startTo = $('#filterEndDate').val();
                    var endDateOnly = $('#filterEndDateOnly').val();

                    var row = table.row(dataIndex).node();
                    var rowStartDateStr = $(row).find('td').eq(COL.START).attr('data-order');
                    var rowEndDateStr = $(row).find('td').eq(COL.END).attr('data-order');

                    // 1. Filter Start Date (From & To)
                    if (startFrom || startTo) {
                        if (!rowStartDateStr) return false;
                        var rowStartDate = new Date(rowStartDateStr);
                        if (startFrom && rowStartDate < new Date(startFrom)) return false;
                        if (startTo && rowStartDate > new Date(startTo)) return false;
                    }

                    // 2. Filter End Date Only
                    if (endDateOnly) {
                        if (!rowEndDateStr) return false;
                        if (rowEndDateStr !== endDateOnly) return false;
                    }

                    return true;
                }
            );

            // Trigger filter saat tanggal diubah
            $('#filterStartDate, #filterEndDate, #filterEndDateOnly').on('change', function () {
                table.draw();
            });
            // ============================================
            // Search (global)
            // ============================================
            $('#filterSearch').on('keyup', function () {
                table.search(this.value).draw();
            });

            // ============================================
            // Custom filter Category & Type
            // ============================================
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                if (settings.nTable.id !== 'contractTable') return true;

                var selectedCategory = $('#filterCategory').val();
                var selectedType = $('#filterType').val();

                if (!selectedCategory && !selectedType) return true;

                var row = table.row(dataIndex).node();

                if (selectedCategory) {
                    var rowCategory = $(row).find('td').eq(COL.CATEGORY).data('category') || '';
                    if (rowCategory !== selectedCategory) return false;
                }

                if (selectedType) {
                    var rowType = $(row).find('td').eq(COL.TYPE).data('type') || '';
                    if (rowType !== selectedType) return false;
                }

                return true;
            });

            $('#filterCategory').on('change', function () { table.draw(); });
            $('#filterType').on('change', function () { table.draw(); });

            // ============================================
            // Filter Project (exact match)
            // ============================================
            $('#filterProject').on('change', function () {
                var val = this.value;
                table.column(COL.PROJECT).search(val ? '^' + val + '$' : '', true, false).draw();
            });

            // ============================================
            // Filter Status
            // ============================================
            $('#filterStatus').on('change', function () {
                var val = this.value;
                var labelMap = {
                    'draft': 'Draft',
                    'signed-hrd': 'Ready to Send',
                    'signed': 'Need GM Approval',
                    'signed-head': 'Complete',
                    'stop': 'Stop',
                    'expired': 'Expired'
                };
                table.column(COL.STATUS).search(val ? labelMap[val] : '', true, false).draw();
            });

            // ============================================
            // Reset Filter
            // ============================================
            $('#resetFilter').on('click', function () {
                $('#filterSearch').val('');

                $('#filterCategory').val(null).trigger('change.select2');
                $('#filterType').val(null).trigger('change.select2');
                $('#filterProject').val(null).trigger('change.select2');
                $('#filterStatus').val(null).trigger('change.select2');

                // Reset semua input tanggal
                $('#filterStartDate').val('');
                $('#filterEndDate').val('');
                $('#filterEndDateOnly').val('');

                table.search('').columns().search('').draw();
            });

            // ============================================
            // CHECK ALL
            // ============================================
            $('#checkAll').on('change', function () {
                var isChecked = this.checked;

                $('#contractTable tbody .row-checkbox').each(function () {
                    if ($(this).closest('tr').is(':visible')) {
                        $(this).prop('checked', isChecked);
                    }
                });

                updateBulkActionBar();
            });

            // ============================================
            // CHECK PER ROW
            // ============================================
            $(document).on('change', '.row-checkbox', function () {
                updateCheckAllState();
                updateBulkActionBar();
            });

            // ============================================
            // Sinkronisasi saat DataTable redraw
            // ============================================
            table.on('draw', function () {
                updateCheckAllState();
                updateBulkActionBar();
            });

            function updateCheckAllState() {
                var visibleCheckboxes = $('#contractTable tbody .row-checkbox').filter(function () {
                    return $(this).closest('tr').is(':visible');
                });

                var checkedVisible = visibleCheckboxes.filter(':checked');

                if (visibleCheckboxes.length === 0) {
                    $('#checkAll').prop('checked', false).prop('indeterminate', false);
                } else if (checkedVisible.length === visibleCheckboxes.length) {
                    $('#checkAll').prop('checked', true).prop('indeterminate', false);
                } else if (checkedVisible.length === 0) {
                    $('#checkAll').prop('checked', false).prop('indeterminate', false);
                } else {
                    $('#checkAll').prop('checked', false).prop('indeterminate', true);
                }
            }

            function getSelected() {
                var ids = [];
                var statuses = new Set();

                $('#contractTable tbody .row-checkbox:checked').each(function () {
                    ids.push($(this).val());
                    statuses.add($(this).data('status'));
                });

                return {
                    ids: ids,
                    statuses: Array.from(statuses),
                    isUniform: statuses.size === 1,
                    singleStatus: statuses.size === 1 ? Array.from(statuses)[0] : null,
                };
            }

            function updateBulkActionBar() {
                var selected = getSelected();
                var count = selected.ids.length;

                $('#selectedCount').text(count);

                if (count === 0) {
                    $('#bulkActionBar').addClass('d-none');
                    return;
                }

                $('#bulkActionBar').removeClass('d-none');

                var $container = $('#bulkActionButtons');
                var $info = $('#bulkActionInfo');

                $container.empty();

                if (!selected.isUniform) {
                    $info.html('<span class="text-danger fw-semibold">Status contract tidak seragam.</span> Bulk action hanya bisa dilakukan jika semua contract yang dipilih memiliki status yang sama.');
                    if (PERMISSIONS.canDelete) {
                        $container.append(buildDeleteButton());
                    }
                    $container.append(buildCancelButton());
                    return;
                }

                var status = selected.singleStatus;
                var action = BULK_ACTIONS[status];

                if (action && PERMISSIONS.canEdit) {
                    $info.text('Status terdeteksi: ' + status + '. Aksi yang tersedia di bawah ini.');
                    $container.append(buildActionButton(action));
                } else if (action && !PERMISSIONS.canEdit) {
                    $info.html('<span class="text-muted">Anda tidak memiliki izin untuk melakukan aksi bulk pada status ini.</span>');
                } else {
                    $info.html('<span class="text-muted">Tidak ada bulk action yang tersedia untuk status <b>' + status + '</b>.</span>');
                }

                if (PERMISSIONS.canDelete) {
                    $container.append(buildDeleteButton());
                }

                $container.append(buildCancelButton());
            }

            function buildActionButton(action) {
                return $('<button>', {
                    type: 'button',
                    class: 'btn btn-sm ' + action.btnClass,
                    html: '<i class="ki-outline ' + action.icon + ' fs-4 me-1"></i> ' + action.label,
                    on: {
                        click: function () { runBulkAction(action); }
                    }
                });
            }

            function buildDeleteButton() {
                return $('<button>', {
                    type: 'button',
                    class: 'btn btn-sm btn-danger',
                    html: '<i class="ki-outline ki-trash fs-4 me-1"></i> Hapus Terpilih',
                    on: {
                        click: function () { bulkDelete(); }
                    }
                });
            }

            function buildCancelButton() {
                return $('<button>', {
                    type: 'button',
                    class: 'btn btn-sm btn-light',
                    text: 'Batal',
                    on: {
                        click: function () { clearSelection(); }
                    }
                });
            }

            function runBulkAction(action) {
                var ids = getSelected().ids;

                if (ids.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak ada data dipilih',
                        text: 'Silakan pilih minimal satu contract terlebih dahulu.'
                    });
                    return;
                }

                Swal.fire({
                    title: action.confirmTitle,
                    text: action.confirmText + ' (' + ids.length + ' contract)',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--bs-primary)',
                    cancelButtonColor: 'var(--bs-secondary)',
                    confirmButtonText: action.confirmBtn,
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitBulkForm(action.route, ids);
                    }
                });
            }

            function bulkDelete() {
                var ids = getSelected().ids;

                if (ids.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak ada data dipilih',
                        text: 'Silakan pilih minimal satu contract terlebih dahulu.'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Hapus ' + ids.length + ' contract?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--bs-danger)',
                    cancelButtonColor: 'var(--bs-secondary)',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitBulkForm('{{ route("contracts.bulk-delete") }}', ids);
                    }
                });
            }

            function submitBulkForm(url, ids) {
                var form = $('<form>', {
                    'method': 'POST',
                    'action': url
                });

                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': '{{ csrf_token() }}'
                }));

                if (url.indexOf('bulk-delete') !== -1) {
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));
                }

                ids.forEach(function (id) {
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': 'ids[]',
                        'value': id
                    }));
                });

                $('body').append(form);
                form.submit();
            }

            window.clearSelection = function () {
                $('#contractTable tbody .row-checkbox').prop('checked', false);
                $('#checkAll').prop('checked', false).prop('indeterminate', false);
                updateBulkActionBar();
            };

            // ============================================
            // FIX: Reposisi dropdown saat scroll
            // ============================================
            document.addEventListener('show.bs.dropdown', function (e) {
                var menu = e.target.querySelector('.dropdown-menu');
                if (menu) {
                    menu.style.zIndex = '9999';
                }
            });

        });

        // ============================================
        // Konfirmasi Aksi per-row
        // ============================================
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
                    document.getElementById('delete-form-' + contractId).submit();
                }
            });
        }

        function confirmSend(contractId) {
            Swal.fire({
                title: 'Kirim Contract ke Employee?',
                text: 'Contract akan dikirim ke employee untuk ditandatangani.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: 'var(--bs-primary)',
                cancelButtonColor: 'var(--bs-danger)',
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('send-form-' + contractId).submit();
                }
            });
        }

        function confirmApproveHRD(id) {
            Swal.fire({
                title: 'Kirim ke Head HRD?',
                text: 'Contract akan dikirim ke Head HRD untuk di-approve.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kirim',
                cancelButtonText: 'Batal',
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
                text: 'Contract akan diselesaikan setelah di-approve oleh General Manager.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Approve',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-light'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approve-gm-form-' + id).submit();
                }
            });
        }

        function confirmStop(id) {
            Swal.fire({
                title: 'Hentikan Kontrak?',
                text: 'Kontrak ini akan dihentikan (Stop) dan tidak bisa dilanjutkan kembali.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hentikan',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('stop-form-' + id).submit();
                }
            });
        }

        $('#btnExportExcel').on('click', function () {
            var params = new URLSearchParams({
                category: $('#filterCategory').val() || '',
                type: $('#filterType').val() || '',
                project: $('#filterProject').val() || '',
                status: $('#filterStatus').val() || '',
                start_date: $('#filterStartDate').val() || '',
                end_date: $('#filterEndDate').val() || '',
            });

            window.location.href = '{{ route("contracts.export") }}?' + params.toString();
        });
    </script>
@endsection