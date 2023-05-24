<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Postulaciones;
use App\Models\Paises;
use App\Models\User;
use App\Models\Requisiciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
 
class HomeController extends Controller 
{
    public function index($filtro=null, $value=null)
    {     
        if ($filtro != null && $filtro != "recientes" && $filtro != "antiguas"){
            $Ofertas = $this->set_filtros($filtro, $value);
        }else {
            switch($filtro){
                case "recientes":
                    $Ofertas = Oferta::where('estado', 1)->whereDate('fecha', '>=', Carbon::now()->toDateString())->orderBy('created_at', 'DESC')->get();
                    break;
                case "antiguas":
                    $Ofertas = Oferta::where('estado', 1)->whereDate('fecha', '>=', Carbon::now()->toDateString())->orderBy('created_at', 'ASC')->get();
                    break;
                default:
                    $Ofertas = $Ofertas = Oferta::where('estado', 1)->whereDate('fecha', '>=', Carbon::now()->toDateString())->orderBy('created_at', 'DESC')->get();
                    break;
            }
        }
        return view('layouts.app', ['ofertas' => $Ofertas, 'filtros' => $this->get_fitros()]);
    }


    public function dashboard()
    {    
        if (Auth::check()) {
            if (auth()->user()->tipo_user == 1){ 
                // TODO: Validacion ususrio
                $count_ofertas = Oferta::where('estado', 1)->get()->count();
                $count_postulaciones = Postulaciones::count();
                $count_trabajadores = User::where('tipo_user', 3)->get()->count();
                $count_requisiciones = Requisiciones::count();
                $post_hoy = Postulaciones::whereDate('created_at', date('Y-m-d'))->count();
                $post_ayer = Postulaciones::whereBetween('created_at', [date('Y-m-d',strtotime("-2 days")), date('Y-m-d',strtotime("+1 days"))])->count();
                $post_sem = Postulaciones::whereBetween('created_at', [date('Y-m-d',strtotime("-7 days")), date('Y-m-d',strtotime("+1 days"))])->count();
             
                return view('cpanel_adm.inicio', ['count_ofertas' => $count_ofertas, 'count_postulaciones' => $count_postulaciones,
                    'post_hoy' => $post_hoy, 'post_ayer' => $post_ayer, 'post_sem' => $post_sem, 'count_trabajadores' => $count_trabajadores, 'count_requisiciones' => $count_requisiciones]);
            }elseif (auth()->user()->tipo_user == 2) {     
                $count_enviadas = Postulaciones::where('user_id', auth()->user()->id)
                                                ->where('estado', NULL)->count();
                $count_proceso = Postulaciones::where('user_id', auth()->user()->id)
                                                ->where('estado', 1)->count();
                $count_descartado = Postulaciones::where('user_id', auth()->user()->id)
                                                ->where('estado', 0)->count();

                $postulaciones = Postulaciones::where('user_id', auth()->user()->id)->get();
                return view('cpanel_postulante.inicio', ['postulaciones' => $postulaciones, 'count_enviadas' => $count_enviadas, 'count_proceso' => $count_proceso, 'count_descartado' => $count_descartado]);
            }elseif (auth()->user()->tipo_user == 3) {
                $count_enviadas = Postulaciones::where('user_id', auth()->user()->id)
                                                ->where('estado', NULL)->count();
                $count_proceso = Postulaciones::where('user_id', auth()->user()->id)
                                                ->where('estado', 1)->count();
                $count_descartado = Postulaciones::where('user_id', auth()->user()->id)
                                                ->where('estado', 0)->count();
 
                $postulaciones = Postulaciones::where('user_id', auth()->user()->id)->get();
                return view('cpanel_trabajador.inicio', ['postulaciones' => $postulaciones, 'count_enviadas' => $count_enviadas, 'count_proceso' => $count_proceso, 'count_descartado' => $count_descartado]);
            }
        }else{
            return redirect()->route('home');
        }
    } 

    /** 
     * admin donut chart data.
     */
    public function get_cargos_postulados(){
        $cargos_postulados = DB::select('SELECT cargo, COUNT(cargo) as cantidad FROM postulaciones GROUP BY cargo');
        return response()->json(['cargos_postulados' => $cargos_postulados]);
    }

