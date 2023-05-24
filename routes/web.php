<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\PostulacionesController; 
use App\Http\Controllers\RequisicionesController; 
use App\Http\Controllers\TrabajadoresController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\MailerController;
use App\Http\Controllers\OfertaRegisterController;
use App\Http\Controllers\AdminController; 

 

Auth::routes(); 
// root_empleos   
// zZ4bPJ~Q3b]c   
//Auth::routes(['register' => false]); //para que esto funcione debo quitar el Auth::routes(); y dejar este

// Route::get("/home", function(){
//     return redirect('oferta/1');
// });   

Route::get('/home/{filtro?}/{name?}', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');  
// Route::get('/escritorio', [App\Http\Controllers\HomeController::class, 'panel_postulantes'])->name('escritorio');  

Route::resource('ofertas', OfertasController::class); 
 
Route::get('oferta/{id}', [HomeController::class, 'showOferta'])->name('oferta');
Route::post('postular/{id}', [PostulacionesController::class, 'store'])->name('postular'); 
Route::get('postulaciones_admin/', [PostulacionesController::class, 'index'])->name('postulaciones_admin'); 
Route::get('postulados/{oferta_id}', [PostulacionesController::class, 'show_postulados'])->name('postulados');
Route::get('postulado/{oferta_id}', [PostulacionesController::class, 'show_postulado'])->name('postulado');
Route::get('postulado_no_registrado/{oferta_id}', [PostulacionesController::class, 'show_postulado_no_registrado'])->name('postulado_no_registrado');
Route::get('postulados_db', [PostulacionesController::class, 'db_general'])->name('postulados_db');  
Route::get('no_registrados', [PostulacionesController::class, 'no_registrados'])->name('no_registrados');  
Route::post('import', [PostulacionesController::class, 'import'])->name('import');   
// Route::post('import', [PostulacionesController::class, 'import'])->name('import');   

Route::post('postulado/{id}', [PostulacionesController::class, 'store'])->name('postular');  
Route::post('postulado/cambio_estado/{id}', [PostulacionesController::class, 'cambio_estado'])->name('cambio_estado');

/* administrador */  
Route::get('/trabajadores', [TrabajadoresController::class, 'index'])->name('trabajadores');
Route::get('/trabajador/{id}', [TrabajadoresController::class, 'show'])->name('trabajadores_show');
Route::view('/nuevo_trabajador', 'cpanel_adm.trabajadores.new_trabajador')->name('nuevo_trabajador');
Route::post('/trabajador', [TrabajadoresController::class, 'store'])->name('store_trabajador');
/* --- */ 

/* Trabajador */  
Route::resource('requisiciones', RequisicionesController::class);  
Route::view('/induccion', 'cpanel_trabajador.induccion.inicio');
Route::post('/induccion_action/{id}', [TrabajadoresController::class, 'induccion_action'])->name('induccion');
Route::get('hoja_vida', [TrabajadoresController::class, 'get_hoja_vida'])->name('hoja_vida');
Route::post('validate_hoja_vida/{id}', [TrabajadoresController::class, 'validate_hoja_vida'])->name('validate_hoja_vida'); 
Route::post('hoja_vida', [TrabajadoresController::class, 'hoja_vida'])->name('hoja_vida'); 
Route::post('update_hoja_vida', [TrabajadoresController::class, 'update_hoja_vida'])->name('update_hoja_vida'); 
/* --- */ 
 
/* HTTTP */
Route::post('/get_estados', [TrabajadoresController::class, 'get_estados']);
Route::post('/get_ciudades', [TrabajadoresController::class, 'get_ciudades']);
Route::post('/get_cargos_postulados', [HomeController::class, 'get_cargos_postulados']);  
Route::post('/get_ciudades_postulados', [HomeController::class, 'get_ciudades_postulados']);
Route::post('/get_cargos_postulados_nr', [HomeController::class, 'get_cargos_postulados_nr']);
Route::post('/get_ciudades_postulados_nr', [HomeController::class, 'get_ciudades_postulados_nr']);
/* --- */

Route::get("oferta-register/{id}", [OfertaRegisterController::class, "show"]);
Route::post("oferta-register", [OfertaRegisterController::class, 'register']);  

/* Perfil */
Route::get("mi-perfil", [HomeController::class, "show_perfil"])->name('mi-perfil');
Route::post("update_datos", [HomeController::class, "actualizar_datos"])->name('update_datos');
Route::post("update_pass", [HomeController::class, "cambio_contrase«Ğa"])->name('update_pass');  
/* --- */

   