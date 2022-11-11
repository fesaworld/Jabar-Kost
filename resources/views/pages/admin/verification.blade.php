@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.datatables')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / Daftar Penyewa
        </h4>

        <!-- Hoverable Table rows -->
        <div class="card">
            {{--  Buat Button  --}}
            <div class="table-responsive text-nowrap m-3">
                <table class="table table-hover" id="verifTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomer Telpon</th>
                            <th>Jenis Kelamin</th>
                            <th>Identitas</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="verifTableRow">
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Hoverable Table rows -->
        <!--/ Table within card -->
    </div>
    @include('components.modals.verification.editStatus')
    {{--  @include('components.modals.invoice.edit')  --}}

    <!-- / Content -->

    @push('script')
        @include('components.scripts.datatables')
        @include('components.scripts.sweetalert')
        @include($script)
    @endpush
@endsection
