<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
