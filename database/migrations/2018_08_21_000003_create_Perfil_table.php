<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Perfil', function (Blueprint $table) {
            $table->increments('idPerfil')->comment('Identificador de Perfil');
            $table->string('nombre', 60)->unique()->comment('Nombre de Perfil');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Perfil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Perfil');
    }
}
