@extends('dashboard.layouts.guru')
@section('title', 'Siswa - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card mb-2" style="background: #fbfbfb">
                <h4 class="font-weight-bold py-3 mb-0 card-header text-dark">Siswa</h4>
                <div class="col-lg-12 mb-2 order-0">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <span class="fw-semibold d-block">Total Data Siswa</span>
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                                alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h3 class="card-title mb-2 me-2">215</h3>
                                        <small class="text-secondary fw-light text-middle mt-2">
                                            Siswa</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <span class="fw-semibold d-block">Total Siswa Laki-Laki</span>
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                                alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h3 class="card-title mb-2 me-2">215</h3>
                                        <small class="text-secondary fw-light text-middle mt-2">
                                            Siswa</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <span class="fw-semibold d-block">Total Siswa Perempuan</span>
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                                alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h3 class="card-title mb-2 me-2">215</h3>
                                        <small class="text-secondary fw-light text-middle mt-2">
                                            Siswa</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <h6 class="card-header fw-bold">Data Siswa</h6>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-md-6">
                            <div class="nav-item d-flex align-items-center form-control">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                                    aria-label="Nama Siswa">
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                data-bs-target="#tambahModal">
                                <i class="bx bx-plus"></i> Siswa
                            </button>
                        </div>
                    </div>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID Kartu</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. HP (Orang Tua)</th>
                                    <th>NIS</th>
                                    <th width='11%'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Dale</td>
                                    <td>XII</td>
                                    <td>RPL</td>
                                    <td>Laki-Laki</td>
                                    <td>081234567890</td>
                                    <td>1234567890</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal_">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal_">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal
        fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nameBasic" class="form-label">Sekolah</label>
                            <input type="text" id="nameBasic" class="form-control" name="sekolah"
                                value="{{ $sekolah->nama_sekolah ?? '' }}" readonly />
                            <!-- Tambahkan input tersembunyi untuk menyimpan 'sekolah_id' -->
                            <input type="hidden" name="sekolah_id" value="{{ $sekolah->id ?? '' }}" />
                            @error('sekolah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nameBasic" class="form-label">Nama</label>
                                    <input type="text" id="nameBasic" class="form-control" name="nama_lengkap" />
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIS</label>
                                    <input type="text" id="nip" class="form-control" name="nip" />
                                    @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="noHp" class="form-label">No. HP (Orang Tua)</label>
                            <input type="text" id="noHp" class="form-control" name="no_hp" />
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <select class="form-select" id="jurusan" name="jurusan">
                                        <option selected disabled>Pilih Jurusan</option>
                                        @foreach ($jurusan as $j => $value)
                                            <option value="{{ $value->id }}">{{ $value->jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('jurusan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="col mb-3">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select disabled class="form-select" id="kelas" name="kelas">
                                        <option selected disabled>Pilih Kelas</option>
                                        @foreach ($kelas as $k => $value)
                                            <option value="{{ $k }}" class="kelas-option"
                                                data-jurusan="{{ $value->jurusan_id }}">
                                                {{ $value->kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis
                                Kelamin</label>
                            <select class="form-select" id="jenisKelamin" name="jenis_kelamin">
                                <option selected disabled>Pilih Jenis Kelamin
                                </option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#jurusan').change(function() {
                let selectedJurusan = $(this).val();

                // Disable the "Kelas" select if "Pilih Jurusan" is selected
                $('#kelas').prop('disabled', selectedJurusan == 0);

                if (selectedJurusan == 0) {
                    // Clear the selected value when disabling the "Kelas" select
                    $('#kelas').val(null);
                    return;
                }

                // Hide all options
                $('#kelas option').hide();

                // Show only options related to the selected jurusan
                $('.kelas-option[data-jurusan="' + selectedJurusan + '"]').show();
            });
        });
    </script>



@endsection
