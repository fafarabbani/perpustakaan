<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
use Illuminate\Support\Str;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggotaList = [
            [
                'uuid' => Str::uuid(),
                'nomor_anggota' => 'AGT-2025-001', 
                'nama' => 'Budi Santoso', 
                'tanggal_lahir' => '2000-04-12', 
                'telepon' => '081234567890', 
                'alamat' => 'Jl. Merdeka No.1'
            ],
            ['uuid' => Str::uuid(), 'nomor_anggota' => 'AGT-2025-002', 'nama' => 'Siti Aminah', 'tanggal_lahir' => '1999-09-22', 'telepon' => '081223344556', 'alamat' => 'Jl. Mawar No.45'],
            ['uuid' => Str::uuid(), 'nomor_anggota' => 'AGT-2025-003', 'nama' => 'Andi Wijaya', 'tanggal_lahir' => '2002-01-10', 'telepon' => '081267889900', 'alamat' => 'Jl. Melati No.2'],
        ];

        foreach ($anggotaList as $data) {
            Anggota::create($data);
        }
    }
}
