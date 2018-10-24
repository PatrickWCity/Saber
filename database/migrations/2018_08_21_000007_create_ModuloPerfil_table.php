<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuloPerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuloPerfil', function (Blueprint $table) {
            $table->increments('idModuloPerfil')->comment('Identificador de MóduloPerfil');
            $table->dateTime('fecha')->comment('Fecha de MóduloPerfil');
            $table->tinyInteger('estado')->comment('Estado de MóduloPerfil');
            $table->unsignedInteger('idModulo')->comment('Identificador de Módulo');
            $table->unsignedInteger('idPerfil')->comment('Identificador de Perfil');

            $table->foreign('idModulo')
                  ->references('idModulo')->on('Modulo');
                  //->onDelete('cascade');
                  
            $table->foreign('idPerfil')
                  ->references('idPerfil')->on('Perfil');
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
        Schema::dropIfExists('ModuloPerfil');
    }
}
