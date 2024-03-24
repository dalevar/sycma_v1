<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'kode_product',
        'nama_product',
        'category_id',
        'deskripsi',
        'harga',
        'diskon',
        'pajak',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    // mengambil data produk dengan kategori 'Software'
    public function scopeSoftware($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->where('nama_category', 'Software');
        });
    }

    //mengambil hanya nama produk untuk kategori 'Software'
    public function scopeSoftwareProducts($query)
    {
        return $query->software()->pluck('nama_product');
    }
}
