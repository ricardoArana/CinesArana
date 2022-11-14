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
            $table->unique(['cine_id', 'pelicula_id', 'hora_inicio']);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE proyeccions ADD COLUMN asientos_reservados integer[]');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
