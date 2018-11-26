<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Profesion', function (Blueprint $table) {
            $table->increments('idProfesion')->comment('Identificador de Profesión');
            $table->string('nombre', 60)->unique()->comment('Nombre de Profesión');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Profesión');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Profesion');
    }
}
