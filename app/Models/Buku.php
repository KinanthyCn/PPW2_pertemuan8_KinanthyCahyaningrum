<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;

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
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }


}
