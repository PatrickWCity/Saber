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
            $table->increments('idExpositor');
            $table->string('run', 10)->nullable()->default(null)->unique();
            $table->string('nombre', 60);
            $table->string('appat', 60);
            $table->string('apmat', 60)->nullable()->default(null);
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
