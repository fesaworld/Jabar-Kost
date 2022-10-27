@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.datatables')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Kamar /</span> List Kamar
        </h4>

        <!-- Hoverable Table rows -->
        <div class="card">
            {{--  Buat Button  --}}
            <h5 class="card-header">
                <button type="button" class="btn rounded-pill btn-primary" onclick="createRoom()">
                    <span class="tf-icons bx bxs-plus-square "></span>&nbsp; Tambah kamar baru
                </button>
            </h5>
            <div class="table-responsive text-nowrap m-3">
                <table class="table table-hover" id="roomTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kamar</th>
                            <th>Harga</th>
                            <th>Ketersediaan</th>
                            <th>Detail</th>
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
    @include('components.modals.room.create')
    @include('components.modals.room.edit')

    <!-- / Content -->

    @push('script')
        @include('components.scripts.datatables')
        @include('components.scripts.sweetalert')
        @include($script)
    @endpush
@endsection
