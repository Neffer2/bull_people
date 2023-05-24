<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Tipo_oferta;
use App\Models\Postulaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfertasController extends Controller
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
            $Ofertas = Oferta::orderBy('id', 'DESC')->get();
            return view('cpanel_adm.ofertas.ofertas', ['ofertas' => $Ofertas]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->user_valiate()){
            $tipo_oferta = Tipo_oferta::all();
            return view('cpanel_adm.ofertas.nueva_oferta', ['tipo_oferta' => $tipo_oferta]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->user_valiate()){ 
            $request->validate([            
                'prioridad' => 'bail',
                'nombre' => 'bail|required',
                'descripcion' => 'bail|required|max:5000',
                'area' => 'bail',
                'tipo_oferta' => 'required',
                'fecha' => 'bail|required', 
                'sueldo' => 'bail|max:8',
                'tipo_contrato' => 'bail',
                'ubicacion' => 'bail',
                'archivo' => '',
                'jornada' => 'bail',
                'estado' => 'bail|required|in:1,0',
            ]);
            
            $user_id = Auth::user()->id;
            $Oferta = new Oferta;   
            $Oferta->user_id = $user_id;
            $Oferta->prioridad = $request->prioridad;
            $Oferta->nombre = $request->nombre;
            $Oferta->descripcion = $request->descripcion;
            $Oferta->area = $request->area;
            $Oferta->tipo_oferta = $request->tipo_oferta;
            $Oferta->fecha = $request->fecha;
            $Oferta->sueldo = $request->sueldo;
            $Oferta->tipo_contrato = $request->tipo_contrato;
            $Oferta->ubicacion = $request->ubicacion;
            
            if ($request->archivo){
                $archivo = $this->upload_file($request);
                $Oferta->archivo = $archivo['archivo'];
                $Oferta->archivo_nombre = $archivo['archivo_nombre'];
            }
    
            $Oferta->jornada = $request->jornada;
            $Oferta->estado = $request->estado;
            $Oferta->save();
     
            return redirect()->route('dashboard')->with("success", "Oferta publicada exitosamente.");
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\Ofertas  $ofertas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $Oferta = Oferta::find($id);
        return view('cpanel_adm.ofertas.oferta', ['oferta' => $Oferta]);
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oferta  $ofertas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Oferta = Oferta::find($id);
        $tipo_oferta = Tipo_oferta::all();
        return view('cpanel_adm.ofertas.edit', ['oferta' => $Oferta, 'tipo_oferta' => $tipo_oferta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oferta  $ofertas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        if ($this->user_valiate()){
            $Oferta = Oferta::find($id);
            $request->validate([
                'nombre' => 'bail|required',
                'prioridad' => 'bail',
                'descripcion' => 'bail|required|max:5000',
                'area' => 'bail',
                'tipo_oferta' => 'required',
                'fecha' => 'bail|required', 
                'sueldo' => 'bail',
                'tipo_contrato' => 'bail',
                'ubicacion' => 'bail',
                'archivo' => '',
                'jornada' => 'bail',
                'estado' => 'bail|required|in:1,0',
            ]);        
    
            if ($request->archivo){
                $new_archivo = $this->upload_file($request);
                $this->delete_file($Oferta->archivo);
                $Oferta->archivo = $new_archivo['archivo'];
                $Oferta->archivo_nombre = $new_archivo['archivo_nombre'];
            }
    
            $Oferta->prioridad = $request->prioridad;
            $Oferta->nombre = $request->nombre;
            $Oferta->descripcion = $request->descripcion;
            $Oferta->area = $request->area;
            $Oferta->tipo_oferta = $request->tipo_oferta;
            $Oferta->fecha = $request->fecha;
            $Oferta->sueldo = $request->sueldo; 
            $Oferta->tipo_contrato = $request->tipo_contrato;
            $Oferta->ubicacion = $request->ubicacion;
            $Oferta->jornada = $request->jornada;
            $Oferta->estado = $request->estado;
            $Oferta->update();
    
            return redirect()->route('ofertas.index')->with('success', 'Datos guardados exitosamente');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oferta  $ofertas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  
    {       
        if ($this->user_valiate()){
            $Oferta = Oferta::find($id);

            if ($this->delete_file($Oferta->archivo)){
                return back()->withErrors('No es posible eliminar éste archivo, comuniquese con el administrador');
            }
            
            $Oferta->postulaciones()->each(function($postulaciones){
                $postulaciones->delete();
            }); 
            $Oferta->delete();
            return redirect()->route('ofertas.index')->with('success', 'Oferta eliminada exitosamente.');
        }else{
            return redirect()->back();
        }
    }

    /*
    * 
    * Sube el archivo al servidor
    */
    public function upload_file (Request $request){
        $file = $request->file('archivo');
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
        return substr(str_shuffle("0123456789"), 0, $length); 
    }

    public function user_valiate(){ 
        if (Auth::user()->tipo_user == 1){
            return true; 
        }
        return false;
    } 
}
