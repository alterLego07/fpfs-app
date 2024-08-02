<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Jugadores extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function tipodocumento (): HasOne
    {
        return $this->hasOne(Tipo_documentos::class, 'id', 'tipo_documento_id');
    }

    public function nacionalidad () : BelongsTo
    {
        return $this->belongsTo(Nacionalidades::class);
    }

    public function club () : BelongsTo
    {
        return $this->belongsTo(Clubes::class);
    }


    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function categoria():BelongsTo
    {
        return $this->belongsTo(Categorias::class);
        
    }


    public function getEstadoAttribute($value)
    {
        return $value == 1 ? 'Activo' : 'Inactivo';
    }

    public function club_origen () : BelongsTo
    {
        return $this->belongsTo(Clubes::class, 'club_origen_id', 'id');
    }
    public function club_primer_ficha () : BelongsTo
    {
        return $this->belongsTo(Clubes::class, 'club_primer_fichaje', 'id');
    }

}
