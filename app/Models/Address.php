<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'nama_penerima',
        'telepon',
        'alamat_lengkap',
        'kota',
        'kode_pos',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
