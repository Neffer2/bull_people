<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisiciones;
use Illuminate\Support\Facades\Auth;


class RequisicionesController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        if (auth()->user()->tipo_user == 1){ 
            $requisiciones = Requisiciones::orderBy('estado', 'ASC')->get();
            return view('cpanel_adm.requisiciones.inicio', ['requisiciones' => $requisiciones]);
        }elseif (auth()->user()->tipo_user == 3) {
            $requisiciones = Requisiciones::where('user_id', $user_id = Auth::user()->id)->orderBy('estado', 'ASC')->get();
            return view('cpanel_trabajador.requisiciones.inicio', ['requisiciones' => $requisiciones]);
        }
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $requisiciones = new Requisiciones;

        $request->validate([
            'archivo' => 'required|mimes:pdf'
        ]); 

        $user_id = Auth::user()->id;
        $requisiciones->user_id = $user_id;
        if ($request->archivo){
            $archivo = $this->upload_file($request);
            $requisiciones->requisicion = $archivo['archivo'];
        } 
        $requisiciones->save();

        return redirect()->route('requisiciones.index')->with('success', 'Tu requisición fue enviada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'estado' => 'required'
        ]); 

        $requisicion = Requisiciones::find($id);
        $requisicion->estado = $request->estado;
        $requisicion->update();

        return redirect()->route('requisiciones.index')->with('success', 'Requisición actualizada exitosamente');
    } 
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requisicion = Requisiciones::find($id);

        if ($this->delete_file($requisicion->requisicion)){
            return back()->withErrors('No es posible eliminar éste archivo, comuniquese con el administrador');
        }
        $requisicion->delete();

        return redirect()->route('requisiciones.index')->with('success', 'Requisición actualizada exitosamente');
    }
 
    /*
    * 
    * Sube el archivo al servidor
    */
    public function upload_file (Request $request){
        $file = $request->file('archivo');
        $fileName = $this->claveThree(10).time().'.'.$file->extension();
        $destinofile = public_path('/files/requisicion/');
        $file->move($destinofile, $fileName);
        
        return ['archivo' => $fileName, 'archivo_nombre' => $file->getClientOriginalName()];
    }
 
    /*
    *
    * Elimina el archivo del servidor
    */
    public function delete_file ($name){
        if ($name){
            $filename = public_path('/files/requisicion/'.$name);
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
