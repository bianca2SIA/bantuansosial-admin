<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
