<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'produk_id',
        'nama_produk',
        'foto_produk',
        'harga_satuan',
        'qty',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function produk() 
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

}
