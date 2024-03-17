<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $gruarded = ['id'];
    protected $fillable = ['jurusan_id', 'kelas', 'sekolah_id'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
