<form id="editStatusInvForm">
    <div class="modal" id="editStatusInvModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Rubah Status Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameStatusInvEdit" class="form-label">Nama Penyewa</label>
                            <input type="text" class="form-control" id="nameStatusInvEdit" name="nameStatusInvEdit" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomStatusInvEdit" class="form-label">Pilihan Kamar</label>
                            <input type="text" class="form-control" id="roomStatusInvEdit" name="roomStatusInvEdit" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="startStatusInvEdit" class="form-label">Awal Sewa</label>
                            <input type="text" class="form-control" id="startStatusInvEdit" name="startStatusInvEdit" readonly>
                        </div>
                        <div class="col mb-3">
                            <label for="endStatusInvEdit" class="form-label">Akhir Sewa</label>
                            <input type="text" class="form-control" id="endStatusInvEdit" name="endStatusInvEdit" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="statusStatusInvEdit" class="form-label">Status Invoice</label>
                            <select class="form-select" id="statusStatusInvEdit" name="statusStatusInvEdit">
                                <option value="Non-Aktif">Non-Aktif</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Berjalan">Berjalan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editStatusInvSubmit">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</form>
