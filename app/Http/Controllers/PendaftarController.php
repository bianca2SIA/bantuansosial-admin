<?php
namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Program;
use App\Models\Warga;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{

    public function index(Request $request)
    {
        $filterableColumns = ['status_seleksi'];

        $keyword = $request->search;

        $pendaftar = Pendaftar::with(['program', 'warga'])
            ->filter($request, $filterableColumns)
            ->search($keyword)
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.pendaftar.index', compact('pendaftar'));
    }

    public function create()
    {
        $program = Program::all();
        $warga   = Warga::all();
        return view('pages.admin.pendaftar.create', compact('program', 'warga'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id'     => 'required|exists:program,program_id',
            'warga_id'       => 'required|exists:warga,warga_id',
            'status_seleksi' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        Pendaftar::create([
            'program_id'     => $request->program_id,
            'warga_id'       => $request->warga_id,
            'status_seleksi' => $request->status_seleksi,
        ]);

        return redirect()->route('pendaftar.index')
            ->with('success', 'Data pendaftar bantuan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pendaftar = Pendaftar::with(['program', 'warga'])->findOrFail($id);
        return view('pages.admin.pendaftar.show', compact('pendaftar'));
    }

    public function edit($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $program   = Program::all();
        $warga     = Warga::all();

        return view('pages.admin.pendaftar.edit', compact('pendaftar', 'program', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $request->validate([
            'program_id'     => 'required|exists:program,program_id',
            'warga_id'       => 'required|exists:warga,warga_id',
            'status_seleksi' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        $pendaftar->update([
            'program_id'     => $request->program_id,
            'warga_id'       => $request->warga_id,
            'status_seleksi' => $request->status_seleksi,
        ]);

        return redirect()->route('pendaftar.index')
            ->with('success', 'Data pendaftar bantuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

        return redirect()->route('pendaftar.index')
            ->with('success', 'Data pendaftar bantuan berhasil dihapus!');
    }
}
