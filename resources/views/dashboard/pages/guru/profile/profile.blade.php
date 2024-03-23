@extends('dashboard.layouts.guru')
@section('title', 'Profile Akun - Sycma Attendance')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan Akun /</span> Akun Profil</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil di Update!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal di Update!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('backoffice/assets/img/avatars/admin.png') }}" alt="user-avatar"
                                class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn bg-secondary  text-muted me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah Foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden=""
                                        accept="image/png, image/jpeg" disabled>
                                </label>
                                <button type="button" disabled class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <form id="formAccountSettings" action="{{ route('profile-guru.update', $guru->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="sekolah_id" value="{{ $sekolah->id }}">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="firstName" class="form-label">Sekolah</label>
                                    <input class="form-control" type="text" id="sekolah" name="sekolah"
                                        value="{{ $sekolah->nama_sekolah }}" readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="username" name="nama_lengkap"
                                        value="{{ $guru->nama_lengkap }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value={{ $guru->email }} readonly>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Hapus Akun</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Apakah Kamu Yakin Untuk Menghapus Akun ini? </h6>
                                <p class="mb-0">Sekali Kamu Hapus Akun ini, Maka Tidak akan kembali lagi. Mohon
                                    Pertimbangkan
                                    Dengan Matang.
                                </p>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkboxAkun" name="accountActivation"
                                id="accountActivation">
                            <label class="form-check-label" for="accountActivation">Saya yakin untuk menghapus akun
                                ini.</label>
                        </div>
                        <button disabled type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                            data-bs-target="#hapusModal_{{ $guru->id }}">
                            <i class="bx bx-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus Modal -->
    <div class="modal fade" id="hapusModal_{{ $guru->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile-guru.destroy', $guru->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="row">
                            <div class="align-items-center text-center">
                                <i class="bx bx-trash text-danger mb-1"
                                    style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                <p class="text-center"><strong>Menghapus Akun<br>
                                        {{ $guru->nama_lengkap }} | {{ $guru->email }}</strong><br> apakah anda yakin
                                    ingin
                                    menghapus data ini?
                                </p>
                            </div>
                            <div class="align-items-center text-left">
                                <label for="nama_lengkap">Ketik :
                                    {{ $guru->nama_lengkap }}</label>
                                <input type="text" id="name" class="form-control" name="nama_lengkap" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger">Hapus!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#checkboxAkun').change(function() {
                if (this.checked) {
                    $('.btn-danger').removeAttr('disabled');
                } else {
                    $('.btn-danger').attr('disabled', 'disabled');
                }
            });
        });
    </script>
@endsection
