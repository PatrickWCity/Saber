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
            //$table->timestamp('created_at')->nullable()->comment('my comment');
            //$table->timestamp('updated_at')->nullable()->comment('my comment');
            
            $table->unsignedInteger('idTipoDocumento')->comment('Identificador de Tipo de Documento');

            $table->foreign('idTipoDocumento')
                  ->references('idTipoDocumento')->on('TipoDocumento');
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
        Schema::dropIfExists('Documento');
    }
}
