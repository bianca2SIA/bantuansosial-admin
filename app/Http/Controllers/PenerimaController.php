<?php
namespace App\Http\Controllers;

use App\Models\Penerima;
use App\Models\Program;
use App\Models\Warga;
use Illuminate\Http\Request;

class PenerimaController extends Controller
{

    public function index(Request $request)
    {
        $searchableColumns = ['nama'];

        $penerima = Penerima::with(['warga', 'program'])
            ->search($request, $searchableColumns)
            ->orderBy('penerima_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.penerima.index', compact('penerima'));
    }

    public function create()
    {
        $program = Program::all();
        $warga   = Warga::all();

        return view('pages.admin.penerima.create', compact('program', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:program,program_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'keterangan' => 'nullable|string',
        ]);

        Penerima::create($request->all());

        return redirect()->route('penerima.index')
            ->with('success', 'Data penerima berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penerima = Penerima::findOrFail($id);
        $program  = Program::all();
        $warga    = Warga::all();

        return view('pages.admin.penerima.edit', compact('penerima', 'program', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'program_id' => 'required|exists:program,program_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'keterangan' => 'nullable|string',
        ]);

        $penerima = Penerima::findOrFail($id);
        $penerima->update($request->all());

        return redirect()->route('penerima.index')
            ->with('success', 'Data penerima berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penerima = Penerima::findOrFail($id);
        $penerima->delete();

        return redirect()->route('penerima.index')
            ->with('success', 'Data penerima berhasil dihapus.');
    }
}
