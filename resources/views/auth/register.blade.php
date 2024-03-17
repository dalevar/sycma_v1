@extends('auth.layouts.main')
@section('title', 'Daftar - Sycma Attendance')
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('import/assets/img/sycma_logo.png') }}" alt="" width="100">
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Mulai menggunakan Sycma 🚀</h4>
                        <p class="mb-2">Buat absensi anda lebih mudah dan efisien</p>
                        <p class="mb-4">
                            <span>Sudah punya akun admin ?</span>
                            <a href="{{ route('login-admin') }}">
                                Masuk disini
                            </a>
                        </p>
                        {{-- WIZARD VALIDATION --}}
                        <livewire:wizard-validation>

                    </div>
                </div>

                <!-- Register Card -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endsection
