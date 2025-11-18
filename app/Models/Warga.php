<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'warga';

    // Primary key
    protected $primaryKey = 'warga_id';

    // Nonaktifkan timestamps (karena tabel 'warga' tidak punya created_at dan updated_at)
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];
}
