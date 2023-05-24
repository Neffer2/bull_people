<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
  
    public function up() 
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('prioridad')->nullable();

            $table->foreignId('tipo_oferta');
            $table->foreign('tipo_oferta')->references('id')->on('tipo_ofertas');

            $table->string('nombre',150);
            $table->text('descripcion');
            $table->date('fecha');
            $table->date('fecha_fin')->nullable();
            $table->decimal('sueldo', $precision = 10, $scale = 2)->nullable();
            $table->string('area')->nullable();
            $table->string('tipo_contrato')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('archivo')->nullable();
            $table->string('archivo_nombre')->nullable();
            $table->string('jornada')->nullable();
            $table->boolean('estado')->default('1');
            $table->timestamps();
        }); 
    }

    
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
