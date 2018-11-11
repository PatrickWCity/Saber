<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Documento', function (Blueprint $table) {
            $table->increments('idDocumento')->comment('Identificador de Documento');
            $table->string('nombre', 60)->unique()->comment('Nombre de Documento');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Documento');
            $table->string('archivo')->unique()->comment('Archivo de Documento');
            $table->timestamp('fechaCreada')->nullable()->comment('Fecha de Creación de Documento');
            $table->timestamp('fechaActualizada')->nullable()->comment('Fecha de Actualización de Documento');
            $table->unsignedInteger('idTipoDocumento')->nullable()->default(null)->comment('Identificador de Tipo de Documento');
            //$table->unsignedInteger('idUsuario')->nullable()->default(null)->comment('Identificador de Usuario');

            $table->foreign('idTipoDocumento')
                  ->references('idTipoDocumento')->on('TipoDocumento')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //$table->foreign('idUsuario')
            //      ->references('idUsuario')->on('Usuario')
            //      ->onDelete('cascade')
            //      ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Documento');
    }
}
