<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sensor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('estado');
            $table->string('caracteristica');
            $table->integer('invernadero_id_invernadero');
            $table->string('tiempo');
            $table->string('minimo');
            $table->string('maximo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor');
    }
}
