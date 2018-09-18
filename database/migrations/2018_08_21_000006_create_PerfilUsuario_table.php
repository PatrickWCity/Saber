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
            $table->increments('idPerfilUsuario');
            $table->dateTime('fecha');
            $table->tinyInteger('estado');
            $table->unsignedInteger('idPerfil');
            $table->unsignedInteger('idUsuario');

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
