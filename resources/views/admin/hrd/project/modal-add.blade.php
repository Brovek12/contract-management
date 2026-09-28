<div class="modal fade" id="kt_modal_add">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Project</h5>

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
                    action="{{ route('projects.store') }}"
                    method="POST">

                    @csrf

                    <!-- Kode -->
                    <div class="mb-3">
                        <label for="code" class="form-label">
                            Kode
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control"
                            id="code"
                            name="code">

                        <div class="mt-1 text-danger d-none"
                            id="codeError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="owner" class="form-label">
                            Owner
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control"
                            id="owner"
                            name="owner">

                        <div class="mt-1 text-danger d-none"
                            id="ownerError"></div>
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nama Project
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control"
                            id="name"
                            name="name">

                        <div class="mt-1 text-danger d-none"
                            id="nameError"></div>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-3">
                        <label for="location" class="form-label">
                            Lokasi
                        </label>

                        <input type="text"
                            class="form-control"
                            id="location"
                            name="location">

                        <div class="mt-1 text-danger d-none"
                            id="locationError"></div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="is_active" class="form-label">
                            Status
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="is_active"
                            data-control="select2"
                            data-placeholder="Pilih Status"
                            data-dropdown-parent="#kt_modal_add"
                            class="form-select"
                            >

                            <option value="1" selected>
                                Aktif
                            </option>

                            <option value="0">
                                Tidak Aktif
                            </option>

                        </select>

                        <div class="mt-1 text-danger d-none"
                            id="isActiveError"></div>
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
                name: 'Nama Project'
            },
            {
                id: 'code',
                errorId: 'codeError',
                name: 'Kode'
            },
            {
                id: 'owner',
                errorId: 'ownerError',
                name: 'Owner'
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

        if (isValid) {
            document.getElementById('pelangganForm').submit();
        }
    }
</script>

