<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table      = 'riwayat';
    protected $primaryKey = 'riwayat_id';

    protected $fillable = [
        'program_id',
        'penerima_id',
        'tahap_ke',
        'tanggal',
        'nilai',
        'bukti_penyaluran',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function penerima()
    {
        return $this->belongsTo(Penerima::class, 'penerima_id', 'penerima_id');
    }
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'riwayat_bantuan')
            ->orderBy('sort_order');
    }

    public function scopeFilter($query, $request, $columns)
    {
        foreach ($columns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->$column);
            }
        }
    }

    public function scopeSearch($query, $request, $columns)
    {
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }
            });
        }
    }

}
