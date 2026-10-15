{{-- ========================== --}}
{{-- MODAL PROJECT (25 pilihan) --}}
{{-- ========================== --}}
<div class="modal fade" id="modalProject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ki-duotone ki-project fs-2 me-2"></i>
                    Pilih Tipe Contract - Project
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- ========================================== --}}
                {{-- ENI                                     --}}
                {{-- ========================================== --}}
                <div class="mb-4">
                    <h6 class="text-muted text-uppercase fw-bold fs-7 mb-3">
                        ENI
                    </h6>
                    <div class="list-group">

                        <a href="{{ route('contracts.create', ['type' => 'eni-civil-all-in', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT ENI Civil Project - All in Team (Gaji 25)</div>
                                <small class="text-muted">(eni-civil-all-in)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'eni-civil-reguler', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT ENI Civil Project - Bukaka (Gaji 09)</div>
                                <small class="text-muted">(eni-civil-reguler)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'eni-smallcapital-all-in', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project - ENI Small Capital (ALL-IN)</div>
                                <small class="text-muted">(eni-smallcapital-all-in)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'eni-smallcapital-reguler', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project - ENI Small Capital (Reguler)</div>
                                <small class="text-muted">(eni-smallcapital-reguler)</small>
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
                                <div class="fw-bold">PKWT ENI Muara Bakau Project 2026 - All in Gaji 25 Project Control</div>
                                <small class="text-muted">(eni-muara-bakau-all-in)</small>
                            </div>
                        </a>

                    </div>
                </div>


                {{-- ========================================== --}}
                {{-- WARLOK / MEDCO                          --}}
                {{-- ========================================== --}}
                <div class="mb-4">
                    <h6 class="text-muted text-uppercase fw-bold fs-7 mb-3">
                        Warlok / Medco
                    </h6>
                    <div class="list-group">

                        <a href="{{ route('contracts.create', ['type' => 'warlok-all-in', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project - Warlok Medco Tarakan (All In)</div>
                                <small class="text-muted">(warlok-all-in)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'warlok-lembur', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project - Warlok Medco Tarakan (LEMBUR)</div>
                                <small class="text-muted">(warlok-lembur)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'warlok-security', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project - Warlok Medco Tarakan (SECURITY WAKAR)</div>
                                <small class="text-muted">(warlok-security)</small>
                            </div>
                        </a>

                    </div>
                </div>


                {{-- ========================================== --}}
                {{-- ELIS PHKT                                --}}
                {{-- ========================================== --}}
                <div class="mb-4">
                    <h6 class="text-muted text-uppercase fw-bold fs-7 mb-3">
                        ELIS PHKT
                    </h6>
                    <div class="list-group">

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

                    </div>
                </div>


                {{-- ========================================== --}}
                {{-- PHSS MAJOR                               --}}
                {{-- ========================================== --}}
                <div class="mb-4">
                    <h6 class="text-muted text-uppercase fw-bold fs-7 mb-3">
                        PHSS Major Project
                    </h6>
                    <div class="list-group">

                        <a href="{{ route('contracts.create', ['type' => 'phss-major-ai-1', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PHSS Major Project - Bukaka (ALL-in Type 1)</div>
                                <small class="text-muted">(phss-major-ai-1)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'phss-major-ai-2', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PHSS Major Project - Bukaka (ALL-in Type 2)</div>
                                <small class="text-muted">(phss-major-ai-2)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'phss-major-ai-3', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PHSS Major Project - Bukaka (ALL-in Type 3)</div>
                                <small class="text-muted">(phss-major-ai-3)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'phss-driver', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PHSS Major Project - Bukaka (Driver BPN)</div>
                                <small class="text-muted">(phss-driver)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'phss-humas', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PHSS Major Project - Bukaka (Humas)</div>
                                <small class="text-muted">(phss-humas)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'phss-reguler', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PHSS Major Project - Bukaka (Reguler)</div>
                                <small class="text-muted">(phss-reguler)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'phss-security', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PHSS Major Project - Bukaka (Security WS)</div>
                                <small class="text-muted">(phss-security)</small>
                            </div>
                        </a>

                    </div>
                </div>


                {{-- ========================================== --}}
                {{-- SAND MONITORING                          --}}
                {{-- ========================================== --}}
                <div class="mb-4">
                    <h6 class="text-muted text-uppercase fw-bold fs-7 mb-3">
                        Sand Monitoring Services — PHM
                    </h6>
                    <div class="list-group">

                        <a href="{{ route('contracts.create', ['type' => 'sandmon-teknisi-1', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Sand Monitoring Project 2025 (Update 2026) - Teknisi 1</div>
                                <small class="text-muted">(sandmon-teknisi-1)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'sandmon-teknisi-2', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Sand Monitoring Project 2025 (Update 2026) - Teknisi 2</div>
                                <small class="text-muted">(sandmon-teknisi-2)</small>
                            </div>
                        </a>

                    </div>
                </div>


                {{-- ========================================== --}}
                {{-- LAIN-LAIN                                --}}
                {{-- ========================================== --}}
                <div class="mb-2">
                    <h6 class="text-muted text-uppercase fw-bold fs-7 mb-3">
                        Lain-lain
                    </h6>
                    <div class="list-group">

                        <a href="{{ route('contracts.create', ['type' => 'pep-lokal-buny', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT PEP Project - Lokal Bunyu 2026</div>
                                <small class="text-muted">(pep-lokal-buny)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'sched-5-2', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project Schedule 5-2 Rev. 2026 (Gaji 09)</div>
                                <small class="text-muted">(sched-5-2)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'lawe-lawe-reguler', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project - LAWE LAWE (Reguler)</div>
                                <small class="text-muted">(lawe-lawe-reguler)</small>
                            </div>
                        </a>

                        <a href="{{ route('contracts.create', ['type' => 'lawe-lawe-all-in', 'category' => 'project']) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="ki-duotone ki-document fs-2 me-3 text-warning"></i>
                            <div>
                                <div class="fw-bold">PKWT Project - LAWE LAWE (All In)</div>
                                <small class="text-muted">(lawe-lawe-all-in)</small>
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
</div>