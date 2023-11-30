<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class PublicController extends Controller
{
    public function showList(){
        $data_buku = Buku::all();
        return view('buku.list_buku', compact('data_buku'));
    }


    public function galBuku($id){
        $data_buku= Buku::find($id);
        return view('buku.galbuku', compact('data_buku'));
    }
}
