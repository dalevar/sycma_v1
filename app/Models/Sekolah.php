<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sekolah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'nama_sekolah',
        'logo_sekolah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
