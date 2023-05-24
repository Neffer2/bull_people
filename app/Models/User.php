<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

  
    protected $fillable = [
        'name',
        'tipo_user',
        'documento',
        'email',
        'password',
        'avatar',
    ]; 


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Obtiene info de trabajadores de cada usuario
     */
    public function trabajador_infos() 
    {
        return $this->hasMany(Trabajador_info::class, 'user_id', 'id');
    } 

    public function tipo_documento() 
    {
        return $this->hasMany(Trabajador_info::class, 'user_id', 'id'); 
    } 

}
