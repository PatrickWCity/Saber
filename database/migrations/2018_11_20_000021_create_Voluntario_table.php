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
            $table->increments('idVoluntario');
            
            $table->unsignedInteger('idTipoVoluntario');

            $table->foreign('idTipoVoluntario')
                  ->references('idTipoVoluntario')->on('TipoVoluntario');
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
        Schema::dropIfExists('Voluntario');
    }
}
