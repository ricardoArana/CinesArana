<?php

namespace App\Http\Livewire;

use App\Models\Cine;
use App\Models\Localidad;
use Livewire\Component;

class Notuser extends Component
{
    public $localidadLive = 'Sanlúcar de Bda';
    public $cineLive = 'Cine Estelar';
    public $fechaLive ='24-04-2023';
    public $cont = 0;
    public $contD = 0;
    public function render()
    {
        if ($this->contD == 0) {
            $this->fechaLive = date('d-m-Y', strtotime('+1 day', time()));
            $this->contD++;
        }
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
