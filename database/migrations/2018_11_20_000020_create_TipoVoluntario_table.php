<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoVoluntarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TipoVoluntario', function (Blueprint $table) {
            $table->increments('idTipoVoluntario')->comment('Identificador de Tipo de Voluntario');
            $table->string('nombre', 60)->unique()->comment('Nombre de Tipo de Voluntario');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Tipo de Voluntario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TipoVoluntario');
    }
}
