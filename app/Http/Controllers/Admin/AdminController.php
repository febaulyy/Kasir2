<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Order;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count(); // total produk
        
        // Pesanan dengan status pending (belum diproses)
        $totalPesanan = Order::count();

        // Total transaksi hari ini (status sukses/selesai)
        $transaksiHariIni = Order::whereDate('created_at', now()->toDateString())
            ->sum('total');

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'transaksiHariIni'
        ));
    }

    public function pesanan(Request $request)
    {
        $filter = $request->filter;

        $query = \App\Models\Order::with(['user', 'details.produk']);

        if ($filter == 'today') {
            $query->whereDate('created_at', today());
        } elseif ($filter == 'yesterday') {
            $query->whereDate('created_at', today()->subDay());
        } elseif ($filter == 'date' && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->latest()->get();

        return view('admin.pesanan.index', compact('orders', 'filter'));
    }

}
