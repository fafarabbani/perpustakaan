<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use Illuminate\Support\Str;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peminjamanList = [
            ['uuid' => Str::uuid(), 'kode_transaksi' => 'TRX-2025-001', 'tanggal_pinjam' => '2025-10-20', 'anggota_id' => 1, 'status' => 'Dipinjam'],
            ['uuid' => Str::uuid(), 'kode_transaksi' => 'TRX-2025-002', 'tanggal_pinjam' => '2025-10-22', 'anggota_id' => 2, 'status' => 'Dikembalikan'],
        ];

        foreach ($peminjamanList as $data) {
            Peminjaman::create($data);
        }
    }
}
