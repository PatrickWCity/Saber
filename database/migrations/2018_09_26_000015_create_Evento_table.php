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
            $table->increments('idEvento');
            $table->string('nombre', 60)->unique();
            $table->string('descripcion')->nullable()->default(null);
            $table->dateTime('fechaInicio');
            $table->dateTime('fechaTermino');

            $table->unsignedInteger('idTipoEvento')->nullable()->default(null);
            $table->unsignedInteger('idSede')->nullable()->default(null);
            $table->unsignedInteger('idArea')->nullable()->default(null);
            $table->unsignedInteger('idExpositor')->nullable()->default(null);

            $table->foreign('idTipoEvento')
                  ->references('idTipoEvento')->on('TipoEvento');
                  //->onDelete('cascade');
            $table->foreign('idSede')
                  ->references('idSede')->on('Sede');
                  //->onDelete('cascade');
            $table->foreign('idArea')
                  ->references('idArea')->on('Area');
                  //->onDelete('cascade');
            $table->foreign('idExpositor')
                  ->references('idExpositor')->on('Expositor');
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
        Schema::dropIfExists('Evento');
    }
}
