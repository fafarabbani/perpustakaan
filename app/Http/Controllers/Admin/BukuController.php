<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Buku;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function index() {
        //get all Buku
        $data = Buku::latest()->paginate(10);

        return view('admin.buku.index', compact('data'));
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
            'judul' => 'required|string|max:255',
            'penerbit' => 'required|string|max:100',
            'dimensi' => 'nullable|string|max:100',
            'jumlah_stok' => 'required|integer|min:1',
        ]);

        // Buat kode buku otomatis berdasarkan penerbit
        $kodePenerbit = $this->getKodePenerbit($request->penerbit);
        $kodeBuku = $this->generateKodeBuku($kodePenerbit);

        // Simpan data buku
        Buku::create([
            'uuid' => Str::uuid(),
            'kode_buku' => $kodeBuku,
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'dimensi' => $request->dimensi,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

        /**
     * Fungsi untuk menentukan kode prefix berdasarkan penerbit
     */
    private function getKodePenerbit($penerbit)
    {
        $mapping = [
            'Informatika' => 'IF',
            'Erlangga' => 'ER',
            'Gramedia' => 'GR',
        ];

        return $mapping[$penerbit] ?? strtoupper(substr($penerbit, 0, 2)); // fallback ambil 2 huruf pertama
    }

    /**
     * Fungsi untuk generate kode buku baru berdasarkan penerbit
     */
    private function generateKodeBuku($kodePenerbit)
    {
        // Ambil buku terakhir berdasarkan kode penerbit
        $lastBuku = Buku::where('kode_buku', 'like', $kodePenerbit . '-%')->latest('id')->first();

        if ($lastBuku) {
            $lastNumber = (int) substr($lastBuku->kode_buku, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $kodePenerbit . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'penerbit' => 'required|string|max:100',
            'dimensi' => 'nullable|string|max:100',
            'jumlah_stok' => 'required|integer|min:1',
        ]);

        $buku = Buku::where('uuid', $uuid)->firstOrFail();

        $buku->update([
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'dimensi' => $request->dimensi,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $buku = Buku::where('uuid', $uuid)->firstOrFail();
        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
