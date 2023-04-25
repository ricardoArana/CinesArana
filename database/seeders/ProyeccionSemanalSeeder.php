<?php

namespace Database\Seeders;

use App\Models\Cine;
use App\Models\Pelicula;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyeccionSemanalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cines = Cine::all();
        $peliculas = Pelicula::all();
        foreach ($cines as $cine) {
        foreach ($peliculas as $pelicula) {
            for ($i=0; $i < 8; $i++) {
                if (date('l', strtotime('+'. $i .' day',)) == "Sunday") {
                    DB::table("proyeccions")->insert([
                        'cine_id' => $cine->id,
                        'pelicula_id' => $pelicula->id,
                        'sala' => 1,
                        'hora_inicio' => '00:00',
                        'fecha' => date('d-m-Y', strtotime('+'. $i .' day', time()))
                    ]);}

                DB::table("proyeccions")->insert([
                        'cine_id' => $cine->id,
                        'pelicula_id' => $pelicula->id,
                        'sala' => 1,
                        'hora_inicio' => '11:00',
                        'fecha' => date('d-m-Y', strtotime('+'. $i .' day', time()))
            ]);
            DB::table("proyeccions")->insert([
                'cine_id' => $cine->id,
                'pelicula_id' => $pelicula->id,
                'sala' => 2,
                'hora_inicio' => '14:40',
                'fecha' => date('d-m-Y', strtotime('+'. $i .' day', time()))
    ]);
      }
    }}
    }
}
