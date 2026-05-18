<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Fiksi', 'deskripsi' => 'Buku imajinasi dan cerita rekaan'],
            ['nama_kategori' => 'Non-Fiksi', 'deskripsi' => 'Buku berdasarkan fakta dan realita'],
            ['nama_kategori' => 'Sains', 'deskripsi' => 'Buku pengetahuan ilmiah dan teknologi'],
            ['nama_kategori' => 'Sejarah', 'deskripsi' => 'Buku peristiwa masa lalu'],
            ['nama_kategori' => 'Self Dev', 'deskripsi' => 'Buku pengembangan diri dan motivasi'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }
    }
}
