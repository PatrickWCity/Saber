<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sede', function (Blueprint $table) {
            $table->increments('idSede');
            $table->string('nombre', 60)->unique();
            $table->string('descripcion')->nullable()->default(null);
            $table->string('ubicacion')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Sede');
    }
}
