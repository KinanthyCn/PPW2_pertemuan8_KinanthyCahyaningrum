<?php

namespace App\Http\Controllers;
use App\Models\Kategori;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // KategoriController.php

    // Middleware untuk memastikan hanya admin yang dapat mengakses
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Buat middleware 'admin' jika belum ada
    }

    // Menampilkan daftar kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    // Menambah kategori baru
    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|unique:kategori,nama',
        ]);

        Kategori::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kategori.index')->with('pesan', 'Kategori berhasil ditambahkan.');
    }

    // Mengedit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|unique:kategori,nama,' . $id,
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kategori.index')->with('pesan', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('pesan', 'Kategori berhasil dihapus.');
    }

    // Menampilkan daftar buku berdasarkan kategori tertentu
    public function showBukuByKategori($kategoriId)
    {
        $kategori = Kategori::findOrFail($kategoriId);
        $bukus = $kategori->bukus()->paginate(10);

        return view('kategori.show_buku', compact('kategori', 'bukus'));
    }
}
