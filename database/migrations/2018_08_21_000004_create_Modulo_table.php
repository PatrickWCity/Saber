<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Modulo', function (Blueprint $table) {
            $table->increments('idModulo')->comment('Identificador de Módulo');
            $table->string('nombre', 60)->unique()->comment('Nombre de Módulo');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Módulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Modulo');
    }
}
