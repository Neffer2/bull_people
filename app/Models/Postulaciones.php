<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Oferta;

class Postulaciones extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function user_info()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Trae la oferta dueña de la postulacion.
     */
    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }
}