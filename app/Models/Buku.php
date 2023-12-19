<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use App\Models\Kategori; // Add this line to import the Kategori class
use App\Models\Rating;
use App\Models\Favorite;

class Buku extends Model

{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = [
        'judul',
        'penulis',
        'harga',
        'tgl_terbit',
        'filename',
        'filepath'
    ];
    protected $dates =['tgl_terbit'];
    public function galeri(){
        return $this->hasMany(Gallery::class);
    }
    public function photos(){
        return $this->hasMany('App\Buku','id_buku','id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    // Buku.php

    public function kategoris()
    {
        return $this->hasMany(Kategori::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}



