<?php
namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Penerima;
use App\Models\Program;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $totalAnggaran = Riwayat::sum('nilai');

        $pendaftarBaru = Pendaftar::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $penerimaAktif = Penerima::count();

        $jumlahProgram = Program::count();

        $rawPendaftar = Pendaftar::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $grafikPendaftar = [];
        for ($i = 1; $i <= 8; $i++) {
            $grafikPendaftar[] = $rawPendaftar[$i] ?? 0;
        }

        $rawPenerima = Penerima::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $grafikPenerima = [];
        for ($i = 1; $i <= 8; $i++) {
            $grafikPenerima[] = $rawPenerima[$i] ?? 0;
        }

        $rawRiwayat = Riwayat::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $grafikRiwayat = [];
        for ($i = 1; $i <= 8; $i++) {
            $grafikRiwayat[] = $rawRiwayat[$i] ?? 0;
        }

        $permohonanTerakhir = Pendaftar::with('program')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $bulanIni = Pendaftar::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $bulanLalu = Pendaftar::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $persenPendaftar = $bulanLalu > 0
            ? round((($bulanIni - $bulanLalu) / $bulanLalu) * 100, 1)
            : 0;

        $anggaranBulanIni = Riwayat::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('nilai');

        $anggaranBulanLalu = Riwayat::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('nilai');

        $persenAnggaran = $anggaranBulanLalu > 0
            ? round((($anggaranBulanIni - $anggaranBulanLalu) / $anggaranBulanLalu) * 100, 1)
            : 0;
        $anggaranBulanIni = Riwayat::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('nilai');

        $anggaranBulanLalu = Riwayat::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('nilai');

        $persenAnggaran = $anggaranBulanLalu > 0
            ? round((($anggaranBulanIni - $anggaranBulanLalu) / $anggaranBulanLalu) * 100, 1)
            : 0;

        $penerimaBulanIni = Penerima::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $penerimaBulanLalu = Penerima::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $persenPenerima = $penerimaBulanLalu > 0
            ? round((($penerimaBulanIni - $penerimaBulanLalu) / $penerimaBulanLalu) * 100, 1)
            : 0;

        $disalurkan = Riwayat::whereNotNull('bukti_penyaluran')->count();

        $dalamProses = Riwayat::whereNull('bukti_penyaluran')
            ->where('tahap_ke', '>', 1)
            ->count();

        $belumDisalurkan = Riwayat::whereNull('bukti_penyaluran')
            ->where('tahap_ke', 1)
            ->count();

        return view('pages.admin.dashboard', compact(
            'totalAnggaran',
            'pendaftarBaru',
            'penerimaAktif',
            'jumlahProgram',
            'grafikPendaftar',
            'grafikPenerima',
            'grafikRiwayat',
            'permohonanTerakhir',
            'persenAnggaran',
            'persenPendaftar',
            'persenPenerima',
            'disalurkan',
            'dalamProses',
            'belumDisalurkan',

        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
