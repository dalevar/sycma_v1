@extends('dashboard.layouts.guru')
@section('title', 'Guru - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="font-weight-bold py-3 mb-0 card-header text-dark">Guru {{ $sekolah->nama_sekolah }}</h4>
            <div class="col-lg-12 mb-2 order-0">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block">Total Data Guru</span>
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                            alt="chart success" class="rounded">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h3 class="card-title mb-2 me-2">{{ $totalGuru }}</h3>
                                    <small class="text-secondary fw-light text-middle mt-2">
                                        Guru</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block">Total Guru Laki-Laki</span>
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                            alt="chart success" class="rounded">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h3 class="card-title mb-2 me-2">{{ $totalGuruLaki }}</h3>
                                    <small class="text-secondary fw-light text-middle mt-2">
                                        Guru</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block">Total Guru Perempuan</span>
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                            alt="chart success" class="rounded">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h3 class="card-title mb-2 me-2">{{ $totalGuruPerempuan }}</h3>
                                    <small class="text-secondary fw-light text-middle mt-2">
                                        Guru</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <h6 class="card-header fw-bold">Data Guru</h6>
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
                <div class="table-responsive pb-4 px-4">
                    {{-- <table class="table table-bordered table-hover mb-4"> --}}
                    <table class="table table-bordered table-hover mb-4" id={{ $dataGuru->isEmpty() ? '' : 'guruTable' }}>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Handphone</th>
                                <th>Jenis Kelamin</th>
                                <th>NIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($dataGuru->isEmpty())
                                <tr>
                                    <td colspan="7" class="h3 text-muted text-center">Data Guru Kosong, Tambahkan Data!
                                    </td>
                                </tr>
                            @else
                                @foreach ($dataGuru as $g)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $g->nama_lengkap }}</td>
                                        <td>{{ $g->email }}</td>
                                        <td>{{ $g->no_hp }}</td>
                                        <td>{{ $g->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $g->nip }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with your table ID
            $('#guruTable').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search/filtering
            });
        });
    </script>


@endsection
