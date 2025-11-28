<?php
namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function index(Request $request)
    {
        $filterableColumns = ['tahun'];
        $searchableColumns = ['nama_program'];

        $data['dataProgram'] = Program::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();
        return view('pages.admin.program.index', $data);
    }

    public function create()
    {
        return view('pages.admin.program.create');
    }

    public function store(Request $request)
    {

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

    public function edit(string $id)
    {
        $data['dataProgram'] = Program::findOrFail($id);
        return view('pages.admin.program.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kode'         => 'required|string|max:50|unique:program,kode,' . $id . ',program_id',
            'tahun'        => 'required|integer|min:2010|max:2030',
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

    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->route('program.index')
            ->with('success', 'Data Program Bantuan berhasil dihapus!');
    }
}
