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
            $table->increments('idAcceso');
            $table->string('username', 20)->unique();
            $table->string('password');
            $table->integer('diasClave');
            $table->dateTime('fechaCaducidad');
            $table->tinyInteger('estadoInicial');
            $table->tinyInteger('estadoAcceso');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto')->default('default.png');
            $table->rememberToken();
            $table->unsignedInteger('idUsuario')->unique();

            $table->foreign('idUsuario')
                  ->references('idUsuario')->on('Usuario');
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
        Schema::dropIfExists('Acceso');
    }
}
