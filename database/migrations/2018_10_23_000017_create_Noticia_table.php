<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Noticia', function (Blueprint $table) {
            $table->increments('idNoticia')->comment('Identificador de Noticia');
            $table->string('titulo')->unique()->comment('Titulo de Noticia');
            $table->longText('contenido')->comment('Contenido de Noticia');
            $table->string('imagenPortada')->default('default.png')->comment('Imagen de Portada de Noticia');
            $table->timestamp('fechaCreada')->nullable()->comment('Fecha de Creación de Noticia');//->useCurrent();
            $table->timestamp('fechaActualizada')->nullable()->comment('Fecha de Actualización de Noticia');//->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('idTipoNoticia')->nullable()->default(null)->comment('Identificador de Tipo de Noticia');
            //$table->unsignedInteger('idUsuario')->nullable()->default(null)->comment('Identificador de Usuario');
            
            $table->foreign('idTipoNoticia')
                  ->references('idTipoNoticia')->on('TipoNoticia')
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
        Schema::dropIfExists('Noticia');
    }
}
