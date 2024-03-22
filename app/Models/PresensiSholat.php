<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSholat extends Model
{
    use HasFactory;

    protected $table = 'presensi_sholat';
    // protected $guarded = ['id'];
    protected $fillable = [
        'jadwal_sholat_id',
        'sekolah_id',
        'siswa_id',
        'no_kartu',
        'tanggal',
        'waktu_sholat',
        'jam_masuk',
        'jam_sholat',
        'jam_keluar',
        'jenis_sholat',
        'status'
    ];

    public function jadwalSholat()
    {
        return $this->belongsTo(JadwalSholat::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
