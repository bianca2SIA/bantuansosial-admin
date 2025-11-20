<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pendaftar extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pendaftar';

    // Primary key
    protected $primaryKey = 'pendaftar_id';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'program_id',
        'warga_id',
        'status_seleksi',
    ];

   public function scopeSearch($query, $keyword)
{
    if (!$keyword) {
        return $query;
    }

    return $query->where(function ($q) use ($keyword) {

        // Cari berdasarkan status seleksi
        $q->where('status_seleksi', 'like', "%$keyword%")

            // Cari berdasarkan nama program
            ->orWhereHas('program', function ($p) use ($keyword) {
                $p->where('nama_program', 'like', "%$keyword%");
            })

            // Cari berdasarkan nama warga
            ->orWhereHas('warga', function ($w) use ($keyword) {
                $w->where('nama', 'like', "%$keyword%");
            });
    });
}


    // Relasi ke tabel Program (Many to One)
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    // Relasi ke tabel Warga (Many to One)
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
}
