<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\User;
use App\Imports\NoRegistradosImport;
use Illuminate\Http\Request;
use App\Models\Postulaciones;
use App\Models\NoRegistrados;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Excel;

class PostulacionesController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
    }
 
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response 
     */
    
    public function index()
    {   
        if ($this->user_valiate()){ 
            // $count = Oferta::All()->postulaciones->count(); 
            // dd($count);
            $Oferta = Oferta::orderBy('id', 'DESC')->get();
            return view('cpanel_adm.postulaciones.postulados_admin', ['ofertas' => $Oferta]);
        }else {
            return redirect()->back();
        }
    } 
 
    /* 
    * Guarda la postulacion
    * 
    */
    public function store (Request $request, $oferta_id){
        $user_id = Auth::user()->id;
        $Postulacion = Postulaciones::where('oferta_id', $oferta_id)
                                    ->where('user_id', $user_id)
                                    ->count();
        if ($Postulacion > 0){
            return redirect()->back()->withErrors("Ya te postulaste en esta oferta.");
        }

        $request->validate([ 
            'descripcion' => ['required', 'string', 'max:1000'],
            'hoja_vida' => ['required','mimes:pdf']
        ]);
        
        $postulacion = new Postulaciones; 
        $postulacion->user_id = $user_id;
        $postulacion->oferta_id = $oferta_id; 
        $postulacion->descripcion = $request->descripcion; 
        $postulacion->contacto_1 = $request->contacto_1;
        $postulacion->contacto_2 = $request->contacto_2;
        $postulacion->aspiracion = $request->aspiracion;
        $postulacion->ciudad = $request->ciudad;
        $postulacion->cargo = $request->cargo;
        $postulacion->ex_bull = $request->ex_bull;

        if ($request->hoja_vida){
            $archivo = $this->upload_file($request);
            $postulacion->hoja_vida = $archivo['hoja_vida']; 
        }

        $postulacion->save();

        //Guarda la hoja de vida dentro de la tabla users
        $user = User::find($user_id);
        $user->hoja_vida = $archivo['hoja_vida'];
        $user->update();
        
        return redirect()->route('dashboard')->with('success', 'Felicidades, tu postulacion fué enviada.');;
    }

    public function show_postulados ($id){
        if ($this->user_valiate()){
            $Oferta = Oferta::find($id);
            return view('cpanel_adm.postulaciones.postulados_list', ['oferta' => $Oferta]);
        }else {
            return redirect()->back();
        }
    }

    public function show_postulado ($id){
        if ($this->user_valiate()){
            $Oferta = Postulaciones::find($id); 
            return view('cpanel_adm.postulaciones.postulado', ['postulado' => $Oferta]);
        }else {
            return redirect()->back();
        }
    }

    public function show_postulado_no_registrado ($id){ 
        if ($this->user_valiate()){
            $Oferta = NoRegistrados::find($id); 
            return view('cpanel_adm.postulaciones.postulado_no_registrado', ['postulado' => $Oferta]);
        }else {
            return redirect()->back();
        }
    }

    /*
    * Cambia el estado de la postulacion (Boolean)
    */
    public function cambio_estado (Request $request, $id){
        
        $request->validate([
            'descripcion_estado' => ['required'],
            // Nombre del radio (no se puede cambiar)
            'group5' => ['required'],
        ]);

        $postulacion = Postulaciones::find($id);
        $postulacion->descripcion_estado = $request->descripcion_estado;
        $postulacion->estado = $request->group5;
        $postulacion->update();

        return redirect()->back()->with('success', 'El estado de la postulacion ha sido actualizado');
    }

    /*
    *
    * Base de datos general
    **/
    public function db_general (){ 
        $postulaciones = Postulaciones::all();
        return view('cpanel_adm.postulaciones.db_general', ['postulaciones' => $postulaciones]);
    }

    /*
    *
    * Base de datos general usuario no registrados
    **/
    public function no_registrados () {
        $data = NoRegistrados::all();
        return view('cpanel_adm.postulaciones.no_registrados', ['data' => $data]);
    } 

    /*
    *
    * Importa usuarios no registrados desde Excel.
    */
    public function import (Request $request){
        $request->validate([
            // 'file' => ['required','mimes:csv,xls,xlsx']
            'file' => ['required','mimes:xlsx, csv, xls']
        ]);

        //$path = $request->file('file')->getRealPath();
 
        Excel::import(new NoRegistradosImport, $request->file('file'));
        return back()->withSuccess('Datos subidos exitosamente.');
    }  


    /*
    *
    * Sube el archivo al servidor
    */
    public function upload_file (Request $request){
        $file = $request->file('hoja_vida');
        $fileName = $this->claveThree(10).time().'.'.$file->extension();
        $destinofile = public_path('/files');
        $file->move($destinofile, $fileName);
        
        return ['hoja_vida' => $fileName];
    }

    /*
    *
    * Elimina el archivo del servidor
    */
    public function delete_file ($name){
        $filename = 'files/'.$name;
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

    public function user_valiate(){ 
        if (Auth::user()->tipo_user == 1){
            return true; 
        }
        return false;
    }   
}
