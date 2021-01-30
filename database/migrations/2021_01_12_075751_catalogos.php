<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Catalogos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogos', function (Blueprint $table) {
            $table->id();
            $table->longText('portada')->nullable();
            $table->string('titulo')->nullable();
            $table->string('autor')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('editorial')->nullable();
            $table->integer('anopub')->nullable();
            $table->string('isbn')->nullable();
            $table->string('ejemplar')->unique();
            $table->string('ubicacion')->nullable();
            $table->integer('disponibilidad')->default('1');
            $table->longText('prestadoa')->nullable();
            $table->date('fechadev')->nullable();
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
        Schema::dropIfExists('catalogos');
    }
}
