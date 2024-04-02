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

    protected $casts = [
        'estado' => 'boolean',
        'sexo' => 'array',
        'habilitado' => 'array'
    ];

    // public function tipodocumento (): BelongsTo
    // {
    //     return $this->belongsTo(Tipo_documentos::class);
    // }


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





}
