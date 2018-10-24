<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TipoEvento', function (Blueprint $table) {
            $table->increments('idTipoEvento')->comment('Identificador de Tipo de Evento');
            $table->string('nombre', 60)->unique()->comment('Nombre de Tipo de Evento');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Tipo de Evento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TipoEvento');
    }
}
