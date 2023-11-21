<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Gallery;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_buku = Buku::paginate(5);
        $jumlahData = Buku::count(); // Mendapatkan jumlah data
        $totalHarga = Buku::sum('harga');

        return view('dashboard', compact('data_buku', 'jumlahData','totalHarga'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('buku.create');
    }
    public function store(Request $request){
            $this->validate($request,[
                'judul'  => 'required|string',
                'penulis'   => 'required|string|max:30',
                'harga'  => 'required|numeric',
                'tgl_terbit' => 'required|date'
    
        ]);

        $fileName = time().'.'.$request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

        Image::make(storage_path('app/public/uploads/'.$fileName))
        ->fit(240, 320) 
        ->save();

        DB::beginTransaction();
        
        try {
            //code...
            $buku =Buku::create([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

        try {
            //code...
            if ($request->file('gallery')) {
                foreach($request->file('gallery') as $key => $file) {
                    $fileName = time().'_'.$file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public');
    
                    $gallery = Gallery::create([
                        'nama_galeri'   => $fileName,
                        'path'          => '/storage/' . $filePath,
                        'foto'          => $fileName,
                        'buku_id'       => $buku->id
                    ]);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

        DB::commit();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Simpan');


    }

    //edit
    public function edit($id){
        $data_buku= Buku::find($id);
        return view('buku.edit', compact('data_buku'));
    }
    //update
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        if ($request->file('thumbnail')) {
            $request->validate([
                'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $fileName = time().'.'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
    
            Image::make(storage_path('app/public/uploads/'.$fileName))
            ->fit(240, 320) 
            ->save();
    
            $buku->update([
                'judul' => $request->nama,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath
            ]);
        }
        
        if ($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                    'buku_id'       => $id
                ]);
            }
        }

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Edit');
    }

    //destroy
    public function destroy($id){
        $data_buku = Buku::find($id);
        $data_buku->delete();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Hapus');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul','like','%'.$cari.'%')->orwhere('penulis','like','%'.$cari.'%') 
            ->paginate($batas);
        $totalbuku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $total = Buku::sum('harga');

        return view('buku.search', compact('data_buku', 'no', 'total', 'totalbuku','cari'));
    }


     public function __construct() {
        $this->middleware('auth');// Memaksa autentikasi pengguna sebelum 
        //mengakses tindakan dalam controller ini
    }

    public function deleteGallery($id)
    {
        $gallery = Gallery::find($id);
        Storage::delete('public/'.$gallery->path);
        $gallery->delete();
        return redirect()->back()->with('pesan', 'Foto Berhasil di Hapus');
    }

    public function showList(){
        $data_buku = Buku::all();
        return view('buku.list_buku', compact('data_buku'));
    }


    public function galBuku($id){
        $data_buku= Buku::find($id);
        return view('buku.galbuku', compact('data_buku'));
    }

    /**
     * Remove the specified resource from storage.
     */
    
}
