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

    </div>
    <a href="{{ route('usuarios') }}"><h3 class="mt-5 ml-5" style="color:rgb(0, 0, 0); background-color: rgb(248, 248, 248); cursor: pointer; padding-top: 8px; padding-bottom: 10px; width: 150px"><img src="{{ URL('img/volver.png') }}" alt="icono de volver" style="display: inline; margin-left: 15px;margin-right: 15px; width: 25px; height: 25px;"> Volver</h3></a>
        <div class="pt-10">
        </div>
        @if ($reservas->isEmpty())
        <div class="mt-20">
            <p class="h-60 text-4xl text-white text-center">El usuario "{{$usuario->name}}" no tiene reservas</p>
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
    <div style="margin-top: 3%; padding-top:1%;background-color: black;" class="text-white mx-3 mb-5">
    <p class="pb-10 mt-5 text-4xl text-center">Estas son las reservas de {{$usuario->name}}: </p>
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


            <div style="display: block; background-color:black" id="mostrarReserva" class="text-white pt-3 ">
                <div class="lg:flex lg:justify-between mt-20 pb-12 ">
                    <div class="h-auto w-[60%] xl:w-[25%] lg:ml-[10%] xl:ml-40 ml-[10%]">
                        <img style="border: 5px solid white;" class="h-auto w-[100%]" src="{{ URL($reserva->pelicula->url) }}" alt="imagen de la pelicula">
                    </div>
                    <div class="h-96 lg:w-1/2 mt-10  lg:mr-44 ml-[10%] text-xl text-left">
                        <p class="text-3xl pb-3"><b>{{ $reserva->cine->nombre }}</b>
                            ({{ $reserva->cine->localidad->nombre }})
                        </p>
                        <p class="text-2xl"> Tiene {{ sizeof($asientos) }} reservas en este cine el <b>{{$reserva->fecha}}</b> </p>
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
            </div>
            @endif
    @endforeach
@endif


    </x-guest-layout>
