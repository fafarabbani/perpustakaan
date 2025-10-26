<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function index() {
        // Hanya tampilkan data yang sudah "dikembalikan"
        $data = Peminjaman::with(['anggota', 'detailPeminjaman.buku'])
                    ->where('status', 'dikembalikan')
                    ->latest()
                    ->paginate(10);

        $bukuDipinjam = Peminjaman::where('status', 'dipinjam')->get();

        // Format tanggal pinjam dan tanggal kembali
        $data->getCollection()->transform(function ($item) {
            Carbon::setLocale('id'); // Bahasa Indonesia

            // Format tanggal pinjam
            $item->tanggal_pinjam_formatted = $item->tanggal_pinjam
                ? Carbon::parse($item->tanggal_pinjam)->translatedFormat('l, d F Y')
                : '-';

            // Format tanggal kembali pada setiap detail peminjaman
            foreach ($item->detailPeminjaman as $detail) {
                $detail->tanggal_kembali_formatted = $detail->tanggal_kembali
                    ? Carbon::parse($detail->tanggal_kembali)->translatedFormat('l, d F Y')
                    : '-';
            }

            return $item;
        });


        return view('kasir.pengembalian.index', compact('data', 'bukuDipinjam'));
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
            'kode_transaksi' => 'required|exists:peminjaman,id',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->kode_transaksi);

        // Ubah status di tabel peminjaman
        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);

        // Ubah juga status & tanggal_kembali di detail_peminjaman
        foreach ($peminjaman->detailPeminjaman as $detail) {
            $detail->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now(),
            ]);

            // Tambahkan stok kembali ke buku
            $buku = $detail->buku;
            if ($buku) {
                $buku->increment('jumlah_stok', 1);
            }
        }

        return redirect()->route('kasir.pengembalian.index')
            ->with('success', 'Transaksi berhasil dikembalikan dan stok buku diperbarui.');
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
    public function update(Request $request, string $id)
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
