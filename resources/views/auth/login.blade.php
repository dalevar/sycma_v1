@extends('auth.layouts.main')

@section('title', 'Masuk - Sycma Attendance')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('import/assets/img/sycma_logo.png') }}" alt="" width="100">
                                </span>
                            </a>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ Session::get('success') }}
                            </div>

                            <script>
                                setTimeout(function() {
                                    $('#success-alert').fadeOut('slow');
                                }, 5000);
                            </script>
                        @elseif (Session::has('error'))
                            <div class="alert alert-danger" id="success-alert">
                                <span><b>Email Pengguna tidak terdaftar.</b>{{ Session::get('error') }}</span>
                            </div>
                            <script>
                                setTimeout(function() {
                                    $('#success-alert').fadeOut('slow');
                                }, 5000);
                            </script>
                        @endif
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Sycma! 👋</h4>
                        <p class="mb-4">Login <b>sebagai guru</b> menggunakan akun google untuk memulai</p>

                        <a href="{{ route('login.google') }}" class="btn btn-transparent d-grid w-100 border">
                            <div class="d-flex">
                                <img src="{{ asset('import/assets/img/google_logo.png') }}" alt="" width="50"
                                    class="text-center">
                                <span class="ms-2 my-3 text-center">Sign in with Google</span>
                            </div>
                        </a>

                        <p class="text-left mt-3">
                            <span>Login admin sekolah ?</span>
                            <a href="{{ route('login-admin') }}">
                                <span>Masuk disini</span>
                            </a>
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <hr class="my-0 mx-2 border-top border-1 border-dark">
                            </div>
                            <div class="mx-2">
                                Atau
                            </div>
                            <div class="flex-grow-1">
                                <hr class="my-0 mx-2 border-top border-1 border-dark">
                            </div>
                        </div>
                        <p class="text-left mt-2">
                            <span>Belum punya akun admin sekolah ?</span>
                            <a href="{{ route('register') }}">
                                Daftar disini
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
