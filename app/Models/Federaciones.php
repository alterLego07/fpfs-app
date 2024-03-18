<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Federaciones extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'federaciones';

    public function ciudad():BelongsTo
    {
        return $this->belongsTo(Ciudades::class);
    }

    public function departamento():BelongsTo
    {
        return $this->belongsTo(Departamentos::class);
    }




}
