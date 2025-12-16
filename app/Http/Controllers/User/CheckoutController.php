<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (session()->has('checkout_now')) {
            session()->put('cart', session('checkout_now'));
            session()->forget('checkout_now');
        }

        $cart = session('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('user.dashboard');
        }

        return view('user.checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session('checkout_now') ?? session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong');
        }

        DB::transaction(function () use ($request, $cart) {

            $total = collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']);

            $order = Order::create([
                'user_id' => auth()->id(),
                'total'   => $total,
                'status'  => 'selesai',
                'metode_pembayaran' => $request->metode_pembayaran,
                'uang_dibayar' => $request->metode_pembayaran === 'Cash'
                    ? $request->uang_dibayar
                    : null,
                'kembalian' => $request->metode_pembayaran === 'Cash'
                    ? $request->kembalian
                    : null,
            ]);

            foreach ($cart as $id => $item) {
                OrderDetail::create([
                    'order_id'     => $order->id,
                    'produk_id'    => $id,
                    'nama_produk'  => $item['nama'],
                    'qty'          => $item['qty'],
                    'harga_satuan' => $item['harga'],
                    'subtotal'     => $item['harga'] * $item['qty'],
                ]);

                Produk::where('id', $id)->decrement('stock', $item['qty']);
            }

            session()->forget(['cart', 'checkout_now']);
        });

        return redirect()->route('user.riwayat');
    }


    public function buyNow($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->stock <= 0) {
            return back()->with('error', 'Stok produk habis');
        }

        // PAKET BUY NOW (FORMAT SAMA KAYA CART)
        session()->put('checkout_now', [
            $produk->id => [
                'id' => $produk->id,
                'nama' => $produk->nama,
                'harga' => $produk->harga,
                'qty' => 1,
                'foto' => $produk->foto
            ]
        ]);

        return redirect()->route('user.checkout');
    }
}
