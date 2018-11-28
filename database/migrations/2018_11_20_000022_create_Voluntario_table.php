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
            $table->string('direccion')->comment('Dirección de Voluntario');
            $table->string('telefono', 20)->unique()->comment('Teléfono de Voluntario');
            $table->string('email')->unique()->comment('Correo Electrónico de Voluntario');
            $table->timestamp('fechaCreada')->nullable()->comment('Fecha de Creación de Voluntario');//->useCurrent();
            $table->unsignedInteger('idTipoVoluntario')->nullable()->default(null)->comment('Identificador de Tipo de Voluntario');
            $table->unsignedInteger('idProfesion')->nullable()->default(null)->comment('Identificador de Profesión');
            //$table->unsignedInteger('idUsuario')->nullable()->default(null)->comment('Identificador de Usuario');

            $table->foreign('idTipoVoluntario')
                  ->references('idTipoVoluntario')->on('TipoVoluntario')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('idProfesion')
                  ->references('idProfesion')->on('Profesion')
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
