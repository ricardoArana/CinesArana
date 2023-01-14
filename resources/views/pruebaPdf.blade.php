
<div style="background-color: #FDF4E4;" class="text-3xl text-center pt-5 pb-3 mb-3 mx-5">

@if ($reservas->isEmpty())
<div class="mt-20">
    <p class="h-60 text-2xl">No tienes reservas</p>
</div>
@else
</div>

@php
$cont = 0;
$asientos = [];
$mostrar = false;
$cine = '';
$pelicula = '';
$hora = '';
@endphp
<div style="margin-top: 2%; padding-top:1%; font-size: 0.5cm" class="mx-5">
<p style="text-align: center; ">{{$user->name}}, estas son tus reservas: </p>
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


    <div style="border solid 1px; display: block; border-color:black" id="mostrarReserva" class="pt-3 mb-3 mx-5">
        <div class="flex justify-between mt-20 pb-12 mb-10">
            <div class="h-96 ml-40">
            </div>
            <div class="h-96 w-1/2 mr-44 ml-16 text-xl text-left">
                <p class="text-3xl pb-3">Tiene {{ sizeof($asientos) }} reservas en <b>{{ $reserva->cine->nombre }}</b>
                    ({{ $reserva->cine->localidad->nombre }})
                </p>
                <p class="text-xl"><b>{{$reserva->pelicula->titulo}}</b></p>
                <p class="text-2xl"> </p>
                <p class="text-xl my-4"> Hora de inicio: {{ $reserva->hora_inicio }} </p>
                <p>Sala {{ $reserva->sala }}</p>
                @if ($mostrar)
                <div>
                    <p> <b> Asientos: </b><br>

                        @foreach ($asientos as $asiento)
                            <span style="margin-right: 2%"> Fila: {{floor($asiento/16)+1}}</span> Asiento: {{$asiento%16+1}}<br>
                        @endforeach
                    </p>
                </div>

                    <p style="text-align: center; margin: 2px 0px 2px 0px">
                        -------------------------------------------------------------------------------------
                    </p>
                        @endif


            </div>

        </div>
    </div>
@endif
@endforeach
@endif
