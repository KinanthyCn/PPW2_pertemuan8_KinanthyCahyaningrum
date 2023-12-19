<?php

namespace App\Http\Controllers;
App\Models\Rating;
App\Models\Buku;

use Illuminate\Http\Request;

class PopulerController extends Controller
{
    public function bukuPopuler()
{
    // Ambil 10 rating tertinggi
    $topRatings = Rating::select('buku_id', DB::raw('AVG(rating) as average_rating'))
        ->groupBy('buku_id')
        ->orderByDesc('average_rating')
        ->take(10)
        ->get();

    // Ambil detail buku berdasarkan ID dari 10 rating tertinggi
    $topBooks = [];
    foreach ($topRatings as $rating) {
        $buku = Buku::find($rating->buku_id);
        if ($buku) {
            $topBooks[] = [
                'judul' => $buku->judul,
                'rating' => $rating->average_rating,
            ];
        }
    }

    // Kirim data ke halaman Buku Populer
    return view('buku_populer', ['topBooks' => $topBooks]);
}
}
