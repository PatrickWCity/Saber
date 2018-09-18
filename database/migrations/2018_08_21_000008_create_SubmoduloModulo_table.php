<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmoduloModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SubmoduloModulo', function (Blueprint $table) {
            $table->increments('idSubmoduloModulo');
            $table->dateTime('fecha');
            $table->tinyInteger('estado');
            $table->unsignedInteger('idSubmodulo');
            $table->unsignedInteger('idModulo');

            $table->foreign('idSubmodulo')
                  ->references('idSubmodulo')->on('Submodulo');
                  //->onDelete('cascade');

            $table->foreign('idModulo')
                  ->references('idModulo')->on('Modulo');
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
        Schema::dropIfExists('SubmoduloModulo');
    }
}
