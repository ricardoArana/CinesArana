<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreCineRequest;
use App\Http\Requests\UpdateCineRequest;
use App\Models\Cine;
use App\Models\Localidad;
use App\Models\Pelicula;
use App\Models\Proyeccion;
use App\Models\Reserva;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function createPelicula()
    {
        return view('createPelicula');
    }

    public function createCine()
    {
        return view('createCine', [
            'localidads' => Localidad::all(),
            'cines' => Cine::all(),
        ]);
    }

    public function crearHorario($proyeccion)
    {
        return view('crearHorario', [
            'proyeccion' => Proyeccion::where('id', $proyeccion)->get()[0],
        ]);
    }

    public function storePelicula(Request $request){


        $request->validate([
            'titulo' => 'required',
            'sinopsis' => 'required',
            'duracion' => 'required',
            'imagen' => 'required'
        ]);

        $data= new Pelicula();
        $data->titulo = $request->titulo;
        $data->sinopsis = $request->sinopsis;
        $data->duracion = $request->duracion;

        if($request->file('imagen')){
            $file= $request->file('imagen');
            $filename= 'img/'.date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('img'), $filename);
            $data->url= $filename;
        }

        $data->save();
        return redirect('/peliculas')->with('success', 'Pelicula añadida');;

    }

    public function storeCine(Request $request){


        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'asientos' => 'required',
            'mapa' => 'required',
            'localidad' => 'required'
        ]);

        $data= new Cine();
        $data->nombre = $request->nombre;
        $data->asientos = $request->asientos;
        $localidad = Localidad::where('nombre', $request->localidad)->get()[0]->id;
        $data->localidad_id = $localidad;
        $data->descripcion = $request->descripcion;
        $data->mapa = $request->mapa;


        $data->save();
        return redirect('/cines')->with('success', 'Cine añadido');;

    }

        public function usuarios(Request $request)
    {
        if (Auth::user()->rol != 'admin') {
            return redirect('/')->with('error', 'Has intentado acceder a una función de administrador');
        }

        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('codigo', 'LIKE', "%$query%")
            ->get();

        return view('usuarios', compact('users', 'query'));
    }

    public function updateUsuario(Request $request, $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'rol' => 'required'
        ]);

        $usuario = User::where('id', $user)->first();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->rol = $request->rol;
        $usuario->save();


        return redirect('/usuarios')->with('success',  'Usuario actualizado');
    }

    public function deleteUsuario($user)
    {

        $usuario = User::where('id', $user)->first();
        $usuario->reservas()->delete();
        $usuario->delete();


        return redirect('/usuarios')->with('success',  'Usuario borrado con éxito');
    }

    public function deletePelicula($peliculaid)
    {

        $pelicula = Pelicula::where('id', $peliculaid)->first();
        $pelicula->reservas()->delete();
        $pelicula->proyecciones()->delete();
        $pelicula->delete();


        return redirect('/peliculas')->with('success',  'Película borrada con éxito');
    }

    public function deleteCine($cineid)
    {

        $cine = Cine::where('id', $cineid)->first();
        $cine->reservas()->delete();
        $cine->proyecciones()->delete();
        $cine->delete();


        return redirect('/cines')->with('success',  'Cine borrado con éxito');
    }

    public function modificarUsuario($user)
    {
        return view('modificarUsuario', [
            'usuario' => User::where('id', $user)->first()]);
    }

    public function reservasUsuario($user)
    {
        return view('reservasUsuario', [
            'usuario' => User::where('id', $user)->first(),
            'reservas' => User::where('id', $user)->first()->reservas]);
    }

    public function peliculas()
    {
        return view('peliculas', [
            'peliculas' => Pelicula::all(),
        ]);
    }
    public function modificarPelicula($peli)
    {
        return view('modificarPelicula', [
            'pelicula' => Pelicula::where('id', $peli)->first()]);
    }

    public function updatePelicula(Request $request, $peli)
    {
        $request->validate([
            'titulo' => 'required',
            'sinopsis' => 'required',
            'duracion' => 'required',
            'imagen' => '',
        ]);

        $pelicula = Pelicula::where('id', $peli)->first();
        $pelicula->titulo = $request->titulo;
        $pelicula->duracion = $request->duracion;
        $pelicula->sinopsis = $request->sinopsis;

        if($request->file('imagen')){
            $file= $request->file('imagen');
            $filename= 'img/'.date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('img'), $filename);
            $pelicula->url= $filename;
        }

        $pelicula->save();


        return redirect('/peliculas')->with('success',  'pelicula actualizada');
    }

    public function modificarCine($cine)
    {
        return view('modificarCine', [
            'cine' => Cine::where('id', $cine)->first()]);
    }

    public function updateCine(Request $request, $cine)
    {
        $request->validate([
            'nombre' => 'required',
            'localidad' => 'required',
            'descripcion' => 'required',
            'asientos' => 'required',
            'mapa' => 'required',
        ]);

        $cine = Cine::where('id', $cine)->first();
        $cine->nombre = $request->nombre;
        $cine->descripcion = $request->descripcion;
        $cine->asientos = $request->asientos;
        $cine->localidad_id = $request->localidad;
        $cine->mapa = $request->mapa;

        $cine->save();


        return redirect('/cines')->with('success',  'cine actualizado');
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
            'fecha' => 'required|string',
            'asientos' => 'required|string'
        ]);


        //selecciono el usuario actual
        $user = Auth::user();

        $asientosArray = explode(",", $validado['asientos']);
        //Hago tantas reservas como asientos haya
        for ($i = 0; $i < sizeof($asientosArray); $i++) {

            DB::table('reservas')->insert(
                array('user_id' => $user->id,
                      'cine_id' => $validado['cine_id'],
                      'pelicula_id' => $validado['pel_id'],
                      'fecha' => $validado['fecha'],
                      'hora_inicio' => $validado['hora_inicio'],
                      'sala' => $validado['sala'],
                      'asiento' => $asientosArray[$i]
            ));


/*             $reserva = Reserva::create([
                'user_id' => $user->id,
                'cine_id' => $validado['cine_id'],
                'fecha' => $validado['fecha'],
                'pelicula_id' => $validado['pel_id'],
                'hora_inicio' => $validado['hora_inicio'],
                'sala' => $validado['sala'],
                'asiento' => $asientosArray[$i]
            ]);
            $reserva->save(); */
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


}
