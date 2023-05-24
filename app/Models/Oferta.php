<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Postulaciones;

class Oferta extends Model
{
    use HasFactory;

    /**
     * Obitiene las postulaciones de la oferta
     */
    public function postulaciones()
    {
        return $this->hasMany(Postulaciones::class);
    } 
}
 