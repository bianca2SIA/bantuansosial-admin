<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

    protected $table = 'verifikasi';
    protected $primaryKey = 'verifikasi_id';

    // Jika PK bukan auto increment bigInt default
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'pendaftar_id',
        'petugas',
        'tanggal',
        'catatan',
        'skor',
    ];

    /**
     * Relasi ke pendaftar
     * verifikasi.pendaftar_id → pendaftar.pendaftar_id
     */
    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id', 'pendaftar_id');
    }
}
