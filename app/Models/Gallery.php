<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Buku;

class Gallery extends Model
{
    protected $table = 'galeri';
    protected $fillable = [
        'nama_galeri',
        'path',
        'galeri_seo',
        'keterangan',
        'foto',
        'buku_id'
    ];
    public function buku(): BelongsTo {
        return $this->belongsTo(Buku::class);
    }
    use HasFactory;
}
