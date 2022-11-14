<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreCineRequest;
use App\Http\Requests\UpdateCineRequest;
use App\Models\Cine;
use App\Models\Localidad;
use App\Models\Pelicula;
use App\Models\Proyeccion;
use App\Models\Reserva;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;

class CineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notuser()
    {
        return view('nousuario', [
            'localidads' => Localidad::all(),
            'cines' => Cine::all(),
        ]);
    }

    public function index()
    {
        return view('dashboard', [
            'localidads' => Localidad::all(),
            'cines' => Cine::all(),
        ]);
    }

    public function peliculas()
    {
        return view('peliculas', [
            'peliculas' => Pelicula::all(),
        ]);
    }

    public function cines()
    {
        return view('cines', [
            'cines' => Cine::all(),
        ]);
    }
    public function preguntas()
    {
        return view('preguntas');
    }

    public function reserva(Proyeccion $proyeccion)
    {
        return view('reserva', [
            'peliculas' => Pelicula::all(),
            'proyeccion' => $proyeccion,
            'reservas' => Reserva::all()->where('cine_id', $proyeccion->cine->id)
                ->where('pelicula_id', $proyeccion->pelicula->id)
                ->where('hora_inicio', $proyeccion->hora_inicio)
        ]);
    }

    public function reservar()
    {
        if (empty(Auth::user())) {
            return redirect('/')->with('error', 'Para reservar debes iniciar sesión');
        }

        $validado = request()->validate([
            'sala' => 'required|string',
            'hora_inicio' => 'required|string',
            'pel_id' => 'required|string',
            'cine_id' => 'required|string',
            'asientos' => 'required|string'
        ]);



        //selecciono el usuario actual
        $user = Auth::user();

        $asientosArray = explode(",", $validado['asientos']);
        //Hago tantas reservas como asientos haya
        for ($i = 0; $i < sizeof($asientosArray); $i++) {
            $reserva = Reserva::create([
                'user_id' => $user->id,
                'cine_id' => $validado['cine_id'],
                'pelicula_id' => $validado['pel_id'],
                'hora_inicio' => $validado['hora_inicio'],
                'sala' => $validado['sala'],
                'asiento' => $asientosArray[$i]
            ]);
            $reserva->save();
        }

        return redirect('/')->with('success', 'Reserva realizada con éxito');
    }

    public function miPerfil()
    {
        if (empty(Auth::user())) {
            return redirect('/')->with('error', 'Ha ocurrido un error');
        }
        return view('miPerfil', [
            'cines' => Cine::all(),
            'user' => Auth::user(),
            'reservas' => Auth::user()->reservas,
        ]);
    }


    public function cambiarCineFav()
    {
        $validado = request()->validate([
            'cine' => 'required|string',
        ]);
        $user = Auth::user();
        $user->cine_fav = $validado['cine'];
        $user->save();
        return redirect('/miPerfil')->with('success', 'cine favorito actualizado con éxito');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cine  $cine
     * @return \Illuminate\Http\Response
     */
    public function show(Cine $cine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cine  $cine
     * @return \Illuminate\Http\Response
     */
    public function edit(Cine $cine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCineRequest  $request
     * @param  \App\Models\Cine  $cine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCineRequest $request, Cine $cine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cine  $cine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cine $cine)
    {
        //
    }
}
