<form id="createRoomForm">
    <div class="modal" id="createRoomModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomName" class="form-label">Nama Kamar</label>
                            <input type="text" id="roomName" name="roomName" class="form-control" placeholder="Masukkan nama kamar">
                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomPrice" class="form-label">Harga</label>
                            <input type="text" id="roomPrice" name="roomPrice" class="form-control roomPrice" placeholder="Masukkan harga kamar">
                        </div>
                        <div class="col mb-3">
                            <label for="roomStock" class="form-label">Jumlah Kamar</label>
                            <input type="number" id="roomStock" name="roomStock" class="form-control" min="1" placeholder="Masukkan banyaknya kamar">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="roomDetail" class="form-label">Detail Kamar</label>
                            <input type="text" id="roomDetail" name="roomDetail" class="form-control" placeholder="Masukkan detail kamar">
                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createRoomSubmit">Buat Kamar</button>
                </div>
            </div>
        </div>
    </div>
</form>
