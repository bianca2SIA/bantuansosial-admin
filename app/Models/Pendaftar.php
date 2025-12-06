<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table      = 'pendaftar';
    protected $primaryKey = 'pendaftar_id';

    protected $fillable = [
        'program_id',
        'warga_id',
        'status_seleksi',
    ];

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $keyword)
    {
        if (! $keyword) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {

            $q->orWhereHas('warga', function ($w) use ($keyword) {
                $w->where('nama', 'like', "%$keyword%");
            });
        });
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'pendaftar_bantuan')
            ->orderBy('sort_order');
    }

}
