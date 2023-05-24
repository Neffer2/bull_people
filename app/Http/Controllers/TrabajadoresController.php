<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Estados;   
use App\Models\Ciudades;  
use App\Models\Paises;
use App\Models\Tipo_documento;
use App\Models\Trabajador_info;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\EmailSender;
 
class TrabajadoresController extends Controller 
{   
    use EmailSender; 
    
    public function index (){ 
        $trabajadores = User::where('tipo_user', 3)->get();
        return view('cpanel_adm.trabajadores.inicio', ['trabajadores' => $trabajadores]);
    }

    public function show ($id){ 
        $trabajador = User::where('id', $id)->first();
        return view('cpanel_adm.trabajadores.trabajador', ['trabajador' => $trabajador]);
    }

    public function get_hoja_vida (){ 
        $paises = Paises::all();
        $tipos_documentos = Tipo_documento::all();
        $hoja_vida = Trabajador_info::where('user_id', auth()->user()->id)->first(); 

        if ($hoja_vida !== null) {
            return view('cpanel_trabajador.mi_hv.inicio', ['paises' => $paises, 'tipos_documentos' => $tipos_documentos], ['hoja_vida' => $hoja_vida]);
        }
        return view('cpanel_trabajador.mi_hv.inicio', ['paises' => $paises, 'tipos_documentos' => $tipos_documentos]);
    } 

    public function get_estados(Request $request){
        $estados = Estados::where('country_id', $request->id)->get();
        return response()->json(['estados' => $estados]); 
    }

    public function get_ciudades(Request $request){
        $ciudades = Ciudades::where('state_id', $request->id)->get();
        return response()->json(['ciudades' => $ciudades]);
    } 

    public function validate_hoja_vida (Request $request, $id){
        $user = Trabajador_info::where('user_id', $id)->first();
        if ($user === null) {
            return $this->hoja_vida($request, $id);
        }else{
            return $this->update_hoja_vida($request, $id);
        }
    }
  
    public function hoja_vida (Request $request, $id = null){

        $validated = $request->validate([
            'primer_nombre' => ['required'],
            'segundo_nombre' => [],
            'primer_apellido' => ['required'],
            'segundo_apellido' => [],
            'tipo_documento' => ['required'],
            'documento' => ['required'],
            'pais_documento' => ['required'],
            'dep_documento' => ['required'],
            'ciu_documento' => ['required'],
            'pais_nacimiento' => ['required'],
            'dep_nacimiento' => ['required'],
            'ciu_nacimiento' => ['required'],
            'fecha_nacimiento' => ['required'],
            'genero' => ['required'],
            'estado_civil' => ['required'],
            'nacionalidad' => ['required'],
            'grupo_sanguineo' => ['required'],
            'rh' => ['required'], 
            'email' => ['required'],
            'email_alternativo' => [],
            'pais_recidencia' => ['required'],
            'dep_recidencia' => ['required'], 
            'ciu_recidencia' => ['required'],
            'direccion' => ['required'],
            'celular' => ['required'],
            'telefono' => [],
            'nivel_academico' => ['required'],
            'cargo' => []
        ]);

        $trabajador_info = new Trabajador_info; 
        $trabajador_info->user_id = auth()->user()->id;
        $trabajador_info->primer_nombre = $request->primer_nombre;
        $trabajador_info->segundo_nombre = $request->segundo_nombre;
        $trabajador_info->primer_apellido = $request->primer_apellido;
        $trabajador_info->segundo_apellido = $request->segundo_apellido;
        $trabajador_info->tipo_documento = $request->tipo_documento;
        $trabajador_info->documento = $request->documento;
        $trabajador_info->pais_documento = $request->pais_documento;
        $trabajador_info->dep_documento = $request->dep_documento;
        $trabajador_info->ciu_documento = $request->ciu_documento;
        $trabajador_info->pais_nacimiento = $request->pais_nacimiento;
        $trabajador_info->dep_nacimiento = $request->dep_nacimiento; 
        $trabajador_info->ciu_nacimiento = $request->ciu_nacimiento;
        $trabajador_info->fecha_nacimiento = $request->fecha_nacimiento;
        $trabajador_info->genero = $request->genero;
        $trabajador_info->estado_civil = $request->estado_civil;
        $trabajador_info->nacionalidad = $request->nacionalidad;
        $trabajador_info->grupo_sanguineo = $request->grupo_sanguineo;
        $trabajador_info->rh = $request->rh;
        $trabajador_info->email = $request->email;
        $trabajador_info->email_alternativo = $request->email_alternativo;
        $trabajador_info->pais_recidencia = $request->pais_recidencia;
        $trabajador_info->dep_recidencia = $request->dep_recidencia;
        $trabajador_info->ciu_recidencia = $request->ciu_recidencia;
        $trabajador_info->direccion = $request->direccion;
        $trabajador_info->celular = $request->celular;
        $trabajador_info->telefono = $request->telefono;
        $trabajador_info->nivel_academico = $request->nivel_academico;
        $trabajador_info->cargo = $request->cargo;

        $trabajador_info->save();
        return redirect()->route('hoja_vida')->with('success', 'Tu hoja de vida fué actualizada.')->withInput();
    }

