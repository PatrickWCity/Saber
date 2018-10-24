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
            $table->string('titulo', 60)->unique()->comment('Titulo de Noticia');
            $table->longText('contenido')->comment('Contenido de Noticia');
            $table->string('imagenPortada')->comment('Imagen de Portada de Noticia');
            $table->timestamp('fechaCreada')->nullable()->comment('Fecha de Creación de Noticia');
            $table->timestamp('fechaActualizada')->nullable()->comment('Fecha de Actualización de Noticia');
            $table->unsignedInteger('idTipoNoticia')->comment('Identificador de Tipo de Noticia');
            $table->unsignedInteger('idUsuario')->comment('Identificador de Usuario');
            
            $table->foreign('idTipoNoticia')
                  ->references('idTipoNoticia')->on('TipoNoticia');
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
        Schema::dropIfExists('Noticia');
    }
}
