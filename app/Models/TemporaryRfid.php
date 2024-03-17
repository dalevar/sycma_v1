<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryRfid extends Model
{
    use HasFactory;

    protected $table = 'rfid_cards';
    public $timestamps = false;
    protected $fillable = ['no_kartu'];
}
