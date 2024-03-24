@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')

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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="">Profile Details</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5 class="fw-bold">Status Pembayaran Paket: <span
                                        class="badge {{ $status == 'success' ? 'bg-success' : 'bg-secondary' }}">{{ $status }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('backoffice/assets/img/avatars/admin.png') }}" alt="user-avatar"
                                class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                        </div>


                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <form id="formAccountSettings" action="{{ route('profile.update', $admin->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="sekolah_id" value="{{ $sekolah->id }}">
                            <input type="hidden" name="product_id" value="{{ $admin->product->id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">Sekolah</label>
                                    <input class="form-control" type="text" id="sekolah" name="sekolah"
                                        value="{{ $sekolah->nama_sekolah }}" readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Produk Paket</label>
                                    <input class="form-control" type="text" id="nama" name="product"
                                        value="{{ $admin->product->nama_product }}" readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" id="username" name="name"
                                        value="{{ $admin->name }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value={{ $admin->email }} readonly>
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
                            data-bs-target="#hapusModal_{{ $admin->id }}">
                            <i class="bx bx-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus Modal -->
    <div class="modal fade" id="hapusModal_{{ $admin->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.destroy', $admin->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="row">
                            <div class="align-items-center text-center">
                                <i class="bx bx-trash text-danger mb-1"
                                    style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                <p class="text-center"><strong>Menghapus Akun<br>
                                        {{ $admin->name }} | {{ $admin->email }}</strong><br> apakah anda yakin ingin
                                    menghapus data ini?
                                </p>
                            </div>
                            <div class="align-items-center text-left">
                                <label for="nama_lengkap">Ketik :
                                    {{ $admin->name }}</label>
                                <input type="text" id="name" class="form-control" name="name" />
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

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
