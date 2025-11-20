<?php
namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Program;
use App\Models\Warga;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    /**
     * Tampilkan semua data pendaftar bantuan.
     */
    public function index(Request $request)
{
    $keyword = $request->search;

    $pendaftar = Pendaftar::with(['program', 'warga'])
        ->search($keyword)
        ->paginate(10)
        ->withQueryString();

    return view('pages.admin.pendaftar.index', compact('pendaftar'));
}


    /**
     * Tampilkan form tambah pendaftar bantuan baru.
     */
    public function create()
    {
        $program = Program::all();
        $warga   = Warga::all();
        return view('pages.admin.pendaftar.create', compact('program', 'warga'));

    }

    /**
     * Simpan data pendaftar bantuan baru ke database.
     */
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

    /**
     * Tampilkan detail data pendaftar berdasarkan ID.
     */
    public function show($id)
    {
        $pendaftar = Pendaftar::with(['program', 'warga'])->findOrFail($id);
        return view('pages.admin.pendaftar.show', compact('pendaftar'));
    }

    /**
     * Tampilkan form edit data pendaftar bantuan.
     */
    public function edit($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $program   = Program::all();
        $warga     = Warga::all();

        return view('pages.admin.pendaftar.edit', compact('pendaftar', 'program', 'warga'));
    }

    /**
     * Update data pendaftar bantuan yang sudah ada.
     */
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

    /**
     * Hapus data pendaftar bantuan.
     */
    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

        return redirect()->route('pendaftar.index')
            ->with('success', 'Data pendaftar bantuan berhasil dihapus!');
    }
}
