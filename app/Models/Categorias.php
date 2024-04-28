<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorias extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'categorias';

    public function jugadores():HasMany
    {
        return $this->hasMany(Jugadores::class);
    }

}
