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
            $table->increments('idHistoricoClave');
            $table->string('clave');
            $table->dateTime('fecha');
            $table->unsignedInteger('idUsuario');

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
        Schema::dropIfExists('HistoricoClave');
    }
}
