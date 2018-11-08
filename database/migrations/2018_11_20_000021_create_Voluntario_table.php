<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoluntarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Voluntario', function (Blueprint $table) {
            $table->increments('idVoluntario')->comment('Identificador de Voluntario');
            $table->string('run', 10)->nullable()->default(null)->unique()->comment('RUN de Voluntario');
            $table->string('nombre', 60)->comment('Nombre de Voluntario');
            $table->string('appat', 60)->comment('Apellido Paterno de Voluntario');
            $table->string('apmat', 60)->nullable()->default(null)->comment('Apellido Materno de Voluntario');
            $table->unsignedInteger('idTipoVoluntario')->nullable()->default(null)->comment('Identificador de Tipo de Voluntario');
            //$table->unsignedInteger('idUsuario')->nullable()->default(null)->comment('Identificador de Usuario');

            $table->foreign('idTipoVoluntario')
                  ->references('idTipoVoluntario')->on('TipoVoluntario')
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
        Schema::dropIfExists('Voluntario');
    }
}
