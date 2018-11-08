<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmoduloModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SubmoduloModulo', function (Blueprint $table) {
            $table->increments('idSubmoduloModulo')->comment('Identificador de SubmóduloMódulo');
            $table->dateTime('fecha')->comment('Fecha de SubmóduloMódulo');
            $table->tinyInteger('estado')->comment('Estado de SubmóduloMódulo');
            $table->unsignedInteger('idSubmodulo')->comment('Identificador de Submódulo');
            $table->unsignedInteger('idModulo')->comment('Identificador de Módulo');

            $table->foreign('idSubmodulo')
                  ->references('idSubmodulo')->on('Submodulo');
                  //->onDelete('cascade');
            $table->foreign('idModulo')
                  ->references('idModulo')->on('Modulo');
                  //->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SubmoduloModulo');
    }
}
