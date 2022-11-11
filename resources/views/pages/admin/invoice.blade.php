@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.datatables')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / List Penyewa
        </h4>

        <!-- Hoverable Table rows -->
        <div class="card">
            {{--  Buat Button  --}}
            {{--  <h5 class="card-header">
                <button type="button" class="btn rounded-pill btn-primary" onclick="createInv()">
                    <span class="tf-icons bx bxs-plus-square "></span>&nbsp; Tambah data baru
                </button>
            </h5>  --}}
            <div class="table-responsive text-nowrap m-3">
                <table class="table table-hover" id="invTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penyewa</th>
                            <th>Pilihan Kamar</th>
                            <th>Awal Sewa</th>
                            <th>Akhir Sewa</th>
                            <th>Diskon</th>
                            <th>Total Harga</th>
                            <th>Bukti Transfer</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="tokenTableRow">
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Hoverable Table rows -->
        <!--/ Table within card -->
    </div>
    @include('components.modals.invoice.create')
    @include('components.modals.invoice.edit')
    @include('components.modals.invoice.status')

    <!-- / Content -->

    @push('script')
        @include('components.scripts.datatables')
        @include('components.scripts.sweetalert')
        @include($script)
    @endpush
@endsection
