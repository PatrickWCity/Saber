<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Evento', function (Blueprint $table) {
            $table->increments('idEvento')->comment('Identificador de Evento');
            $table->string('nombre', 60)->unique()->comment('Nombre de Evento');
            $table->string('descripcion')->nullable()->default(null)->comment('Descripción de Evento');
            $table->dateTime('fechaInicio')->comment('Fecha de Inicio de Evento');
            $table->dateTime('fechaTermino')->comment('Fecha de Termino de Evento');
            $table->unsignedInteger('idTipoEvento')->nullable()->default(null)->comment('Identificador de Tipo de Evento');
            $table->unsignedInteger('idSede')->nullable()->default(null)->comment('Identificador de Sede');
            $table->unsignedInteger('idArea')->nullable()->default(null)->comment('Identificador de Área');
            $table->unsignedInteger('idExpositor')->nullable()->default(null)->comment('Identificador de Expositor');
            //$table->unsignedInteger('idUsuario')->nullable()->default(null)->comment('Identificador de Usuario');

            $table->foreign('idTipoEvento')
                  ->references('idTipoEvento')->on('TipoEvento')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('idSede')
                  ->references('idSede')->on('Sede')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('idArea')
                  ->references('idArea')->on('Area')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('idExpositor')
                  ->references('idExpositor')->on('Expositor')
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
        Schema::dropIfExists('Evento');
    }
}
