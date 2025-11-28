<?php

namespace App\Http\Controllers;

use App\Models\Verifikasi;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Display all verifikasi.
     */
    public function index(Request $request)
    {
        $query = Verifikasi::with('pendaftar');

        if ($request->search) {
            $query->where('petugas', 'LIKE', '%' . $request->search . '%')
                  ->orWhereHas('pendaftar', function ($q) use ($request) {
                      $q->where('pendaftar_id', 'LIKE', '%' . $request->search . '%');
                  });
        }

        $verifikasi = $query->paginate(10);

        return view('pages.admin.verifikasi.index', compact('verifikasi'));
    }

    /**
     * Show form create verifikasi.
     */
    public function create()
    {
        $pendaftar = Pendaftar::with('warga')->get();

        return view('pages.admin.verifikasi.create', compact('pendaftar'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pendaftar_id' => 'required|integer|exists:pendaftar,pendaftar_id',
            'petugas'      => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string',
            'skor'         => 'required|integer|min:0',
        ]);

        Verifikasi::create([
            'pendaftar_id' => $request->pendaftar_id,
            'petugas'      => $request->petugas,
            'tanggal'      => $request->tanggal,
            'catatan'      => $request->catatan,
            'skor'         => $request->skor,
        ]);

        return redirect()->route('verifikasi.index')->with('success', 'Data verifikasi berhasil ditambahkan');
    }

    /**
     * Show form edit verifikasi.
     */
    public function edit($id)
    {
        $verifikasi = Verifikasi::findOrFail($id);
        $pendaftar = Pendaftar::with('warga')->get();

        return view('pages.admin.verifikasi.edit', compact('verifikasi', 'pendaftar'));
    }

    /**
     * Update an existing record.
     */
    public function update(Request $request, $id)
    {
        $verifikasi = Verifikasi::findOrFail($id);

        $request->validate([
            'pendaftar_id' => 'sometimes|integer|exists:pendaftar,pendaftar_id',
            'petugas'      => 'sometimes|string|max:255',
            'tanggal'      => 'sometimes|date',
            'catatan'      => 'nullable|string',
            'skor'         => 'sometimes|integer|min:0',
        ]);

        $verifikasi->update($request->only([
            'pendaftar_id',
            'petugas',
            'tanggal',
            'catatan',
            'skor',
        ]));

        return redirect()->route('verifikasi.index')->with('success', 'Data verifikasi berhasil diperbarui');
    }

    /**
     * Delete a resource.
     */
    public function destroy($id)
    {
        $verifikasi = Verifikasi::findOrFail($id);
        $verifikasi->delete();

        return redirect()->route('verifikasi.index')->with('success', 'Data verifikasi berhasil dihapus');
    }
}
