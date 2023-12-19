<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function storeReview(Request $request, $buku_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);


        $review = new Review([
            'buku_id' => $buku_id,
            'content' => $request->content,
            'moderation_status' => 'pending',
        ]);

        $review->save();

        // Redirect atau berikan pesan sesuai kebijakan Anda
    }
}
