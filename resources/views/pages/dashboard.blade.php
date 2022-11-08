@extends('layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            {{--  Tampilan Welcome  --}}
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang di Dashboard {{ Auth::user()->getRoleNames()[0] }}! 🎉</h5>
                                <p class="mb-4">Apa yang akan anda lakukan hari ini ??</p>

                                @role('Super Admin')
                                <a class="btn btn-sm btn-outline-primary" onclick="createTokenDashboard()">Generate Token</a>
                                @endrole
                                @role('User')
                                <a href="{{ url('/userOrder') }}" class="btn btn-sm btn-outline-primary">Pesan Kamar</a>
                                @endrole
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @role('Super Admin')

                {{--  Tampilan Data Pendapatan  --}}
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                                style="position: relative;">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Data Pendapatan</h5>
                                        <span class="badge bg-label-secondary rounded-pill">{{ $bulan }}</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <small class="text-success text-nowrap fw-semibold">Total</small>
                                        <h3 class="mb-0">Rp. {{ $pemasukan }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  Tampilan Data Tunggakan  --}}
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                                style="position: relative;">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Data Tunggakan</h5>
                                        <span class="badge bg-label-secondary rounded-pill">{{ $bulan }}</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <small class="text-success text-nowrap fw-semibold">Total</small>
                                        <h3 class="mb-0">Rp. {{ $tunggakan }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 mb-12">
                    <div class="row">

                        {{--  Tampilan Kamar Tersedia  --}}
                        <div class="col-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="{{ url('room') }}">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">Kamar Tersedia</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $kamarTersedia }}</h3>
                                    <small class="text-success text-nowrap fw-semibold">Kamar</small>
                                </div>
                            </div>
                        </div>

                        {{--  Tampilan User Terisi  --}}
                        <div class="col-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                                class="rounded">
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="{{ url('verification') }}">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">User Aktif</span>
                                    <h3 class="card-title mb-2">{{ $userAktif }}</h3>
                                    <small class="text-success text-nowrap fw-semibold">Orang</small>
                                </div>
                            </div>
                        </div>


                        {{--  Tampilan Token Non-Aktif  --}}
                        <div class="col-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="{{ url('token') }}">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">Token Non-Aktif</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $tokenNonAktif }}</h3>
                                    <small class="text-success text-nowrap fw-semibold">Token</small>
                                </div>
                            </div>
                        </div>

                        {{--  Tampilan Token Aktif  --}}
                        <div class="col-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                                class="rounded">
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="{{ url('token') }}">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">Token Aktif</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $tokenAktif }}</h3>
                                    <small class="text-success text-nowrap fw-semibold">Token</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endrole

            @role('User')

                {{--  Tampilan Harga Sewa  --}}
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                                style="position: relative;">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Harga Sewa</h5>
                                        <span class="badge bg-label-secondary rounded-pill">{{ $namaKamar }}</span>
                                    </div>
                                    <div class="mt-sm-auto">

                                        <h3 class="mb-0">{{ $hargaSewa }}</h3>
                                        <small class="text-success text-nowrap fw-semibold">/bulan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  Tampilan Data Tagihan  --}}
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                                style="position: relative;">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Data Tagihan</h5>
                                        <span class="badge bg-label-secondary rounded-pill">{{ $namaKamar }}</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <small class="text-success text-nowrap fw-semibold">Total</small>
                                        <h3 class="mb-0">{{ $dataTagihan }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-12">
                    <div class="row">

                        {{--  Tampilan Status Aktivasi User  --}}
                        <div class="col-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                                class="rounded">
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Status Aktivasi User</span>
                                    <small class="text-success fw-semibold">{{ $namaUser }}</small>
                                    <h3 class="card-title mb-2">{{ $aktifUser }}</h3>
                                </div>
                            </div>
                        </div>

                        {{--  Tampilan Sisa Tempo  --}}
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">Sisa Tempo <span class="badge bg-label-danger rounded-pill">{{ $tempoSewa }}</span></span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $sisaTempo }}</h3>
                                    <small class="text-success text-nowrap fw-semibold">*dari sekarang</small>
                                </div>
                            </div>
                        </div>

                        {{--  Tampilan Lama Sewa  --}}
                        <div class="col-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                                class="rounded">
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Lama Sewa</span>
                                    <h3 class="card-title mb-2">{{ $lamaSewa }}</h3>
                                    <small class="text-success fw-semibold">Bulan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </div>
@push('script')
    @include('components.scripts.sweetalert')
    @include($script)
  @endpush
@endsection
