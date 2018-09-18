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
            $table->increments('idModuloPerfil');
            $table->dateTime('fecha');
            $table->tinyInteger('estado');
            $table->unsignedInteger('idModulo');
            $table->unsignedInteger('idPerfil');

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
