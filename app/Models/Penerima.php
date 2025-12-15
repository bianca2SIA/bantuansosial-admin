<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    protected $table      = 'penerima';
    protected $primaryKey = 'penerima_id';

    protected $fillable = [
        'program_id',
        'warga_id',
        'keterangan',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
    public function scopeSearch($query, $request, $columns)
    {
        $search = $request->input('search');

        if ($search) {
            $query->whereHas('warga', function ($q) use ($search) {
                $q->where('nama', 'LIKE', '%' . $search . '%');
            });
        }

        return $query;
    }

}