    public function update_hoja_vida (Request $request, $id){
        
        $trabajador_info = Trabajador_info::where('user_id', $id)->first();     
        // dd($trabajador_info);
        $validated = $request->validate([
            'primer_nombre' => ['required'],
            'segundo_nombre' => [],
            'primer_apellido' => ['required'],
            'segundo_apellido' => [],
            'tipo_documento' => ['required'],
            'documento' => ['required'],
            'pais_documento' => ['required'],
            'dep_documento' => ['required'],
            'ciu_documento' => ['required'],
            'pais_nacimiento' => ['required'],
            'dep_nacimiento' => ['required'],
            'ciu_nacimiento' => ['required'],
            'fecha_nacimiento' => ['required'],
            'genero' => ['required'],
            'estado_civil' => ['required'],
            'nacionalidad' => ['required'],
            'grupo_sanguineo' => ['required'],
            'rh' => ['required'], 
            'email' => ['required'],
            'email_alternativo' => [],
            'pais_recidencia' => ['required'],
            'dep_recidencia' => ['required'], 
            'ciu_recidencia' => ['required'],
            'direccion' => ['required'],
            'celular' => ['required'],
            'telefono' => [],
            'nivel_academico' => ['required'],
            'cargo' => []
        ]);

        $trabajador_info->user_id = auth()->user()->id;
        $trabajador_info->primer_nombre = $request->primer_nombre;
        $trabajador_info->segundo_nombre = $request->segundo_nombre;
        $trabajador_info->primer_apellido = $request->primer_apellido;
        $trabajador_info->segundo_apellido = $request->segundo_apellido;
        $trabajador_info->tipo_documento = $request->tipo_documento;
        $trabajador_info->documento = $request->documento;
        $trabajador_info->pais_documento = $request->pais_documento;
        $trabajador_info->dep_documento = $request->dep_documento;
        $trabajador_info->ciu_documento = $request->ciu_documento;
        $trabajador_info->pais_nacimiento = $request->pais_nacimiento;
        $trabajador_info->dep_nacimiento = $request->dep_nacimiento; 
        $trabajador_info->ciu_nacimiento = $request->ciu_nacimiento;
        $trabajador_info->fecha_nacimiento = $request->fecha_nacimiento;
        $trabajador_info->genero = $request->genero;
        $trabajador_info->estado_civil = $request->estado_civil;
        $trabajador_info->nacionalidad = $request->nacionalidad;
        $trabajador_info->grupo_sanguineo = $request->grupo_sanguineo;
        $trabajador_info->rh = $request->rh;
        $trabajador_info->email = $request->email;
        $trabajador_info->email_alternativo = $request->email_alternativo;
        $trabajador_info->pais_recidencia = $request->pais_recidencia;
        $trabajador_info->dep_recidencia = $request->dep_recidencia;
        $trabajador_info->ciu_recidencia = $request->ciu_recidencia;
        $trabajador_info->direccion = $request->direccion;
        $trabajador_info->celular = $request->celular;
        $trabajador_info->telefono = $request->telefono;
        $trabajador_info->nivel_academico = $request->nivel_academico;
        $trabajador_info->cargo = $request->cargo;

        $trabajador_info->update();
        return redirect()->route('hoja_vida')->with('success', 'Tu hoja de vida fué actualizada.')->withInput();
    }

    public function induccion_action (Request $request, $id){
        $request->validate(['confirm' => 'required']);

        $trabajador_info = Trabajador_info::where('user_id', $id)->first();   
        $trabajador_info->induccion = !$trabajador_info->induccion;
        $trabajador_info->update();

        return view('cpanel_trabajador.induccion.inicio');
    }

    public function store (Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|string|email|max:255',
            'password' => 'required|string|min:8',
            'documento' => 'required|unique:users',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contrato' => 'mimes:pdf',
            'hoja_vida' => 'mimes:pdf'
        ]);
         
        $user = new User; 
        $user->name = $request->name; 
        $user->tipo_user = '3'; //Trabajador
        $user->documento = $request->documento;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->avatar = 'default_avatar.png';

        if ($request->contrato){ 
            $archivo = $this->upload_contrato($request->file('contrato')); 
            $user->contrato = $archivo['archivo']; 
        } 
        if ($request->hoja_vida){
            $archivo = $this->upload_hoja_vida($request->file('hoja_vida')); 
            $user->hoja_vida = $archivo['archivo']; 
        }

        $user->save();

        $asunto = "Bienvenido";
        $mensaje = "<p>Felicidades tu cuenta Bull Marketing ha sido creada con éxito.<br>A continuaci&oacute;n, la informaci&oacute;n de tu sesi&oacute;n.<br><br>Usuario: ".$request->email."<br>Contraseña: ".$request->password."<br><br>Si tienes algún inconvenite comunícate con el área de tecnología.</p>";
        $this->composeEmail($asunto, $mensaje, $request->email); 

        return redirect()->route('nuevo_trabajador')->with('success', 'Trabajador creado exitosamente.')->withInput();
    }
    
     /*
    * 
    * Sube el archivo al servidor
    */
    public function upload_contrato ($request){
        $file = $request;
        $fileName = $this->claveThree(10).time().'.'.$file->extension();
        $destinofile = public_path('/files/contratos');
        $file->move($destinofile, $fileName);
        
        return ['archivo' => $fileName, 'archivo_nombre' => $file->getClientOriginalName()];
    }

    public function upload_hoja_vida ($request){
        $file = $request;
        $fileName = $this->claveThree(10).time().'.'.$file->extension();
        $destinofile = public_path('/files');
        $file->move($destinofile, $fileName);
        
        return ['archivo' => $fileName, 'archivo_nombre' => $file->getClientOriginalName()];
    }
 
    /*
    *
    * Elimina el archivo del servidor
    */
    public function delete_file ($name){
        if ($name){
            $filename = 'files/'.$name;
            if (!unlink($filename)) {
                return false;
            }
        }
    }

    /*
    * Clave aleatoria
    */
    function claveThree($length = 3) { 
        return substr(str_shuffle("0123456789ABCDEFG"), 0, $length); 
    }
} 