    /** 
     * admin donut chart data.
     */
    public function get_cargos_postulados_nr(){
        $cargos_postulados = DB::select('SELECT cargo, COUNT(cargo) as cantidad FROM no_registrados GROUP BY cargo');
        return response()->json(['cargos_postulados' => $cargos_postulados]);
    }


    /** 
     * admin bart chart data.
     */
    public function get_ciudades_postulados(){
        $ciudades_postulados = DB::select('SELECT ciudad, COUNT(ciudad) as cantidad FROM postulaciones GROUP BY ciudad ORDER BY cantidad DESC');
        return response()->json(['ciudades_postulados' => $ciudades_postulados]);
    }

    /** 
     * admin bart chart data.
     */
    public function get_ciudades_postulados_nr(){
        $ciudades_postulados = DB::select('SELECT ciudad, COUNT(ciudad) as cantidad FROM no_registrados GROUP BY ciudad ORDER BY cantidad DESC');
        return response()->json(['ciudades_postulados' => $ciudades_postulados]);
    }

    /** 
     * Display the specified resource.
     *
     * @param  \App\Models\Oferta  $ofertas
     * @return \Illuminate\Http\Response
     */
    public function showOferta($id)
    {
        $Oferta = Oferta::find($id);
        // A���adido por peticion 
        $paises = Paises::all();
        
        return view('layouts.oferta', ['oferta' => $Oferta, 'paises' => $paises]);
    }

    /**
     * Trae el contenido de los filtros ya agrupados
     */
    public function get_fitros (){
        $ubicaciones = DB::select('SELECT ubicacion, count(*) as conteo FROM ofertas WHERE tipo_oferta = 1 AND estado = 1 AND fecha >= CURDATE() GROUP BY ubicacion');
        $jornadas = DB::select('SELECT jornada, count(*) as conteo FROM ofertas WHERE tipo_oferta = 1 AND estado = 1 AND fecha >= CURDATE() GROUP BY jornada');
        $tipo_contratos = DB::select('SELECT tipo_contrato, count(*) as conteo FROM ofertas WHERE tipo_oferta = 1 AND estado = 1 AND fecha >= CURDATE() GROUP BY tipo_contrato;');
        $prioridad = DB::select('SELECT prioridad, count(*) as conteo FROM ofertas WHERE tipo_oferta = 1 AND estado = 1 AND fecha >= CURDATE() GROUP BY prioridad;');
        $area = DB::select('SELECT area, count(*) as conteo FROM ofertas WHERE tipo_oferta = 1 AND estado = 1 AND fecha >= CURDATE() GROUP BY area;');
        
        $filtros = array(
            'ubicaciones' => $ubicaciones,
            'jornada' => $jornadas,
            'tipo_contrato' => $tipo_contratos,
            'prioridad' => $prioridad,
            'area' => $area
        );
        return $filtros;
    }  

    /**
     * Aplica los filtros 
     */
    public function set_filtros ($filtro, $value){
        $Ofertas = Oferta::where('estado', 1)->whereDate('fecha', '>=', Carbon::now()->toDateString())->where($filtro, str_replace('_', ' ',$value))->get();
        return $Ofertas; 
    }


    /*
        * Muestra la información del perfil
    */
    public function show_perfil () {
        return view('auth.perfil.inicio'); 
    }

    /*
        * Actualiza los datos del perfil 
    */
    public function actualizar_datos (Request $request) {
        $user = User::find(auth()->user()->id);
        if ($request->name != auth()->user()->name){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
            $user->name = $request->name;
        }
        if ($request->documento != auth()->user()->documento){
            $request->validate([
                'documento' => ['required', 'unique:users'],
            ]);
            $user->documento = $request->documento;
        }
        if ($request->email != auth()->user()->email){
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
            $user->email = $request->email;
        }
        if ($request->avatar){
            $request->validate([
                'avatar' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048']
            ]);
            $user->avatar = $this->upload_file($request->avatar);
        }
        $user->update(); 
        return redirect()->route('mi-perfil')->with('success', 'Datos guardados exitosamente');
    }   

    /*
        * Cambio de contraseña usuario
    */
    public function cambio_contraseña (Request $request) {
        $user = User::find(auth()->user()->id);
        
        if (Hash::check($request->old_password, auth()->user()->password)){
            $user->password = Hash::make($request->new_password);
            $user->update();
            return redirect()->route('mi-perfil')->with('success', 'Datos guardados exitosamente');
        }
        else{
            return redirect()->back()->withErrors('La contraseña es incorrecta');
        }
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
