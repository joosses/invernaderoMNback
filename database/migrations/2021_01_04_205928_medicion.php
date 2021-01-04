<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Medicion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('valor');
            $table->string('tiempo');
            $table->integer('chipid')->unsigned();
            $table->integer('nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicion');
    }
}
