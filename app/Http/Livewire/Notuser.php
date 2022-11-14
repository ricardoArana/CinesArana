<?php

namespace App\Http\Livewire;

use App\Models\Cine;
use App\Models\Localidad;
use Livewire\Component;

class Notuser extends Component
{
    public $localidadLive = 'Sanlúcar de Bda';
    public $cineLive = 'cine1';

    public function render()
    {
        $cines = Localidad::where('nombre', $this->localidadLive)->get()[0]->cines;
        $cineSelect= Cine::where('nombre', $this->cineLive)->get()[0];
        return view('livewire.notuser', [
            'localidads' => Localidad::all(),
            'cines' => $cines,
            'cineSelect' => $cineSelect,
            'peliculas' => $this->peliculasByProyeccion(),
        ]);
    }
    public function peliculasByProyeccion()
    {
        $proyecciones = Cine::where('nombre', $this->cineLive)->get()[0]->proyecciones;
        $peliculasColl = collect([]);
        for ($i=0; $i < count($proyecciones); $i++) {
            $peliculasColl->push($proyecciones[$i]->pelicula);
        }
        return $peliculasColl->unique();
    }

}
