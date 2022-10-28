@extends('layouts.master')

@section('content')
@push('style')
@include('components.styles.datatables')
@endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / Tagihan Pembayaran
        </h5>
        <div class="card mb-4">
            <div class="card-body">
                {{--  <form action="{{ url('/userBill/' . $data->id) }}" method="POST" enctype="multipart/form-data">  --}}
                <form id="editBillForm">
                    {{--  @csrf  --}}
                    <div class="mb-3">
                        <label class="form-label" for="userName">Nama Pemesan</label>
                        <input type="text" class="form-control" id="userName" name="userName"
                            placeholder="{{ $data->toUser->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="userRoom">Pilihan Kamar</label>
                        <input type="text" class="form-control" id="userRoom" name="userRoom"
                            placeholder="{{ $data->toRoom->name }}" readonly>
                        <div data-lastpass-icon-root="true"
                            style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="startUser" class="form-label">Mulai Sewa</label>
                            <input type="text" class="form-control" id="startUser" name="startUser"
                                placeholder="{{ $data->start }}" readonly>
                        </div>
                        <div class="col mb-3">
                            <label for="endUser" class="form-label">Akhir Sewa</label>
                            <input type="number" class="form-control" id="endUser" name="endUser"
                                placeholder="{{ $data->end }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="discUser" class="form-label">Diskon</label>
                            <input type="number" class="form-control" id="discUser" name="discUser"
                                placeholder="{{ $data->discount }}" readonly>
                        </div>
                        <div class="col mb-3">
                            <label for="priceUser" class="form-label">Total Harga</label>
                            <input type="number" class="form-control" id="priceUser" name="priceUser"
                                placeholder="{{ $data->total_price }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="statusUser">Status</label>
                        <input type="text" class="form-control form-control-lg" id="statusUser" name="statusUser"
                            placeholder="{{ $data->status }}" readonly>
                        <div data-lastpass-icon-root="true"
                            style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                        </div>
                    </div>

                    <div class="mb-3 ">
                        <label class="form-label" for="trfUser">Bukti Transfer</label>
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if ($data->trf_image == null)
                                        <img src="{{ asset('assets/image/default/notFound.png') }}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="trfUser" name="trfUser">
                                    @else
                                        <img src="{{ asset('assets/image/buktiTrf') . '/' . $data->trf_image }}" alt="user-avatar"
                                                class="d-block rounded" height="100" width="100" id="trfUser" name="trfUser">
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" name="trfUser" id="upload" class="account-file-input" hidden=""
                                                accept="image/png, image/jpeg">
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>

                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                            </div>
                        </div>
                    </div>

                    @if ($data->status == 'Non-Aktif')
                        <button type="button" class="btn btn-primary float-end" onclick="editBill({{ $data->id }})" id="editBillSubmit">Kirim Bukti Transfer</button>
                    @else
                        <button type="button" class="btn btn-primary float-end" onclick="editBill({{ $data->id }})" id="editBillSubmit" disabled>Kirim Bukti Transfer</button>
                    @endif


                </form>
            </div>
        </div>

    </div>

    <!-- / Content -->


    @push('script')
        @include('components.scripts.dropify')
        @include('components.scripts.sweetalert')
        @include($script)
    @endpush
@endsection
