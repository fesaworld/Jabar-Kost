<form id="createInvForm">
    <div class="modal" id="createInvModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Create Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="invName" class="form-label">Nama Penyewa</label>

                            <select id="invName" name="invName" class="form-select selectUserInv">
                                <option selected disabled>Pilih Nama Penyewa</option>
                                @foreach($getUser as $getName)
                                    <option value="{{$getName->id}}">{{$getName->name}}</option>
                                @endforeach
                            </select>

                            <div data-lastpass-icon-root="true"
                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="invRoom" class="form-label">Pilihan Kamar</label>

                            <select id="invRoom" name="invRoom" class="form-select selectRoomInv">
                                <option selected disabled>Pilih Tipe Kamar</option>
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

                            <label for="invStart" class="col-md-12 col-form-label">Awal Sewa</label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" value="{{ date("Y-m-d") }}" name="invStart" id="invStart">
                            </div>

                        </div>
                        <div class="col mb-3">

                            <label for="invEnd" class="col-md-12 col-form-label">Akhir Sewa</label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" value="{{ date("Y-m-d") }}" name="invEnd" id="invEnd">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="invDisc" class="form-label">Diskon (%)</label>

                            <div class="input-group">
                                <input type="number" class="form-control" id="invDisc" name="invDisc" placeholder="Masukkan total diskon (dalam %)">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createInvSubmit">Buat Transaksi</button>
                </div>
            </div>
        </div>
    </div>
</form>
