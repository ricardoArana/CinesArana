<?php

namespace App\Http\Livewire;

use App\Models\Cine;
use App\Models\Localidad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Counter extends Component
{
    public $localidadLive = 'Sanlúcar de Bda';
    public $cineLive = 'cine1';
    public $cont = 0;
    public $boolColor = false;

    public function cineFav(){ //Pone el cine favorito en el option de la pagina principal
        if ($this->cont < 1) {
            if (Auth::user() && Auth::user()->cine_fav == 'nada' || Auth::user()->cine_fav == '') {

                $this->cineLive = 'cine1';
            }
            else {
                if(Auth::user()){
            $this->cineLive = Auth::user()->cine_fav;
            }}
            $this->localidadLive = Cine::where('nombre', $this->cineLive)->get()[0]
            ->localidad->nombre;

            $this->cont++;
        }
    }



    public function render()
    {

        $this->cineFav();
        $cines = Localidad::where('nombre', $this->localidadLive)->get()[0]->cines;
        $cineSelect= Cine::where('nombre', $this->cineLive)->get()[0];
        return view('livewire.counter', [
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
