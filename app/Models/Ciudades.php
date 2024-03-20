<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Models
use App\Models\Departamentos;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ciudades extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'ciudades';


    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamentos::class);
    }
}
