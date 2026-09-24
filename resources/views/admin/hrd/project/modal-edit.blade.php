<div class="modal fade" tabindex="-1" id="kt_modal_edit{{ $item->id }}">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Project</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <div class="modal-body">
                <form action="{{ route('projects.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Kode -->
                    <div class="mb-3">
                        <label for="edit_code{{ $item->id }}" class="form-label">
                            Kode
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="edit_code{{ $item->id }}"
                            name="code"
                            value="{{ $item->code }}"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="edit_owner{{ $item->id }}" class="form-label">
                            Owner
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="edit_owner{{ $item->id }}"
                            name="owner"
                            value="{{ $item->owner }}"
                            required
                        >
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="edit_name{{ $item->id }}" class="form-label">
                            Nama Project
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="edit_name{{ $item->id }}"
                            name="name"
                            value="{{ $item->name }}"
                            required
                        >
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-3">
                        <label for="edit_location{{ $item->id }}" class="form-label">
                            Lokasi
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="edit_location{{ $item->id }}"
                            name="location"
                            value="{{ $item->location }}"
                        >
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="edit_is_active{{ $item->id }}" class="form-label">
                            Status
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            class="form-select"
                            id="edit_is_active{{ $item->id }}"
                            name="is_active"
                            required
                        >
                            <option value="1" {{ $item->is_active == 1 ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="0" {{ $item->is_active == 0 ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>
                    </div>

                    <div class="px-0 modal-footer">
                        <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>