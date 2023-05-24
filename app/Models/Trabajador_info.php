<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estados;
use App\Models\Ciudades;
 
class Trabajador_info extends Model
{
    use HasFactory;

    /* paises y ciudades */
    public function pais_resi ()
    {
        return $this->hasOne(Paises::class, 'id', 'pais_recidencia'); 
    }

    public function dep_resi ()
    {
        return $this->hasOne(Estados::class, 'id', 'dep_recidencia'); 
    }

    public function ciu_resi ()
    {
        return $this->hasOne(Ciudades::class, 'id', 'ciu_recidencia'); 
    }

    public function dep_doc ()
    {
        return $this->hasOne(Estados::class, 'id', 'dep_documento'); 
    }

    public function ciu_doc ()
    {
        return $this->hasOne(Ciudades::class, 'id', 'ciu_documento'); 
    }

    public function dep_naci ()
    {
        return $this->hasOne(Estados::class, 'id', 'dep_nacimiento'); 
    }

    public function ciu_naci ()
    {
        return $this->hasOne(Ciudades::class, 'id', 'ciu_nacimiento'); 
    }
}
  