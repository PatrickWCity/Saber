<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Acceso', function (Blueprint $table) {
            $table->increments('idAcceso')->comment('Identificador de Acceso');
            $table->string('username', 20)->unique()->comment('Username de Acceso del Usuario');
            $table->string('password')->comment('Clave de Acceso del Usuario');
            $table->integer('diasClave')->comment('Días de Clave de Acceso del Usuario');
            $table->dateTime('fechaCaducidad')->comment('Fecha de Caducidad de Clave de Acceso del Usuario');
            $table->tinyInteger('estadoInicial')->comment('Estado Inicial de Acceso del Usuario');
            $table->timestamp('estadoAcceso')->nullable()->comment('Estado de Acceso del Usuario'); // para deshabilitar
            $table->string('email')->unique()->comment('Correo Electrónico de Acceso del Usuario');
            $table->timestamp('email_verified_at')->nullable()->comment('Fecha de Verificación de Acceso del Usuario por Correo Electrónico');
            $table->string('foto')->default('default.png')->comment('Foto de Perfil del Usuario');
            $table->rememberToken()->comment('Token de Recordar de Acceso del Usuario');
            $table->unsignedInteger('idUsuario')->unique()->comment('Identificador del Usuario');

            $table->foreign('idUsuario')
                  ->references('idUsuario')->on('Usuario')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Acceso');
    }
}
