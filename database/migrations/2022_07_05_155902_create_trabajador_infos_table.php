<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadorInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajador_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            
            /*******/
            $table->foreignId('tipo_documento');
            $table->foreign('tipo_documento')->references('id')->on('tipo_documentos');
            /*******/

            $table->string('documento');

            /*******/
            $table->foreignId('pais_documento');
            $table->foreign('pais_documento')->references('id')->on('paises');
            $table->foreignId('dep_documento');
            $table->foreign('dep_documento')->references('id')->on('estados');
            $table->foreignId('ciu_documento');
            $table->foreign('ciu_documento')->references('id')->on('ciudades');
            /*******/

            /*******/
            $table->foreignId('pais_nacimiento');
            $table->foreign('pais_nacimiento')->references('id')->on('paises');
            $table->foreignId('dep_nacimiento');
            $table->foreign('dep_nacimiento')->references('id')->on('estados');
            $table->foreignId('ciu_nacimiento');
            $table->foreign('ciu_nacimiento')->references('id')->on('ciudades');        
            /*******/

            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('estado_civil');
            $table->string('grupo_sanguineo');
            $table->string('rh');
            $table->string('nacionalidad');
            $table->string('email');
            $table->string('email_alternativo')->nullable();
            /*******/
            $table->foreignId('pais_recidencia');
            $table->foreign('pais_recidencia')->references('id')->on('paises');
            $table->foreignId('dep_recidencia');
            $table->foreign('dep_recidencia')->references('id')->on('estados');
            $table->foreignId('ciu_recidencia');
            $table->foreign('ciu_recidencia')->references('id')->on('ciudades');        
            /*******/

            $table->string('direccion');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('nivel_academico');
            $table->boolean('induccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajador_infos');
    }
}
