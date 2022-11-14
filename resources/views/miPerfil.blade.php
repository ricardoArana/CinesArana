<x-guest-layout>
<style>
    #boton-fav{
        color: white;
        margin-left: 2%;
        background-color: #32ad57;
        padding: 5px;
        border-radius: 15px;
    }
    #boton-fav:hover{
        background-color: #000000
    }
</style>
    <div class="h-16"></div>
    <div style="background-color: #FDF4E4;" class="text-3xl text-center pt-5 pb-3 mb-3 mx-5">
        <div id="cineFavorito" class="mt-3 mb-10 text-xl">
            @if ($user->cine_fav == '' || $user->cine_fav == 'nada')
        <p class="mb-6"><b>{{$user->name}}</b>, no tienes <b>ningún cine </b> como favorito, puedes seleccionar uno aquí:</p>

        @else

        <p class="mb-6"><b>{{$user->name}}</b>, tu cine favorito es <b>{{$user->cine_fav}}</b>. Puedes cambiarlo aquí:</p>
        @endif

        <form action="{{route('cambiarCineFav')}}" method="post">
            @method('POST')
            @csrf
            <select name="cine" id="cine">
            @foreach ($cines as $cine)
            <option value="{{$cine->nombre}}">{{$cine->nombre}}</option>
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
<div style="margin-top: 3%; padding-top:1%;background-color: #FDF4E4;" class="mx-5">
<p class="pb-10 text-4xl text-center">Estas son tus reservas: </p>
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


        <div style="display: block; background-color:#FDF4E4" id="mostrarReserva" class="pt-3 mb-3 mx-5">
            <div class="flex justify-between mt-20 pb-12 mb-10">
                <div class="h-96 ml-40">
                    <img style="border: 5px solid #95F0B0;" class="h-96 w-full" src="{{ URL($reserva->pelicula->url) }}" alt="imagen de la pelicula">
                </div>
                <div class="h-96 w-1/2 mr-44 ml-16 text-xl text-left">
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
        </div>
    @endif
@endforeach
<div class="flex justify-center">
    <a class=" bg-[#FDF4E4] hover:bg-white p-3 rounded btn btn-primary" href="{{  URL('/pdf')  }}">Descargar PDF</a>
    @endif
</div>
</x-guest-layout>
