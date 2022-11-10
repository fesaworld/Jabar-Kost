<form id="editInvForm">
    <div class="modal" id="editInvModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="invEditName" class="form-label">Nama Penyewa</label>

                            <input type="text" id="invEditName" name="invEditName" class="form-control" readonly>
                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="invEditRoom" class="form-label">Pilihan Kamar</label>

                            <select id="invEditRoom" name="invEditRoom" class="form-select">
                                @foreach($getRoom as $getRoomName)
                                    <option value="{{$getRoomName->id}}">{{$getRoomName->name}}</option>
                                @endforeach
                            </select>

                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">

                            <label for="invEditStart" class="col-md-12 col-form-label">Awal Sewa</label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" value="" name="invEditStart" id="invEditStart">
                            </div>

                        </div>
                        <div class="col mb-3">

                            <label for="invEditEnd" class="col-md-12 col-form-label">Akhir Sewa</label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" value="" name="invEditEnd" id="invEditEnd">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="invEditDisc" class="form-label">Diskon (%)</label>

                            <div class="input-group">
                                <input type="number" class="form-control" id="invEditDisc" name="invEditDisc">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editInvSubmit">Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
</form>
