<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmoduloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Submodulo', function (Blueprint $table) {
            $table->increments('idSubmodulo')->comment('Identificador de Submódulo');
            $table->string('nombre', 60)->unique()->comment('Nombre de Submódulo');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Submódulo');
            $table->string('ubicacion')->unique()->comment('Ubicación de Submódulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Submodulo');
    }
}
