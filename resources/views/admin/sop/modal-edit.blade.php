<div class="modal fade" tabindex="-1" id="kt_modal_edit{{ $item->id }}">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit SOP</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <div class="modal-body">
                <form action="{{ route('sop.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Pelanggan -->
                    <div class="mb-3">
                        <label for="edit_name{{ $item->id }}" class="form-label">
                            Nama 
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="edit_name{{ $item->id }}" name="name"
                            value="{{ $item->nama }}" required>
                    </div>

                    <!-- Alias -->
                    <div class="mb-3">
                        <label for="edit_alias{{ $item->id }}" class="form-label">
                            Kode
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="edit_alias{{ $item->id }}" name="kode"
                            value="{{ $item->kode }}" required>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="edit_alamat{{ $item->id }}" class="form-label">
                            Tanggal
                            <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" id="edit_alamat{{ $item->id }}" name="tanggal"
                            value="{{ $item->tanggal_kadaluarsa }}" required>
                    </div>

                    <!-- Nomor HP -->
                    <div class="mb-3">
                        <label for="edit_phone{{ $item->id }}" class="form-label">
                            Vendor
                            <span class="text-danger">*</span>
                        </label>
                        <input type="integer" class="form-control" id="edit_phone{{ $item->id }}" name="vendor"
                            value="{{ $item->vendor }}" required>
                    </div>


                    <div class="px-0 modal-footer">
                        <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
