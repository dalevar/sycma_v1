@extends('dashboard.layouts.main')
@section('title', 'Siswa - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <h4 class="font-weight-bold py-3 mb-0 card-header text-dark">Siswa {{ $sekolah->nama_sekolah }}</h4>
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
                                    <h3 class="card-title mb-2 me-2">{{ $totalDataSiswa }}</h3>
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
                                    <h3 class="card-title mb-2 me-2">{{ $totalDataSiswaLaki }}</h3>
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
                                    <h3 class="card-title mb-2 me-2">{{ $totalDataSiswaPerempuan }}</h3>
                                    <small class="text-secondary fw-light text-middle mt-2">
                                        Siswa</small>
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
                        <div class="col-md-12 text-start">
                            {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#tambahModal">
                                <i class="bx bx-plus"></i> Import Excel
                            </button> --}}
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
                        <table class="table table-bordered table-hover mb-0"
                            id={{ $siswa->isEmpty() ? '' : 'siswaTable' }}>
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
                                @if ($siswa->isEmpty())
                                    <tr>
                                        <td colspan="8" class="h3 text-muted text-center">Data Siswa Kosong, Tambahkan
                                            Data!</td>
                                    </tr>
                                @else
                                    @foreach ($siswa as $s)
                                        <tr>
                                            <td>{{ $s->no_kartu }}</td>
                                            <td>{{ $s->nama_lengkap }}</td>
                                            <td>{{ $s->kelas->kelas }}</td>
                                            <td>{{ $s->jurusan->jurusan }}</td>
                                            <td>
                                                @if ($s->jenis_kelamin == 'L')
                                                    Laki-Laki
                                                @else
                                                    Perempuan
                                                @endif
                                            </td>

                                            <td>{{ $s->no_hp }}</td>
                                            <td>{{ $s->nis }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm mb-2"
                                                    data-bs-toggle="modal" data-bs-target="#editModal_{{ $s->id }}">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusModal_{{ $s->id }}">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </td>
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

    <!-- Tambah Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nameBasic" class="form-label">Sekolah</label>
                            <input type="text" id="nameBasic" class="form-control" name="sekolah_id"
                                value="{{ $sekolah->nama_sekolah }}" readonly />
                            <input type="hidden" id="nameBasic" class="form-control" name="sekolah_id"
                                value="{{ $sekolah->id ?? '' }}" readonly />
                            @error('sekolah_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3" id="no_kartu">

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nameBasic" class="form-label">Nama</label>
                                    <input type="text" id="nameBasic" class="form-control" name="nama_lengkap" />
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIS</label>
                                    <input type="text" id="nip" class="form-control" name="nis" />
                                    @error('nis')
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
                                    <select class="form-select" id="jurusan" name="jurusan_id">
                                        <option selected disabled>Pilih Jurusan</option>
                                        @foreach ($jurusan as $value)
                                            <option value="{{ $value->id }}">{{ $value->jurusan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jurusan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col mb-3">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas" name="kelas_id">
                                        <option selected disabled>Pilih Kelas</option>
                                        @foreach ($kelas as $value)
                                            <option value="{{ $value->id }}" class="kelas-option"
                                                data-jurusan="{{ $value->jurusan_id }}">
                                                {{ $value->kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenisKelamin" name="jenis_kelamin">
                                <option selected disabled>Pilih Jenis Kelamin</option>
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

    <!-- Edit Modal -->
    @foreach ($siswa as $item)
        <div class="modal fade" id="editModal_{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('siswa.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="sekolah" class="form-label">Sekolah</label>
                                <input type="text" id="sekolah" class="form-control" name="sekolah"
                                    value="{{ $sekolah->nama_sekolah ?? '' }}" readonly />
                                <input type="hidden" name="sekolah_id" value="{{ $sekolah->id ?? '' }}" />
                                @error('sekolah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_kartu" class="form-label">ID Kartu</label>
                                <input type="text" id="no_kartu" class="form-control" name="no_kartu"
                                    value="{{ $item->no_kartu }}" readonly />
                                @error('no_kartu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama</label>
                                        <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap"
                                            value="{{ $item->nama_lengkap }}" />
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIS</label>
                                        <input type="text" id="nip" class="form-control" name="nis"
                                            value="{{ $item->nis }}" />
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
                                <input type="text" id="no_hp" class="form-control" name="no_hp"
                                    value="{{ $item->no_hp }}" />
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
                                        <select class="form-select" id="jurusan" name="jurusan_id">
                                            <option disabled>Pilih Jurusan</option>
                                            @foreach ($jurusan as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $item->jurusan == $value->jurusan ? 'selected' : '' }}>
                                                    {{ $value->jurusan }}</option>
                                            @endforeach
                                        </select>
                                        @error('jurusan_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col mb-3">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select class="form-select" id="kelas" name="kelas_id">
                                            <option disabled>Pilih Kelas</option>
                                            @foreach ($kelas as $value)
                                                <option value="{{ $value->id }}" class="kelas-option"
                                                    data-jurusan="{{ $value->jurusan_id }}"
                                                    {{ $item->kelas == $value->kelas ? 'selected' : '' }}>
                                                    {{ $value->kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option disabled>Pilih Jenis Kelamin</option>
                                    <option value="L" {{ $item->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="P" {{ $item->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Hapus Modal -->
    @foreach ($siswa as $item)
        <div class="modal fade" id="hapusModal_{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="row">
                                <div class="align-items-center text-center">
                                    <i class="bx bx-trash text-danger mb-1"
                                        style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                    <p class="text-center"><strong>Menghapus data siswa
                                            {{ $item->nama_lengkap }}</strong><br>anda yakin ingin menghapus data ini?
                                    </p>
                                </div>
                                <div class="align-items-center text-left">
                                    <label for="nama_lengkap" class="form-label">Ketik :
                                        {{ $item->nama_lengkap }}</label>
                                    <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" />
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
    @endforeach

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

        $(document).ready(function() {
            setInterval(function() {
                $('#no_kartu').load('{{ route('no-kartu.index') }}')
            }, 1000);
        });

        $(document).ready(function() {
            // Initialize DataTable with your table ID
            $('#siswaTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.3/i18n/id.json',
                    paginate: {
                        previous: "‹", // Arrow left symbol
                        next: "›", // Arrow right symbol
                        first: "«", // Double arrow left symbol
                        last: "»" // Double arrow right symbol
                    }
                },
                "paging": true, // Enable pagination
                "searching": true, // Enable search/filtering
            });
        });
    </script>
@endsection
