<form id="editStatusForm">
    <div class="modal" id="editStatusModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Verifikasi Akun Penyewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="profilEdit" class="form-label">Foto Profil</label>
                            <img src="{{ asset('assets/image/default/notFound.png') }}" class="d-block rounded mx-auto"
                                height="200" width="200" id="profilEdit">
                        </div>
                        <div class="col mb-3">
                            <label for="cardEdit" class="form-label">Foto Identitas</label>
                            <img src="{{ asset('assets/image/default/notFound.png') }}" class="d-block rounded mx-auto"
                                height="200" width="200" id="cardEdit">
                            <input type="hidden" name="cardEditHidden" id="cardEditHidden">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameEdit" class="form-label">Nama Penyewa</label>
                            <input type="text" class="form-control" id="nameEdit" name="nameEdit" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="phoneEdit" class="form-label">Nomor Telpon</label>
                            <input type="text" class="form-control" id="phoneEdit" name="phoneEdit" readonly>
                        </div>
                        <div class="col mb-3">
                            <label for="genderEdit" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="genderEdit" name="genderEdit" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="addEdit" class="form-label">Alamat</label>
                            <textarea class="form-control" rows="3" data-lt-tmp-id="lt-304676" spellcheck="false" data-gramm="false" id="addEdit" name="addEdit" readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="statusEdit" class="form-label">Status Akun Penyewa</label>
                            <select class="form-select" id="statusEdit" name="statusEdit">
                                <option value="Non-Aktif">Non-Aktif</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Terverifikasi">Terverifikasi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editStatusSubmit">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</form>
