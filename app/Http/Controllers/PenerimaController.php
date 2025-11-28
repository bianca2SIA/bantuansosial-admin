<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use App\Models\Program;
use App\Models\Warga;
use Illuminate\Http\Request;

class PenerimaController extends Controller
{
    /**
     * Tampilkan semua data penerima
     */
    public function index()
    {
        $penerima = Penerima::with(['program', 'warga'])->paginate(10);

        return view('pages.admin.penerima.index', compact('penerima'));
    }

    /**
     * Form tambah data
     */
    public function create()
    {
        $program = Program::all();
        $warga   = Warga::all();

        return view('pages.admin.penerima.create', compact('program', 'warga'));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program,program_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'keterangan' => 'nullable|string'
        ]);

        Penerima::create($request->all());

        return redirect()->route('penerima.index')
                         ->with('success', 'Data penerima berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit($id)
{
    $penerima = Penerima::findOrFail($id);
    $program  = Program::all();
    $warga    = Warga::all();

    return view('pages.admin.penerima.edit', compact('penerima', 'program', 'warga'));
}


    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'program_id' => 'required|exists:program,program_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'keterangan' => 'nullable|string'
        ]);

        $penerima = Penerima::findOrFail($id);
        $penerima->update($request->all());

        return redirect()->route('penerima.index')
                         ->with('success', 'Data penerima berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $penerima = Penerima::findOrFail($id);
        $penerima->delete();

        return redirect()->route('penerima.index')
                         ->with('success', 'Data penerima berhasil dihapus.');
    }
}
