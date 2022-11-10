<form id="editRoomForm">
    <div class="modal" id="editRoomModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomNameEdit" class="form-label">Nama Kamar</label>
                            <input type="text" id="roomNameEdit" name="roomNameEdit" class="form-control"
                                placeholder="Masukkan nama kamar">
                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomPriceEdit" class="form-label">Harga</label>
                            <input type="text" id="roomPriceEdit" name="roomPriceEdit" class="form-control roomPrice"
                                placeholder="Masukkan harga kamar">
                        </div>
                        <div class="col mb-3">
                            <label for="roomStockEdit" class="form-label">Jumlah Kamar</label>
                            <input type="number" id="roomStockEdit" name="roomStockEdit" class="form-control"
                                min="1" placeholder="Masukkan banyaknya kamar" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomDetailEdit" class="form-label">Detail Kamar</label>
                            <input type="text" id="roomDetailEdit" name="roomDetailEdit" class="form-control"
                                placeholder="Masukkan detail kamar">
                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomImageEdit" class="form-label">Foto Kamar</label>
                            <input type="file" id="roomImageEdit" name="roomImageEdit" class="form-control" 
                                required data-allowed-file-extensions="jpg png"
                                data-max-file-size-preview="3M"
                                data-max-file-size="3M">
                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editRoomSubmit">Ubah Kamar</button>
                </div>
            </div>
        </div>
    </div>
</form>
