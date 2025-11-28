<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

    protected $table      = 'verifikasi';
    protected $primaryKey = 'verifikasi_id';

    public $incrementing = true;
    protected $keyType   = 'int';

    protected $fillable = [
        'pendaftar_id',
        'petugas',
        'tanggal',
        'catatan',
        'skor',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id', 'pendaftar_id');
    }
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function scopeSearch($query, $search)
    {
        if (! $search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {

            // Cari nama petugas
            $q->where('petugas', 'like', "%{$search}%")

            // Cari nama warga (relasi 2 tingkat)
                ->orWhereHas('pendaftar.warga', function ($p) use ($search) {
                    $p->where('nama', 'like', "%{$search}%");
                });
        });
    }

}
