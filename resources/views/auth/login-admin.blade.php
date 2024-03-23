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
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Sycma! 👋</h4>
                        <p class="mb-4">Login menggunakan akun admin untuk memulai</p>
                        <form id="formAuthentication" class="mb-3" action="{{ route('login-admin-proses') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email or username" autofocus />
                                @error('email')
                                    <small class="text-danger invalid-feedback d-block">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="auth-forgot-password-basic.html">
                                        <small>Lupa Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password')
                                        <small class="text-danger invalid-feedback d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>
                        <p class="text-left mt-2">
                            <span>Login sebagai guru ?</span>
                            <a href="{{ route('login') }}">
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
                            <span>Belum punya akun ?</span>
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
