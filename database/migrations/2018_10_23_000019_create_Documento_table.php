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
            $table->increments('idDocumento');
            $table->timestamps();
            
            $table->unsignedInteger('idTipoDocumento');

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
