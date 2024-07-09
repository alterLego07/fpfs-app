<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Ciudades;
use App\Models\Federaciones;
use App\Models\Departamentos;

class Clubes extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'clubes';

    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudades::class);
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamentos::class);
    }

    public function federacion(): BelongsTo
    {
        return $this->belongsTo(Federaciones::class);
    }


    public function scopeCustomSelect(Builder $query, $userId)
    {
        return $query->whereNotNull('created_at')
                ->where(function($query) use ($userId) {
                    $query->whereIn('federacion_id', function($query) use ($userId) {
                        $query->select('federacion_id')
                            ->from('federaciones_usuarios')
                            ->where('user_id', $userId);
                    })
                    ->orWhere('id', function($query) use ($userId) {
                        $query->select('club_id')
                            ->from('clubes_usuarios')
                            ->where('user_id', $userId);
                    });
                });
    }
}
