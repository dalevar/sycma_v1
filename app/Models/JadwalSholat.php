<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalSholat extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sholat';
    protected $guarded = ['id'];

    protected $fillable = [
        'tanggal', 'waktu_sholat', 'jenis_sholat'
    ];

    public function presensiSholat()
    {
        return $this->hasMany(PresensiSholat::class);
    }
}
