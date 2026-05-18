<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "kategori";
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    public function books()
    {
        return $this->hasMany(Books::class, 'kategori_id');
    }
}
