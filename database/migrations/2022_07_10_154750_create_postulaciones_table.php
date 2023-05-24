<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('oferta_id');
            $table->foreign('oferta_id')->references('id')->on('ofertas');
            $table->text('hoja_vida');
            $table->text('descripcion'); 
            $table->text('contacto_1');
            $table->text('contacto_2')->nullable();
            $table->text('ciudad'); 
            $table->String('cargo')->nullable();
            $table->text('aspiracion');
            $table->boolean('estado')->nullable();
            $table->text('descripcion_estado')->nullable();
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
        Schema::dropIfExists('postulaciones');
    }
}
