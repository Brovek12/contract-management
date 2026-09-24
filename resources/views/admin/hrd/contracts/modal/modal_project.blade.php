{{-- ========================== --}}
{{-- MODAL PROJECT (6 pilihan)  --}}
{{-- ========================== --}}
<div class="modal fade" id="modalProject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ki-duotone ki-project fs-2 me-2"></i>
                    Pilih Tipe Contract - Project
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">

                    <a href="{{ route('contracts.create', ['type' => 'pep-lokal-buny', 'category' => 'project']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                        <div>
                            <div class="fw-bold">PKWT PEP Project - Lokal Bunyu 2026</div>
                            <small class="text-muted">(pep-lokal-buny)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'elis-phkt-5-2', 'category' => 'project']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                        <div>
                            <div class="fw-bold">PKWT 2026 ELIS PHKT Project - Bukaka Balikpapan 5.2</div>
                            <small class="text-muted">(elis-phkt-5-2)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'elis-phkt-6-1', 'category' => 'project']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                        <div>
                            <div class="fw-bold">PKWT 2026 ELIS PHKT Project - Bukaka Balikpapan 6.1</div>
                            <small class="text-muted">(elis-phkt-6-1)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'eni-muara-bakau-lembur', 'category' => 'project']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                        <div>
                            <div class="fw-bold">PKWT ENI Muara Bakau Project - Bukaka Balikpapan 2026 (LEMBUR)</div>
                            <small class="text-muted">(eni-muara-bakau-lembur)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'eni-muara-bakau-all-in', 'category' => 'project']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                        <div>
                            <div class="fw-bold">PKWT ENI Muara Bakau Project 2026 - All in Gaji 25 project control</div>
                            <small class="text-muted">(eni-muara-bakau-all-in)</small>
                        </div>
                    </a>

                    <a href="{{ route('contracts.create', ['type' => 'ipfms-dobu', 'category' => 'project']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                        <div>
                            <div class="fw-bold">PKWT IPFMS-DOBU 2026</div>
                            <small class="text-muted">(ipfms-dobu)</small>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>