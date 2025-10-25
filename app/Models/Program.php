<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBantuan extends Model
{
    use HasFactory;

    // Tambahkan baris ini:
    protected $table = 'program'; // sesuai migration kamu!

    protected $primaryKey = 'program_id';
    public $timestamps = true;

    protected $fillable = [
        'kode',
        'nama_program',
        'tahun',
        'deskripsi',
        'anggaran',
    ];
}
