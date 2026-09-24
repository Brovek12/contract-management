{{-- ================================= --}}
{{-- MODAL NON-MANAJERIAL (7 pilihan)  --}}
{{-- ================================= --}}
<div class="modal fade" id="modalNonManajerial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ki-duotone ki-people fs-2 me-2"></i>
                    Pilih Tipe Contract - Non-Manajerial
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">

                    <a href="{{ route('contracts.create', ['type' => 'security', 'category' => 'non-managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-success"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Non Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(Security)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'ob', 'category' => 'non-managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-success"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Non Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(OB)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'gp-um-ut-laut', 'category' => 'non-managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-success"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Non Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(gp-um-ut-laut)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'gp-um-ut', 'category' => 'non-managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-success"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Non Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(gp-um-ut)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'gp-mahal-um-ut-fungsi', 'category' => 'non-managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-success"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Non Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(gp-mahal-um-ut-fungsi)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'gp-mahal-um-ut-fungsi-pls', 'category' => 'non-managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-success"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Non Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(gp-mahal-um-ut-fungsi-pls)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'gp-mahal-um-ut', 'category' => 'non-managerial']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-success"></i>
                        <div>
                            <div class="fw-bold">PKWT OFFWS Non Managerial - Bukaka Balikpapan</div>
                            <small class="text-muted">(gp-mahal-um-ut)</small>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>  
</div>