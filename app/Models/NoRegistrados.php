<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoRegistrados extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre','documento','email','perfil','hoja_vida',
        'contacto_1', 'contacto_2', 'ciudad', 'cargo', 'aspiracion',
        'estado', 'descripcion_estado', 'ex_bull'
    ];
}
