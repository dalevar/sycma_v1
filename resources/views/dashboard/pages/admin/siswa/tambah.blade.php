@extends('dashboard.layouts.main')
@section('title', 'Tambah Siswa - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card mb-4">
                <h6 class="card-header fw-bold">Tambah Data Siswa</h6>
                <div class="card-body">
                   
                </div>
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

        $(document).ready(function() {
            setInterval(function() {
                $('#no_kartu').load('{{ route('no-kartu.index') }}')
            }, 1000);
        });
    </script>
@endsection
