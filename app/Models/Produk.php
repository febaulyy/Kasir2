<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Nama tabel (opsional, kalau tabel sesuai konvensi 'produks' bisa dihapus)
    protected $table = 'produks';

    // Field yang bisa diisi massal
    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'stock',
        'foto',
        'kategori_id',
    ];

    // Jika ingin menambahkan accessor untuk URL foto (opsional)
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/'.$this->foto) : null;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function details() 
    {
        return $this->hasMany(OrderDetail::class);
    }


}
