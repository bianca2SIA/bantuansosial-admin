<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga.
     */
    public function index()
    {
        $dataWarga = Warga::all();
        return view('admin.warga.index', compact('dataWarga'));
    }

    /**
     * Tampilkan form tambah warga baru.
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Simpan data warga baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp|max:20',
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'agama'         => 'nullable|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail data warga berdasarkan ID.
     */
    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.show', compact('warga'));
    }

    /**
     * Tampilkan form edit data warga.
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.edit', compact('warga'));
    }

    /**
     * Update data warga yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp'        => 'required|max:20|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'agama'         => 'nullable|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui!');
    }

    /**
     * Hapus data warga.
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus!');
    }
}
