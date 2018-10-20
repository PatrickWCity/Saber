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
            $table->increments('idNoticia');
            $table->string('titulo', 60)->unique();
            $table->longText('contenido');
            $table->string('imagenPortada');
            $table->timestamps();
            $table->unsignedInteger('idTipoNoticia');
            $table->unsignedInteger('idUsuario');
            
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
