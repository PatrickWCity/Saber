<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoAccesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HistoricoAcceso', function (Blueprint $table) {
            $table->increments('idHistoricoAcceso')->comment('Identificador de HistoricoAcceso');
            $table->dateTime('fecha')->comment('Fecha de HistoricoAcceso');
            $table->tinyInteger('estado')->comment('Estado de HistoricoAcceso');
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
        Schema::dropIfExists('HistoricoAcceso');
    }
}
