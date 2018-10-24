<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoNoticiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TipoNoticia', function (Blueprint $table) {
            $table->increments('idTipoNoticia')->comment('Identificador de Tipo de Noticia');
            $table->string('nombre', 60)->unique()->comment('Nombre de Tipo de Noticia');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Tipo de Noticia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TipoNoticia');
    }
}
