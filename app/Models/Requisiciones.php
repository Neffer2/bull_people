<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisiciones extends Model
{
    use HasFactory;

     /**
     * Get the user info
     */
    public function user_info()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}  
