<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    // Menampilkan semua riwayat pesanan user
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('user.riwayat', compact('orders'));
    }

    // Download struk PDF

    public function pdf($id)
    {
        $order = Order::where('user_id', auth()->id())
                        ->where('id', $id)
                        ->with('details.produk')
                        ->firstOrFail();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('user.struk', [
            'order' => $order
        ]);

        return $pdf->download('struk-pesanan-'.$order->id.'.pdf');
    }

    // public function checkout()
    // {
    //     $cart = session('cart', []);
    //     $user = auth()->user();

    //     // 1. Buat order
    //     $order = Order::create([
    //         'user_id' => $user->id,
    //         'total' => collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']),
    //         'status' => 'success', 
    //     ]);

    //     // 2. Simpan ke order_details + kurangi stok
    //     foreach ($cart as $item) {
    //         OrderDetail::create([
    //             'order_id' => $order->id,
    //             'produk_id' => $item['id'],
    //             'nama_produk' => $item['nama'],
    //             'foto_produk' => $item['foto'],
    //             'harga_satuan' => $item['harga'],
    //             'qty' => $item['qty'],
    //             'subtotal' => $item['qty'] * $item['harga'],
    //         ]);

    //         // 🔥 Penting! Kurangi stok produk
    //         $produk = Produk::find($item['id']);

    //         if ($produk->stock < $item['qty']) {
    //             return back()->with('error', 'Stok tidak cukup untuk produk: '.$produk->nama);
    //         }

    //         $produk->stock -= $item['qty'];
    //         $produk->save();
    //     }

    //     // 3. Kosongkan keranjang
    //     session()->forget('cart');

    //     return redirect()->route('user.riwayat')->with('success', 'Pesanan berhasil!');
    // }


}
