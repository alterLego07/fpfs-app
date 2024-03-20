<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tipo_documentos extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'tipo_documentos';


    public function jugador (): BelongsTo
    {
        return $this->belongsTo(Jugadores::class);
    }

}
