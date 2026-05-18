<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $fiksi = Kategori::where('nama_kategori', 'Fiksi')->first();
        $sains = Kategori::where('nama_kategori', 'Sains')->first();
        $selfDev = Kategori::where('nama_kategori', 'Self Dev')->first();

        Books::create([
            'judul' => 'Filosofi Teras',
            'penulis' => 'Henry Manampiring',
            'penerbit' => 'Kompas',
            'harga' => 98000,
            'stok' => 15,
            'deskripsi'=> 'Filosofi Teras adalah sebuah buku pengantar filsafat Stoa yang dibuat khusus sebagai panduan moral anak muda. Buku ini ditulis untuk menjawab masalah tentang tingkat kekhawatiran yang cukup tinggi dalam skala nasional, terutama yang dialami oleh anak muda.',
            'kategori_id' => $selfDev->id,
            'sampul' => null,
        ]);

        Books::create([
            'judul' => 'Bumi',
            'penulis' => 'Tere Liye',
            'penerbit' => 'Gramedia',
            'harga' => 105000,
            'stok' => 40,
            'deskripsi'=> 'Namaku Raib, usiaku 15 tahun, kelas sepuluh. Aku anak perempuan seperti kalian, adik-adik kalian, tetangga kalian. Aku punya dua kucing, namanya si Putih dan si Hitam. Mama dan papaku menyenangkan. Guru-guru di sekolahku seru. Teman-temanku baik dan kompak',
            'kategori_id' => $fiksi->id,
            'sampul' => null,
        ]);

        Books::create([
            'judul' => 'Sapiens',
            'penulis' => 'Yuval Noah Harari',
            'penerbit' => 'KPG',
            'harga' => 150000,
            'stok' => 5,
            'deskripsi'=> 'Sebuah buku sejarah umat manusia dari Zaman Batu sampai abad ke-21. Harari menceritakan riwayat evolusi sapiens yang penuh dengan keajaiban teknologi, sains, dan revolusi kognitif.',
            'kategori_id' => $sains->id,
            'sampul' => null,
        ]);
    }
}
