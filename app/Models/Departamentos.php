<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//Modelos
use App\Models\Ciudades;

class Departamentos extends Model
{
    use HasFactory;


    protected $table = 'departamentos';


    protected $fillable = [
        'nombre',
    ];


    public function ciudades():HasMany
    {
        return $this->hasMany(Ciudades::class, 'departamento_id', 'id');
    }
}
