<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoClaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HistoricoClave', function (Blueprint $table) {
            $table->increments('idHistoricoClave')->comment('Identificador de HistoricoClave');
            $table->string('clave')->comment('Clave Anterior de Usuario');
            $table->dateTime('fecha')->comment('Fecha de Cambio de Clave');
            $table->unsignedInteger('idUsuario')->comment('Identificador de Usuario');

            $table->foreign('idUsuario')
                  ->references('idUsuario')->on('Usuario')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HistoricoClave');
    }
}
