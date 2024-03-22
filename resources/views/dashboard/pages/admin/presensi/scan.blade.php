@extends('dashboard.layouts.main')
@section('title', 'Scan Kartu - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0 card-header text-center">Scan Kartu</h4>

        <div class="text-center">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses! Data berhasil ditambahkan</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses! Data berhasil diupdate</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('delete'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses! Data berhasil dihapus</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div id="baca-kartu">

            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $('#baca-kartu').load('{{ route('baca-kartu.index') }}')
            }, 5000);
        });
    </script>

@endsection
