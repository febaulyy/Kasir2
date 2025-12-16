<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class CartController extends Controller
{
    // TAMPILKAN KERANJANG
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }

    // TAMBAH KE KERANJANG
    public function store($id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        // kalau sudah ada di cart
        if (isset($cart[$id])) {

            // CEK STOK
            if ($cart[$id]['qty'] >= $produk->stock) {
                return back()->with('error', 'Stok produk tidak mencukupi');
            }

            $cart[$id]['qty']++;

        } else {

            // kalau stok 0, ga boleh masuk cart
            if ($produk->stock <= 0) {
                return back()->with('error', 'Produk sedang habis');
            }

            $cart[$id] = [
                'id'    => $produk->id,
                'nama'  => $produk->nama,
                'harga' => $produk->harga,
                'foto'  => $produk->foto,
                'qty'   => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }


    // UPDATE PLUS / MINUS
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back();
        }

        $produk = Produk::find($id);
        if (!$produk) {
            return back();
        }

        if ($request->action === 'plus') {

            if ($cart[$id]['qty'] >= $produk->stock) {
                return back()->with(
                    'error',
                    "Stok {$produk->nama} tersisa {$produk->stock}, tidak bisa ditambah lagi."
                );
            }

            $cart[$id]['qty']++;
        }

        if ($request->action === 'minus' && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
        }

        session()->put('cart', $cart);
        return back();
    }


    // HAPUS ITEM
    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}
