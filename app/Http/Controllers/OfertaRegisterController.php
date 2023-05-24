<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Traits\EmailSender;

class OfertaRegisterController extends Controller
{    
    use EmailSender;
    /* 
    * Muestra la vista del registro
    */
    public function show ($id){ 
        if (Auth::check()){
            return redirect('dashboard');
        }
        return view('auth.oferta-register', ['id_oferta' => $id]);
    }
 
    /*
    * Ejecuta el registro
    * Para ingrear los datos del register se crea un Form Request. (php artisan make:request nombre)        
    * El request permite autorizar y validar todos las posibles respuestas que pueda tener el insert. Ejemplo: Nombre mal, contraseña corta, email falso, etc.
    */
    public function register (RegisterRequest $request){
        //Crea el registro si el request lo permite

        if (is_null($request->avatar)){
            $avatar = 'default_avatar.png';
        }else{
            $avatar = $this->upload_file($request->avatar);
        } 
    
        $user = User::create([
            'name' => $request->name,
            'tipo_user' => 2,
            'documento' => $request->documento,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatar
        ]);
        $asunto = "Bienvenido";
        $mensaje = "<p>Hola, gracias por registrarte en el portal de empleo de Bull Marketing. Mucha suerte 😁</p>";
        $this->composeEmail($asunto,$mensaje, $request->email);
        
        //route() solo funciona con rutas nombradas 
        $user = Auth::getProvider()->retrieveByCredentials([
            'name' => $request->name,
            'password' => $request->password
        ]);
        Auth::login($user);
        return redirect()->route('oferta', [$request->oferta_id])->with('success', "¡Ya casi estás listo! termina tu postulación");
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