<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invernadero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invernadero', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cultivo');
            $table->string('caracteristicas');
            $table->string('placa');
            $table->integer('usuario_id_usuario');
            $table->integer('chipid');
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invernadero');
    }
}
