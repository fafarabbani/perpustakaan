<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Anggota;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AnggotaController extends Controller
{
    /**
     * Write code on Method
     * 
     * @return response()
     * 
     */
    public function index() {

        //get all Anggota
        $data = Anggota::latest()->paginate(10);

        // Format tanggal lahir setiap anggota
        $data->getCollection()->transform(function ($item) {
            if ($item->tanggal_lahir) {
                Carbon::setLocale('id'); // bahasa Indonesia
                $item->tanggal_lahir_formatted = Carbon::parse($item->tanggal_lahir)
                    ->translatedFormat('l, d F Y');
            } else {
                $item->tanggal_lahir_formatted = '-';
            }
            return $item;
        });
        
        // Generate nomor anggota otomatis
        $year = date('Y');
        $lastAnggota = Anggota::orderBy('id', 'desc')->first();

        if (!$lastAnggota) {
            $newNumber = 1;
        } else {
            // Ambil 3 digit terakhir dari nomor terakhir
            $lastNumber = (int) substr($lastAnggota->nomor_anggota, -3);
            $newNumber = $lastNumber + 1;
        }

        // Format: AGT-2025-001
        $nomorAnggota = 'AGT-' . $year . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.anggota.index', compact('data', 'nomorAnggota'));
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
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Generate UUID dan nomor anggota
        $year = date('Y');
        $lastAnggota = Anggota::orderBy('id', 'desc')->first();
        $newNumber = $lastAnggota ? ((int) substr($lastAnggota->nomor_anggota, -3)) + 1 : 1;
        $nomorAnggota = 'AGT-' . $year . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Anggota::create([
            'uuid' => Str::uuid(),
            'nomor_anggota' => $nomorAnggota,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota baru berhasil ditambahkan!');
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
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $anggota = Anggota::where('uuid', $uuid)->firstOrFail();

        $anggota->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $anggota = Anggota::where('uuid', $uuid)->firstOrFail();
        $anggota->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}
