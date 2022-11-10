@extends('layouts.master')

@section('content')
    {{--  @push('style')
        @include('components.styles.dropify')
    @endpush  --}}
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / Pesan Kamar
        </h5>

        @if ($inv != null)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="fw-bold py-3"> Anda memiliki Pesanan aktif</h5>
                </div>
            </div>
        @elseif ($status != 'Terverifikasi')
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="fw-bold py-3"> Anda belum Terverifikasi, <a href="{{ url('/userProfile') }}">Lengkapi
                            Profil</a> sekarang</h5>
                </div>
            </div>
        @else
            <div class="row mb-5">
                @foreach ($room as $rooms)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100">
                            @if ($rooms->image == null)
                                <img class="card-img-top" src="{{ asset('assets/image/default/notFound.png') }}"
                                    alt="Card image cap">
                            @else
                                <img class="card-img-top" src="{{ asset('assets/image/room') . '/' . $rooms->image }}"
                                    alt="Card image cap">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $rooms->name }} ({{ number_format($rooms->price) }}/bulan)</h5>
                                <p>(Sisa {{ $rooms->stok }} Kamar)</p>
                                <p class="card-text">
                                    {{ $rooms->detail }}
                                </p>
                                <button onclick="createOrder({{ $rooms->id }})" class="btn btn-primary">Pesan
                                    Kamar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('components.modals.userOrder.create')

    <!-- / Content -->

    @push('script')
        @include('components.scripts.sweetalert')
        @include($script)
    @endpush
@endsection
