<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\EmailSender;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RegisterController extends Controller
{
    use RegistersUsers,EmailSender;

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {   
        return Validator::make($data, [ 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'documento' => ['required', 'unique:users'],
            'avatar' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);
    }  
        
    protected function create(array $data)
    {   
        if (array_key_exists('avatar', $data)){
            $avatar = $this->upload_file($data['avatar']);
        }else{
            $avatar = 'default_avatar.png';
        }

        $asunto = "Bienvenido";
        $mensaje = "<p>Hola, gracias por registrarte en el portal de empleo de Bull Marketing. Mucha suerte 😁</p>";
        $this->composeEmail($asunto,$mensaje, $data['email']);

        return User::create([
            'name' => $data['name'],
            'tipo_user' => 2, 
            'documento' => $data['documento'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $avatar,
        ]);
    } 

    /*
    *
    * Sube el archivo al servidor
    */
    public function upload_file ($avatar){
        $file = $avatar;
        $fileName = $this->claveThree(10).time().'.'.$file->extension();
        $destinofile = public_path('/img/profiles');
        $file->move($destinofile, $fileName);
        
        return $fileName;
    }

    /*
    *
    * Elimina el archivo del servidor
    */
    public function delete_file ($name){
        $filename = 'img/profiles/'.$name;
        if (!unlink($filename)) {
            return false;
        }
    }

    /*
    * Clave aleatoria
    */
    function claveThree($length = 3) { 
        return substr(str_shuffle("0123456789"), 0, $length); 
    } 
} 
