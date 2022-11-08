@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.dropify')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / Tagihan Pembayaran
        </h5>
        <div class="card mb-4">
            <div class="card-body">
                {{--  <form action="{{ url('/userBill/' . $data->id) }}" method="POST" enctype="multipart/form-data">  --}}
                @if ($data == null)
                <h5 class="fw-bold py-3"> Anda belum memiliki tagihan pembayaran aktif </h5>
                @else
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
                        <label class="form-label" for="imageTrf">Bukti Transfer</label>
                        {{--  {{ $segment1 == 'dashboard' ? 'active' : null }}  --}}
                        {{--  asset('assets/image/default/notFound.png')   --}}
                        <input type="file" class="form-control" id="imageTrf" name="imageTrf" data-default-file="{{ $data->trf_image == null ? asset('assets/image/default/notFound.png') : asset('assets/image/buktiTrf') . '/' . $data->trf_image}}">

                    </div>

                    @if ($data->status == 'Non-Aktif' || $data->status == 'Ditolak')
                        <button type="button" class="btn btn-primary float-end" onclick="editBill({{ $data->id }})" id="editBillSubmit">Kirim Bukti Transfer</button>
                    @else
                        <a href="{{ url('/userBillPrint/' .$data->id) }}" class="btn btn-primary float-end">Cetak Pembayaran</a>
                    @endif
                </form>
                @endif
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
