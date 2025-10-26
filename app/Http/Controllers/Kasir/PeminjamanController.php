<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function index() {
        // Hanya tampilkan data yang masih "dipinjam"
        $data = Peminjaman::with(['anggota', 'detailPeminjaman.buku'])
                    ->where('status', 'dipinjam')
                    ->latest()
                    ->paginate(10);

        // Format tanggal pinjam setiap peminjaman
        $data->getCollection()->transform(function ($item) {
            if ($item->tanggal_pinjam) {
                Carbon::setLocale('id'); // bahasa Indonesia
                $item->tanggal_pinjam_formatted = Carbon::parse($item->tanggal_pinjam)
                    ->translatedFormat('l, d F Y');
            } else {
                $item->tanggal_pinjam_formatted = '-';
            }
            return $item;
        });

        $kodeTransaksi = 'TRX-' . now()->format('YmdHis');

        $anggota = Anggota::orderBy('nama', 'asc')->get();
        $buku = Buku::where('jumlah_stok', '>', 0)->orderBy('judul', 'asc')->get();

        return view('kasir.peminjaman.index', compact('data', 'anggota', 'buku', 'kodeTransaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:peminjaman,kode_transaksi',
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|array',
            'buku_id.*' => 'exists:buku,id',
        ]);

        $peminjaman = Peminjaman::create([
            'uuid' => Str::uuid(),
            'kode_transaksi' => $request->kode_transaksi,
            'anggota_id' => $request->anggota_id,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam',
        ]);

        foreach ($request->buku_id as $bukuId) {
            DetailPeminjaman::create([
                'uuid' => Str::uuid(),
                'peminjaman_id' => $peminjaman->id,
                'buku_id' => $bukuId,
                'status' => 'dipinjam',
            ]);

            // optional: update stok buku
            $item = Buku::find($bukuId);
            if ($item && $item->jumlah_stok > 0) {
                $item->decrement('jumlah_stok', 1);
            }
        }

        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
