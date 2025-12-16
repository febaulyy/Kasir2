<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class UserController extends Controller
{
    /**
     * Halaman dashboard user.
     */
    public function dashboard(Request $request)
    {
        $query = Produk::query();

        // Filter kategori
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Pencarian produk
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $produk = $query->latest()->paginate(12);
        $kategori = Kategori::all();

        return view('user.dashboard', compact('produk', 'kategori'));
    }

    /**
     * Halaman keranjang.
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }

    /**
     * Tambah produk ke keranjang.
     */
    public function addToCart(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id'    => $produk->id,
                'nama'  => $produk->nama,
                'harga' => $produk->harga,
                'foto'  => $produk->foto,
                'qty'   => 1,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Hapus produk dari keranjang.
     */
    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Halaman riwayat user (nanti diisi oleh OrderController).
     */
    public function riwayat()
    {
        $riwayat = [];
        return view('user.riwayat', compact('riwayat'));
    }
}
