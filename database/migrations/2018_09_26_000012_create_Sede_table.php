<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sede', function (Blueprint $table) {
            $table->increments('idSede')->comment('Identificador de Sede');
            $table->string('nombre', 60)->unique()->comment('Nombre de Sede');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Sede');
            $table->string('ubicacion')->unique()->comment('Ubicación de Sede');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Sede');
    }
}
