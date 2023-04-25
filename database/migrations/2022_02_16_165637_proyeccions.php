<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Proyeccions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyeccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cine_id')->constrained('cines');
            $table->foreignId('pelicula_id')->constrained('peliculas');
            $table->smallInteger('sala');
            $table->string('hora_inicio');
            $table->string('fecha');
            $table->unique(['cine_id', 'pelicula_id', 'hora_inicio', 'fecha']);
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
        Schema::dropIfExists('proyeccions');

    }
}
