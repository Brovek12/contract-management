<div class="modal fade" id="kt_modal_add">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Dokumen</h5>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            <div class="modal-body">

                <form id="pelangganForm"
                    action="{{ route('sop.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nama
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control"
                            id="name"
                            name="name">

                        <div class="mt-1 text-danger d-none"
                            id="nameError"></div>
                    </div>

                    <!-- Kode -->
                    <div class="mb-3">
                        <label for="alias" class="form-label">
                            Kode
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control"
                            id="alias"
                            name="kode">

                        <div class="mt-1 text-danger d-none"
                            id="aliasError"></div>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">
                            Tanggal
                            <span class="text-danger">*</span>
                        </label>

                        <input type="date"
                            class="form-control"
                            id="tanggal"
                            name="tanggal">

                        <div class="mt-1 text-danger d-none"
                            id="tanggalError"></div>
                    </div>

                    <!-- Vendor -->
                    <div class="mb-3">
                        <label for="vendor" class="form-label">
                            Vendor
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control"
                            id="vendor"
                            name="vendor">

                        <div class="mt-1 text-danger d-none"
                            id="vendorError"></div>
                    </div>

                    <!-- PDF -->
                    <div class="mb-3">
                        <label for="file_pdf" class="form-label">
                            Dokumen PDF
                            <span class="text-danger">*</span>
                        </label>

                        <input type="file"
                            class="form-control"
                            id="file_pdf"
                            name="file_pdf"
                            accept="application/pdf">

                        <small class="text-muted">
                            Format PDF, maksimal 10 MB.
                        </small>

                        <div class="mt-1 text-danger d-none"
                            id="filePdfError"></div>
                    </div>

                    <div class="px-0 modal-footer">
                        <button type="button"
                            class="btn btn-light-danger"
                            data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="button"
                            class="btn btn-primary"
                            onclick="validateForm()">
                            Submit
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        let isValid = true;

        const fields = [
            {
                id: 'name',
                errorId: 'nameError',
                name: 'Nama'
            },
            {
                id: 'alias',
                errorId: 'aliasError',
                name: 'Kode'
            },
            {
                id: 'tanggal',
                errorId: 'tanggalError',
                name: 'Tanggal'
            },
            {
                id: 'vendor',
                errorId: 'vendorError',
                name: 'Vendor'
            }
        ];

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            const errorDiv = document.getElementById(field.errorId);

            if (input.value.trim() === "") {
                errorDiv.classList.remove('d-none');
                errorDiv.textContent = `${field.name} tidak boleh kosong.`;
                isValid = false;
            } else {
                errorDiv.classList.add('d-none');
            }
        });

        // Validasi PDF
        const fileInput = document.getElementById('file_pdf');
        const fileError = document.getElementById('filePdfError');
        const file = fileInput.files[0];

        if (!file) {
            fileError.classList.remove('d-none');
            fileError.textContent = 'Dokumen PDF wajib diupload.';
            isValid = false;
        } else {
            const maxSize = 10 * 1024 * 1024;

            if (file.type !== 'application/pdf') {
                fileError.classList.remove('d-none');
                fileError.textContent = 'File harus berformat PDF.';
                isValid = false;
            } else if (file.size > maxSize) {
                fileError.classList.remove('d-none');
                fileError.textContent = 'Ukuran PDF maksimal 10 MB.';
                isValid = false;
            } else {
                fileError.classList.add('d-none');
            }
        }

        if (isValid) {
            document.getElementById('pelangganForm').submit();
        }
    }
</script>