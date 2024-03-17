@if (empty($no_kartu))
    <h3 class="fw-bold">Absen : {{ $mode }} </h3>
    <h3>Silahkan Tempelkan kartu RFID Anda</h3>

    <img src="{{ asset('backoffice/assets/img/illustrations/rfid.png') }}" alt="RFID" style="width: 200px;">
    <br><br>
    <img src="{{ asset('backoffice/assets/img/illustrations/animasi2.gif') }}">
@else
    <?php
    // Cek nomor kartu RFID apakah terdaftar di tabel siswa
    $siswa = \App\Models\Siswa::where('no_kartu', $no_kartu)->first();
    $jumlah_data = $siswa ? 1 : 0;
    
    if ($jumlah_data == 0) {
        echo '<h3>Kartu RFID tidak terdaftar</h3>';
    } else {
        // Mengambil nama siswa
        $siswaId = $siswa->id;
        $nama = $siswa->nama_lengkap;
    
        // Baca tanggal dan jam
        $tanggal = now()->format('Y-m-d');
        $jam = now()->format('H:i:s');
    
        // Cek apakah sudah absen hari ini
        $cek_absen = \App\Models\PresensiSholat::where('no_kartu', $no_kartu)->where('tanggal', $tanggal)->first();
        $jumlah_absen = $cek_absen ? 1 : 0;
        $jadwal_sholat_id = \App\Models\JadwalSholat::whereDate('tanggal', $tanggal)->value('id');
        $waktu_sholat = \App\Models\JadwalSholat::where('id', $jadwal_sholat_id)->value('waktu_sholat');
        $waktu_bersiap = date('H:i:s', strtotime('-10 minutes', strtotime($waktu_sholat)));
        $waktu_selesai = date('H:i:s', strtotime('+10 minutes', strtotime($waktu_sholat)));
    
        // Cek apakah sudah masuk waktu sholat
        if ($jam == $waktu_bersiap) {
            $status = 'Sholat';
        } elseif ($jam >= $waktu_bersiap && $jam <= $waktu_selesai) {
            $status = 'Sholat';
        } elseif ($jam >= $waktu_selesai) {
            $status = 'Terlambat';
        } else {
            $status = 'Tidak Sholat';
        }
    
        if ($jumlah_absen <= 0 && $mode_absen == 1) {
            echo "<h3>Selamat Menunaikan Ibadah Sholat <br> $nama </h3>";
            \App\Models\PresensiSholat::create([
                'jadwal_sholat_id' => $jadwal_sholat_id,
                'sekolah_id' => $sekolah->id,
                'siswa_id' => $siswaId,
                'no_kartu' => $no_kartu,
                'tanggal' => $tanggal,
                'waktu_sholat' => $waktu_sholat,
                'jam_sholat' => $jam,
                'jenis_sholat' => 'Dzuhur',
                'status' => $status,
            ]);
        } elseif ($mode_absen == 1) {
            $cek_absen->update(['jam_sholat' => $jam]);
        }
    }
    
    // Hapus data temporary rfid
    \App\Models\TemporaryRfid::truncate();
    ?>
@endif
