<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Tampilkan semua produk.
     */

    public function index()
    {
        $produk = Produk::latest()->paginate(10);
        $kategori = Kategori::all(); // ambil semua kategori
        return view('admin.produk.index', compact('produk', 'kategori'));
    }


    /**
     * Form tambah produk.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.produk.create', compact('kategori'));
    }


    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'stock' => 'required|integer|min:0',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $data = $request->only(['nama','harga','deskripsi','stock','kategori_id']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('', $filename, 'public'); // simpan di storage/app/public
            $data['foto'] = $filename;
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success','Produk berhasil ditambahkan.');
    }


    /**
     * Tampilkan detail produk (opsional, jarang dipakai admin).
     */
    public function show(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    /**
     * Form edit produk.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    /**
     * Update produk.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;
        $produk->stock = $request->stock;
        $produk->kategori_id = $request->kategori_id;

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($produk->foto && file_exists(storage_path('app/public/'.$produk->foto))) {
                unlink(storage_path('app/public/'.$produk->foto));
            }

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('', $filename, 'public'); // disk 'public' yang sudah kita cek
                $produk->foto = $filename;
            }
        }

        $produk->save();

        return redirect()->route('admin.produk.index')->with('success','Produk berhasil diupdate.');
    }


    /**
     * Hapus produk.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto && file_exists(public_path('storage/'.$produk->foto))) {
            unlink(public_path('storage/'.$produk->foto));
        }


        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
