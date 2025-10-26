<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Str;

class DetailPeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detailList = [
            ['uuid' => Str::uuid(), 'peminjaman_id' => 1, 'buku_id' => 1, 'tanggal_kembali' => null, 'status' => 'Dipinjam'],
            ['uuid' => Str::uuid(), 'peminjaman_id' => 1, 'buku_id' => 2, 'tanggal_kembali' => null, 'status' => 'Dipinjam'],
            ['uuid' => Str::uuid(), 'peminjaman_id' => 2, 'buku_id' => 3, 'tanggal_kembali' => '2025-10-25', 'status' => 'Dikembalikan'],
        ];

        foreach ($detailList as $data) {
            DetailPeminjaman::create($data);
        }
    }
}
