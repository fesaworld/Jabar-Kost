@extends('layouts.master')

@section('content')
    @push('style')
        @include('components.styles.dropify')
    @endpush
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <a href="/dashboard">Home</a> / Profil
        </h5>
        <div class="card mb-4">
            <div class="card-body">
                {{--  <form action="{{ url('/userBill/' . $data->id) }}" method="POST" enctype="multipart/form-data">  --}}
                <form id="editProfilForm">
                    {{--  @csrf  --}}
                    <div class="mb-3">
                        <label class="form-label" for="userProfile">Foto Profil</label>

                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if ($data->image == null)
                                    <img src="{{ asset('assets/image/default/defaultProfil.png') }}" alt="user-avatar"
                                        class="d-block rounded mx-auto" height="200" width="200" id="profile">
                                @else
                                    <img src="{{ asset('assets/image/profil') . '/' . $data->image }}" alt="user-avatar"
                                            class="d-block rounded mx-auto" height="200" width="200" id="profile">
                                @endif
                                @if ($data->status != 'Terverifikasi')
                                    <div class="button-wrapper">
                                        <label for="userProfile" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" name="userProfile" id="userProfile" class="account-file-input" hidden=""
                                                accept="image/png, image/jpeg" disabled>
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" id="profileReset" name="profileReset" disabled>
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>

                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="userName">Nama</label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Masukkan nama anda" value="{{ $data->detailToUser->name }}" readonly >
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="userEmail">Email</label>
                        <input type="text" class="form-control" id="userEmail" name="userEmail" placeholder="Masukkan E-mail anda" value="{{ $data->detailToUser->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="userAdd">Alamat</label>
                        <lt-mirror contenteditable="false" style="display: none;">
                            <lt-highlighter contenteditable="false" style="display: none;">
                                <lt-div spellcheck="false" class="lt-highlighter__wrapper" style="width: 392.465px !important; height: 82.7778px !important; transform: none !important; transform-origin: 197.352px 42.5087px !important; zoom: 1 !important; margin-top: 30.7639px !important; margin-left: 1.11111px !important;">
                                    <lt-div class="lt-highlighter__scroll-element" style="top: 0px !important; left: 0px !important; width: 392px !important; height: 82.7778px !important;">
                                    </lt-div>
                                </lt-div>
                            </lt-highlighter>
                            <lt-div spellcheck="false" class="lt-mirror__wrapper notranslate" data-lt-scroll-top="0" data-lt-scroll-left="0" data-lt-scroll-top-scaled="0" data-lt-scroll-left-scaled="0" data-lt-scroll-top-scaled-and-zoomed="0" data-lt-scroll-left-scaled-and-zoomed="0" style="border: 1.11111px solid rgb(217, 222, 227) !important; border-radius: 6px !important; direction: ltr !important; font: 400 15px / 1.53 &quot;Public Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif !important; font-feature-settings: normal !important; font-kerning: auto !important; font-synthesis: weight style small-caps !important; hyphens: manual !important; letter-spacing: normal !important; line-break: auto !important; margin: 29.6701px 0px 0px !important; padding: 7px 14px !important; text-align: start !important; text-decoration: none solid rgb(105, 122, 141) !important; text-indent: 0px !important; text-rendering: auto !important; text-transform: none !important; transform: none !important; transform-origin: 197.352px 42.5087px !important; unicode-bidi: normal !important; white-space: pre-wrap !important; word-spacing: 0px !important; overflow-wrap: break-word !important; writing-mode: horizontal-tb !important; zoom: 1 !important; -webkit-locale: &quot;en&quot; !important; -webkit-rtl-ordering: logical !important; width: 364.483px !important; height: 68.7951px !important;">
                                <lt-div class="lt-mirror__canvas" style="margin-top: 0px !important; margin-left: 0px !important; width: 364.483px !important; height: 69px !important;">
                                </lt-div>
                            </lt-div>
                        </lt-mirror>

                        <textarea class="form-control" rows="3" data-lt-tmp-id="lt-304676" spellcheck="false" data-gramm="false" id="userAdd" name="userAdd" placeholder="Masukkan alamat anda" readonly>{{ $data->address }}</textarea>

                        <div data-lastpass-icon-root="true"
                            style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="userPhone" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control phone" id="userPhone" name="userPhone" placeholder="Masukkan nomor telepon anda" value="{{ $data->phone }}" readonly>
                        </div>
                        <div class="col mb-3">
                            <label for="userGender" class="form-label">Jenis Kelamin</label>
                            <select id="userGender" name="userGender" class="form-select" disabled>
                                    <option selected value="{{ $data->gender }}">{{ $data->gender }}</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="userStatus">Status Aktivasi</label>
                        <input type="text" class="form-control form-control-lg" id="userStatus" name="userStatus" placeholder="Masukkan status anda" value="{{ $data->status }}" readonly>
                        <div data-lastpass-icon-root="true"
                            style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                        </div>
                    </div>

                    <div class="mb-3 ">
                        <label class="form-label" for="userCard">Foto Kartu Identitas</label>
                        {{--  {{ $segment1 == 'dashboard' ? 'active' : null }}  --}}
                        {{--  asset('assets/image/default/notFound.png')   --}}
                        <input type="file" class="form-control" id="userCard" name="userCard" data-default-file="{{ $data->card_id == null ? asset('assets/image/default/notFound.png') : asset('assets/image/idCard') . '/' . $data->card_id}}">

                    </div>
                    @if ($data->status != 'Terverifikasi')
                        <div class="float-end">
                            <button type="button" class="btn btn-primary" id="btnUserSubmit" name="btnUserSubmit" disabled>Simpan Profil</button>
                            <button type="button" class="btn btn-danger" id="btnUserEdit" onclick="editProfil({{ $data->id }})">Edit Profil</button>
                        </div>
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
