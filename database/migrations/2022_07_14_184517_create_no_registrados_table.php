<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoRegistradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('no_registrados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('documento')->nullable();
            $table->string('email')->nullable();
            $table->string('perfil')->nullable();
            $table->string('hoja_vida')->nullable();
            $table->string('contacto_1')->nullable();
            $table->string('contacto_2')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('cargo')->nullable();
            $table->string('aspiracion')->nullable();
            $table->string('estado')->nullable();
            $table->string('descripcion_estado')->nullable();
            $table->string('ex_bull')->nullable();
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
        Schema::dropIfExists('no_registrados');
    }
}
