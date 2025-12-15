<?php
namespace App\Http\Controllers;

use App\Models\Penerima;
use App\Models\Program;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{

    public function index(Request $request)
    {

        $filterableColumns = ['program_id', 'tahap_ke'];

        $search = $request->input('search');

        $riwayat = Riwayat::with(['program', 'penerima.warga'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('penerima.warga', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
            })
            ->filter($request, $filterableColumns)
            ->orderBy('riwayat_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.riwayat.index', compact('riwayat'));
    }

    public function create()
    {
        $program  = Program::all();
        $penerima = Penerima::with('warga')->get();

        return view('pages.admin.riwayat.create', compact('program', 'penerima'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id'       => 'required|exists:program,program_id',
            'penerima_id'      => 'required|exists:penerima,penerima_id',
            'tahap_ke'         => 'required|integer|min:1',
            'tanggal'          => 'required|date',
            'nilai'            => 'required|numeric|min:0',
            'bukti_penyaluran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $bukti = null;
        if ($request->hasFile('bukti_penyaluran')) {
            $bukti = $request->file('bukti_penyaluran')->store('bukti_penyaluran', 'public');
        }

        Riwayat::create([
            'program_id'       => $request->program_id,
            'penerima_id'      => $request->penerima_id,
            'tahap_ke'         => $request->tahap_ke,
            'tanggal'          => $request->tanggal,
            'nilai'            => $request->nilai,
            'bukti_penyaluran' => $bukti,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Data riwayat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $riwayat  = Riwayat::findOrFail($id);
        $program  = Program::all();
        $penerima = Penerima::with('warga')->get();

        return view('pages.admin.riwayat.edit', compact('riwayat', 'program', 'penerima'));
    }

    public function update(Request $request, $id)
    {
        $riwayat = Riwayat::findOrFail($id);

        $request->validate([
            'program_id'       => 'required|exists:program,program_id',
            'penerima_id'      => 'required|exists:penerima,penerima_id',
            'tahap_ke'         => 'required|integer|min:1',
            'tanggal'          => 'required|date',
            'nilai'            => 'required|numeric|min:0',
            'bukti_penyaluran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $bukti = $riwayat->bukti_penyaluran;

        if ($request->hasFile('bukti_penyaluran')) {
            $bukti = $request->file('bukti_penyaluran')->store('bukti_penyaluran', 'public');
        }

        $riwayat->update([
            'program_id'       => $request->program_id,
            'penerima_id'      => $request->penerima_id,
            'tahap_ke'         => $request->tahap_ke,
            'tanggal'          => $request->tanggal,
            'nilai'            => $request->nilai,
            'bukti_penyaluran' => $bukti,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Data riwayat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $riwayat = Riwayat::findOrFail($id);
        $riwayat->delete();

        return redirect()->route('riwayat.index')->with('success', 'Data riwayat berhasil dihapus.');
    }
}
