<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Buku;

class RatingController extends Controller
{
    public function ratingBuku(Request $request, $id)
    {
        $data_buku = Buku::find($id);
    
        $existingRating = Rating::where('user_id', Auth::id())
                                ->where('buku_id', $id)
                                ->first();
    
        if ($existingRating) {
            $request->validate([
                'rating' => 'required|numeric|min:1|max:5',
            ]);
    
            $existingRating->update([
                'rating' => $request->rating,
            ]);
    
            return redirect()->back()->with('pesan', 'Your rating has been updated successfully.');
        }
    
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);
    
        $newRating = new Rating([
            'buku_id' => $id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
        ]);
    
        $newRating->save();
    
        return redirect()->route('buku.galeri.buku', $id)->with('pesan', 'rating anda telah ditambahkan.');
    }
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
        return view('buku.populer', ['topBooks' => $topBooks]);
    }
}
