<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    // // Campos que se pueden asignar de manera masiva
    protected $fillable = [
        'nombre',
        'mapa_distrito'
    ];
}
