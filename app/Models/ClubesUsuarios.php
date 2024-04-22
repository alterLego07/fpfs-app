<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubesUsuarios extends Model
{
    use HasFactory;


    protected $guarded = [];
    
    protected $table = 'clubes_usuarios';


    public function club() : BelongsTo
    {
        return $this->belongsTo(Clubes::class);
    }

    public function usuario() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
