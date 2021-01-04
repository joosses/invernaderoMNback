<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Actuador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actuador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado');
            $table->string('nombre');
            $table->string('caracteristica');
            $table->integer('invernadero_id_invernadero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actuador');
    }
}
