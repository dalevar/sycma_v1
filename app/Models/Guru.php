<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Guru extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    protected $table = 'guru';
    protected $guarded = ['id'];

    protected $fillable = [
        'nama_lengkap',
        'sekolah_id',
        'email',
        'jenis_kelamin',
        'no_hp',
        'nip',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
