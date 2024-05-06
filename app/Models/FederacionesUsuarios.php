<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FederacionesUsuarios extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'federaciones_usuarios';


    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function federacion():BelongsTo
    {
        return $this->belongsTo(Federaciones::class);
    }

    
}
