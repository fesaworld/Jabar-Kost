@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.datatables')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / List Token
        </h4>

        <!-- Hoverable Table rows -->
        <div class="card">
            {{--  Buat Button  --}}
            <h5 class="card-header">
                <button type="button" class="btn rounded-pill btn-primary" onclick="createToken()">
                    <span class="tf-icons bx bxs-plus-square "></span>&nbsp; Buat Token Baru
                </button>
            </h5>
            <div class="table-responsive text-nowrap m-3">
                <table class="table table-hover" id="tokenTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Token</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="tokenTableRow">
                        <tr>

                        </tr>
                        <tr>

                        </tr>
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
    @include($script)
  @endpush
@endsection
