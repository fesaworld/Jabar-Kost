<form id="userOrderForm">
    <div class="modal" id="userOrderModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Pesan Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="orderUserName" class="form-label">Nama Penyewa</label>

                            <input type="text" id="orderUserName" name="orderUserName" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            
                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="orderRoomName" class="form-label">Pilihan Kamar</label>

                            <input type="text" id="orderRoomName" name="orderRoomName" class="form-control" readonly>
                            <input type="hidden" id="orderRoomID" name="orderRoomID">

                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">

                            <label for="orderStart" class="col-md-12 col-form-label">Awal Sewa</label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" value="{{ date("Y-m-d") }}" name="orderStart" id="orderStart">
                            </div>

                        </div>
                        <div class="col mb-3">

                            <label for="orderEnd" class="col-md-12 col-form-label">Akhir Sewa</label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" value="{{ date("Y-m-d") }}" name="orderEnd" id="orderEnd">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="orderSubmit">Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
</form>
