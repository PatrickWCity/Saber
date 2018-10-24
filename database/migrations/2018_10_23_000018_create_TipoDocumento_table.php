<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TipoDocumento', function (Blueprint $table) {
            $table->increments('idTipoDocumento')->comment('Identificador de Tipo de Documento');
            $table->string('nombre', 60)->unique()->comment('Nombre de Tipo de Documento');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Tipo de Documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TipoDocumento');
    }
}
