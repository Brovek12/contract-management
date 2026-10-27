{{-- ================================= --}}
{{-- MODAL HARIAN                      --}}
{{-- ================================= --}}
<div class="modal fade" id="modalHarian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ki-duotone ki-calendar fs-2 me-2"></i>
                    Pilih Tipe Contract - Harian
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">

                    <a href="{{ route('contracts.create', ['type' => 'harian-biasa', 'category' => 'harian']) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="ki-duotone ki-document fs-2 me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">Perjanjian Kerja Karyawan Harian</div>
                            <small class="text-muted">(harian-biasa)</small>
                        </div>
                    </a>

                    {{-- Jika nanti ada tipe harian lain, tinggal copy-paste blok <a> di atas dan ganti value-nya --}}

                </div>
            </div>
        </div>
    </div>
</div>