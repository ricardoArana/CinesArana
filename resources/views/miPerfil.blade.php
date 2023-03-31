<x-guest-layout>
<style>
    #boton-fav{
        color: white;
        margin-left: 2%;
        background-color: #000c92;
        padding: 5px;
        border-radius: 15px;
    }
    #boton-fav:hover{
        background-color: #000000
    }
</style>
    <div class="h-40"></div>
    <div style="background-color: #373737;" class="text-3xl text-white text-center opacity-[98%] pt-5 pb-3 mb-3 mx-5" title="EL cine que selecciones te aparecerá por defecto en la página principal. Puedes cambiarlo cuando quieras.">
        <div id="cineFavorito" class="mt-3 mb-10 text-xl">
            @if ($user->cine_fav == '' || $user->cine_fav == 'nada')
        <p class="mb-6"><b>{{$user->name}}</b>, no tienes <b>ningún cine </b> como favorito, puedes seleccionar uno aquí:</p>

        @else

        <p class="mb-6"><b>{{$user->name}}</b>, tu cine favorito es <b>{{$user->cine_fav}}</b>. Puedes cambiarlo aquí: <img src="{{ URL('img/interrogacion.png') }}" alt="icono de interrogacion" class="inline ml-10 w-5 h-5"></p>
        @endif

        <form action="{{route('cambiarCineFav')}}" method="post">
            @method('POST')
            @csrf
            <select class="text-black" name="cine" id="cine">
            @foreach ($cines as $cine)
            <option class="text-black" value="{{$cine->nombre}}">{{$cine->nombre}}</option>
            @endforeach
            <option value="nada">Quitar cine favorito</option>
            <input type="submit" id="boton-fav" value="Cambiar favorito">
        </select>
        </form>
    </div>
    <div class="pt-10">
    </div>
    @if ($reservas->isEmpty())
    <div class="mt-20">
        <p class="h-60 text-2xl">No tienes reservas</p>
    </div>
    @else
</div>

{{--     @php
dd($reservas->count())
@endphp --}}
@php
    $cont = 0;
    $asientos = [];
    $mostrar = false;
    $cine = '';
    $pelicula = '';
    $hora = '';
@endphp
<div style="margin-top: 3%; padding-top:1%;background-color: black;" class="text-white mx-5">
<p class="pb-10 mt-5 text-4xl text-center">Estas son tus reservas: </p>
</div>
@foreach ($reservas as $reserva)
    @php
        ++$cont;
        $cineId = $reserva->cine->id;
        $peliculaId = $reserva->pelicula->id;
        $horaId = $reserva->hora_inicio;
        $asiento = $reserva->asiento;
        //Condicion para cada reserva
        if ($cine == $cineId && $pelicula == $peliculaId && $hora == $horaId) {
            if ($cont < sizeof($reservas)) {
                if ($reservas[$cont]->cine->id == $cineId && $reservas[$cont]->pelicula->id == $peliculaId
                    && $reservas[$cont]->hora_inicio == $horaId) {
                    $mostrar = false;

                }
                else {

                    $mostrar = true;
                }

            }
            else {
                $mostrar = true; //Cuando entra en este else es porque es la última
            }
              array_push($asientos, $asiento);

        } else {
            if ($reservas->count() == 1) { //si solo hay una reserva la muestra
                $mostrar = true;
                array_push($asientos, $asiento);
            } else {
                if ($cont < sizeof($reservas)) {
                if ($reservas[$cont]->cine->id == $cineId && $reservas[$cont]->pelicula->id == $peliculaId
                    && $reservas[$cont]->hora_inicio == $horaId) {
                    $mostrar = false;

                }
                else {

                    $mostrar = true;
                }}
                // prepara las variables para la siguiente reserva
                $cine = $cineId;
                $pelicula = $peliculaId;
                $hora = $horaId;
                $asientos = [];
                array_push($asientos, $asiento);
            }

        }

    @endphp
    @if ($mostrar)
        {{-- @foreach ($reservas as $reserva)
            $cineId = $reserva->cine->id;
            $pelId = $reserva->pelicula->id;
            $hora = $reserva->hora_inicio;

            @endforeach --}}


        <div style="display: block; background-color:black" id="mostrarReserva" class="text-white pt-3 mb-3 mx-5">
            <div class="lg:flex lg:justify-between mt-20 pb-12 mx-auto mb-10">
                <div class="h-auto w-[60%] xl:w-[25%] lg:ml-[10%] xl:ml-40 ml-[10%]">
                    <img style="border: 5px solid white;" class="h-auto w-[100%]" src="{{ URL($reserva->pelicula->url) }}" alt="imagen de la pelicula">
                </div>
                <div class="h-96 lg:w-1/2 mt-10  lg:mr-44 ml-[10%] text-xl text-left">
                    <p class="text-3xl pb-3"><b>{{ $reserva->cine->nombre }}</b>
                        ({{ $reserva->cine->localidad->nombre }})
                    </p>
                    <p class="text-2xl"> Tiene {{ sizeof($asientos) }} reservas en este cine</p>
                    <p class="text-xl my-4"> Hora de inicio: {{ $reserva->hora_inicio }} </p>
                    @if ($mostrar)

                        <p> <b> Asientos: </b><br>

                            @foreach ($asientos as $asiento)
                                <span style="margin-right: 2%"> Fila: {{floor($asiento/16)+1}}</span> Asiento: {{$asiento%16+1}}<br>
                            @endforeach
                        </p>
                        {{-- <p>{{$reservas[$cont-1]}}</p> --}}
                    @endif


                </div>

            </div>
            <div class="flex justify-center bg-gray-700 pb-10">
                <div>
            <p class="text-4xl mb-3 mt-3 text-center">Gracias por confiar en Cines Arana.</p>
            <p class="text-2xl mb-5 text-center"> Muestra este código en la entrada de tu cine para acceder a la película "{{$reserva->pelicula->titulo}}":</p>
            <p class="text-2xl mb-5 text-center"> O descarga el PDF al final de esta página </p>
            <div class="ml-[40%]">{{QrCode::size(200)->generate('te quiero')}}</div>
        </div>
        </div>
        </div>
        @endif
@endforeach
<div class="flex justify-center">
    <a class="text-white text-2xl bg-[#000c92] hover:bg-white hover:text-black border-2 border-black py-4 px-6 rounded btn btn-primary" href="{{  URL('/pdf')  }}">Descargar PDF</a>
    @endif
</div>
</x-guest-layout>
