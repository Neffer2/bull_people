<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    use AuthenticatesUsers;

 
    protected $redirectTo = RouteServiceProvider::HOME;

  
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //Validando tipo de user para luego ser redireccionado de acuerdo al tipo de user
    public function redirectTo(){
        //Ambos usuariios van al mismo controlador
        return '/';        
        // return $this->redirectTo;         
    }


}
