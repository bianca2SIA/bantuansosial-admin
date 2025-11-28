<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    protected $table = 'penerima';
    protected $primaryKey = 'penerima_id';

    protected $fillable = [
        'program_id',
        'warga_id',
        'keterangan'
    ];

    // RELASI
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
