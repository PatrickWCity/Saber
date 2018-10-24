<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->increments('idUsuario')->comment('Identificador de Usuario');
            $table->string('run', 10)->nullable()->default(null)->unique()->comment('RUN de Usuario');
            $table->string('nombre', 60)->comment('Nombre de Usuario');
            $table->string('appat', 60)->comment('Apellido Paterno de Usuario');
            $table->string('apmat', 60)->nullable()->default(null)->comment('Apellido Materno de Usuario');
            $table->string('direccion')->comment('Dirección de Usuario');
            $table->string('telefono', 20)->unique()->comment('Teléfono de Usuario');
            $table->string('email')->unique()->comment('Correo Electrónico de Usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Usuario');
    }
}
