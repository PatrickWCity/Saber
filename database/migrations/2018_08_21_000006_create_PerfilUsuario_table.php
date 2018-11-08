<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PerfilUsuario', function (Blueprint $table) {
            $table->increments('idPerfilUsuario')->comment('Identificador de PerfilUsuario');
            $table->dateTime('fecha')->comment('Fecha de PerfilUsuario');
            $table->tinyInteger('estado')->comment('Estado de PerfilUsuario');
            $table->unsignedInteger('idPerfil')->comment('Identificador de Perfil');
            $table->unsignedInteger('idUsuario')->comment('Identificador de Usuario');

            $table->foreign('idPerfil')
                  ->references('idPerfil')->on('Perfil');
                  //->onDelete('cascade');
            $table->foreign('idUsuario')
                  ->references('idUsuario')->on('Usuario');
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
        Schema::dropIfExists('PerfilUsuario');
    }
}
