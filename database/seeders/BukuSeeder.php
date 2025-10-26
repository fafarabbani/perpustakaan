<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukuList = [
            ['uuid' => Str::uuid(), 'kode_buku' => 'BK-2025-001', 'judul' => 'Pemrograman Laravel untuk Pemula', 'penerbit' => 'Informatika', 'dimensi' => '15x23 cm', 'jumlah_stok' => 10],
            ['uuid' => Str::uuid(), 'kode_buku' => 'BK-2025-002', 'judul' => 'Belajar Database MySQL', 'penerbit' => 'Erlangga', 'dimensi' => '14x21 cm', 'jumlah_stok' => 8],
            ['uuid' => Str::uuid(), 'kode_buku' => 'BK-2025-003', 'judul' => 'Panduan JavaScript Modern', 'penerbit' => 'Gramedia', 'dimensi' => '15x23 cm', 'jumlah_stok' => 12],
        ];

        foreach ($bukuList as $data) {
            Buku::create($data);
        }
    }
}
