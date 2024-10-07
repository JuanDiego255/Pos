<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryUSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_u_s', function (Blueprint $table) {
            $table->id();
            $table->string('prefijo', 6);
            $table->string('descripcion');
            $table->string('codigo_telefono');
            $table->integer('estado');
            $table->string('signo');
            $table->string('moneda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_u_s');
    }
}
