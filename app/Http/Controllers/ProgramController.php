<?php
namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataProgram'] = Program::all();
        return view('pages.admin.program.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kode'         => 'required|string|max:50|unique:program,kode',
            'tahun'        => 'required|integer|min:2000|max:2100',
            'anggaran'     => 'required|numeric|min:1',
            'deskripsi'    => 'required|string|max:1000',
        ], [
            'nama_program.required' => 'Nama program wajib diisi.',
            'kode.required'         => 'Kode program wajib diisi.',
            'kode.unique'           => 'Kode program sudah digunakan.',
            'tahun.required'        => 'Tahun wajib diisi.',
            'tahun.integer'         => 'Tahun harus berupa angka.',
            'anggaran.required'     => 'Anggaran wajib diisi.',
            'anggaran.numeric'      => 'Anggaran harus berupa angka.',
            'deskripsi.required'    => 'Deskripsi wajib diisi.',
        ]);

        // ✅ Simpan data ke database
        Program::create([
            'kode'         => $request->kode,
            'nama_program' => $request->nama_program,
            'tahun'        => $request->tahun,
            'deskripsi'    => $request->deskripsi,
            'anggaran'     => $request->anggaran,
        ]);

        return redirect()->route('program.index')
            ->with('success', 'Data Program Bantuan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataProgram'] = Program::findOrFail($id);
        return view('pages.admin.program.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);

        // ✅ Validasi input
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kode'         => 'required|string|max:50|unique:program,kode,' . $id . ',program_id',
            'tahun'        => 'required|integer|min:2000|max:2100',
            'anggaran'     => 'required|numeric|min:1',
            'deskripsi'    => 'required|string|max:1000',
        ], [
            'nama_program.required' => 'Nama program wajib diisi.',
            'kode.required'         => 'Kode program wajib diisi.',
            'kode.unique'           => 'Kode program sudah digunakan.',
            'tahun.required'        => 'Tahun wajib diisi.',
            'tahun.integer'         => 'Tahun harus berupa angka.',
            'anggaran.required'     => 'Anggaran wajib diisi.',
            'anggaran.numeric'      => 'Anggaran harus berupa angka.',
            'deskripsi.required'    => 'Deskripsi wajib diisi.',
        ]);

        // ✅ Update data
        $program->update([
            'nama_program' => $request->nama_program,
            'kode'         => $request->kode,
            'tahun'        => $request->tahun,
            'anggaran'     => $request->anggaran,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->route('program.index')
            ->with('success', 'Data Program Bantuan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->route('program.index')
            ->with('success', 'Data Program Bantuan berhasil dihapus!');
    }
}
