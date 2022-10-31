@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.datatables')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / Riwayat Pembayaran
        </h4>

        <!-- Hoverable Table rows -->
        <div class="card">
            {{--  Buat Button  --}}
            <div class="table-responsive text-nowrap m-3">
                <table class="table table-hover" id="historyTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Kamar</th>
                            <th>Awal Sewa</th>
                            <th>Akhir Sewa</th>
                            <th>Diskon</th>
                            <th>Total Harga</th>
                            <th>Bukti Transfer</th>
                            <th>Status Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="historyTableRow">
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
        @include($script)
    @endpush
@endsection
