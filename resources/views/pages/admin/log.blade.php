@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.datatables')
        @include('components.styles.select2')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / Riwayat Pembayaran
        </h4>

        <!-- Hoverable Table rows -->
        <div class="card">
            {{--  Buat Button  --}}
             <h5 class="card-header">
                <button type="button" class="btn rounded-pill btn-primary" onclick="logImport()">
                    <span class="tf-icons bx bxs-plus-square "></span>&nbsp; Import Data
                </button>
            </h5> 
            <div class="table-responsive text-nowrap m-3">
                <table class="table table-hover" id="logTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penyewa</th>
                            <th>Pilihan Kamar</th>
                            <th>Awal Sewa</th>
                            <th>Akhir Sewa</th>
                            <th>Diskon</th>
                            <th>Total Harga</th>
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
    <!-- / Content -->

    @push('script')
        @include('components.scripts.datatables')
        @include('components.scripts.sweetalert')
        @include('components.scripts.select2')
        @include($script)
    @endpush
@endsection
