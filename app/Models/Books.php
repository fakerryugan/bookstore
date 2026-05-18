<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = "books";
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'harga',
        'stok',
        'deskripsi',
        'kategori_id',
        'sampul',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'book_id');
    }
}
