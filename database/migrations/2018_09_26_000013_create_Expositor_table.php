<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpositorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Expositor', function (Blueprint $table) {
            $table->increments('idExpositor')->comment('Identificador de Expositor');
            $table->string('run', 10)->nullable()->default(null)->unique()->comment('RUN de Expositor');
            $table->string('nombre', 60)->comment('Nombre de Expositor');
            $table->string('appat', 60)->comment('Apellido Paterno de Expositor');
            $table->string('apmat', 60)->nullable()->default(null)->comment('Apellido Materno de Expositor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Expositor');
    }
}
