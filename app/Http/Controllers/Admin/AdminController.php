<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function index() {

        $data = [
            'jmlAnggota' => Anggota::count(),
            'jmlBuku' => Buku::count(),
            'jmlPeminjaman' => DetailPeminjaman::count(),
            'jmlSdgDipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            'jmlPengembalian' => Peminjaman::where('status', 'dikembalikan')->count(),
            'jmlPenerbit' => Buku::distinct('penerbit')->count('penerbit'),
        ];

        // // --- Hitung peminjaman per minggu dalam bulan berjalan ---
        // $peminjamanMingguan = Peminjaman::selectRaw('WEEK(tanggal_pinjam, 1) as minggu, COUNT(*) as total')
        //     ->whereMonth('tanggal_pinjam', Carbon::now()->month)
        //     ->whereYear('tanggal_pinjam', Carbon::now()->year)
        //     ->groupBy('minggu')
        //     ->orderBy('minggu')
        //     ->get();

        // // Buat array label dan data untuk Chart.js
        // $labels = [];
        // $jumlah = [];

        // foreach ($peminjamanMingguan as $item) {
        //     $labels[] = 'Minggu ' . ($item->minggu - Carbon::now()->startOfMonth()->week + 1);
        //     $jumlah[] = $item->total;
        // }
        
        $now = Carbon::now();

        // === 1️⃣ Peminjaman per minggu ===
        $peminjamanMingguan = Peminjaman::selectRaw('WEEK(tanggal_pinjam, 1) as minggu, COUNT(*) as total')
            ->whereMonth('tanggal_pinjam', $now->month)
            ->whereYear('tanggal_pinjam', $now->year)
            ->groupBy('minggu')
            ->pluck('total', 'minggu'); // hasil: [minggu => total]

        // === 2️⃣ Pengembalian per minggu ===
        $pengembalianMingguan = DetailPeminjaman::selectRaw('WEEK(tanggal_kembali, 1) as minggu, COUNT(*) as total')
            ->where('status', 'dikembalikan')
            ->whereNotNull('tanggal_kembali')
            ->whereMonth('tanggal_kembali', $now->month)
            ->whereYear('tanggal_kembali', $now->year)
            ->groupBy('minggu')
            ->pluck('total', 'minggu');

        // === 3️⃣ Buat semua minggu di bulan ini ===
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // hitung jumlah minggu dalam bulan ini
        $weeksInMonth = [];
        $week = $startOfMonth->week;

        while ($startOfMonth->lessThanOrEqualTo($endOfMonth)) {
            $weeksInMonth[] = $week;
            $week++;
            $startOfMonth->addWeek();
        }

        // === 4️⃣ Bentuk label dan isi data tiap minggu ===
        $labels = [];
        $dataPinjam = [];
        $dataKembali = [];

        $firstWeek = $weeksInMonth[0];
        foreach ($weeksInMonth as $w) {
            $labels[] = 'Minggu ' . ($w - $firstWeek + 1);
            $dataPinjam[] = $peminjamanMingguan[$w] ?? 0;
            $dataKembali[] = $pengembalianMingguan[$w] ?? 0;
        }

        return view('admin.dashboard', compact('data', 'labels', 'dataPinjam', 'dataKembali'));
    }
}
