{{-- ================================= --}}
{{-- MODAL MANAJERIAL (3 pilihan)      --}}
{{-- ================================= --}}
<div class="modal fade" id="modalManajerial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ki-duotone ki-briefcase fs-2 me-2"></i>
                    Pilih Tipe Contract - Manajerial
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">

                    <a href="{{ route('contracts.create', ['type' => 'gp-um-ut-fungsi', 'category' => 'managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(gp-um-ut-fungsi)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'gp-mahal-um-ut-fungsi', 'category' => 'managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(gp-mahal-um-ut-fungsi)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'all-in', 'category' => 'managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(ALL-IN)</small>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>