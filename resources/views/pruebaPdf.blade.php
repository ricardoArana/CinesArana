<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- CDN de Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Hoja de estilos Personalizada -->
        <link rel="stylesheet" href="assets/css/estilos.css">
    <title class='no-print'>Tu reserva</title>
    <style>
        @media print
{
    .no-print, .no-print *
    {
        display: none !important;
    }
}
    </style>
</head>
<body>
    <div class='no-print' style="margin:30px">
        <a onclick="window.print();return false;" class="text-white text-2xl bg-[#000c92] hover:bg-white hover:text-black border-2 border-black py-4 px-6 rounded btn btn-primary" href="{{  URL('/pdf')  }}">Descargar PDF</a>
        <a class="text-white text-2xl bg-[#000c92] hover:bg-white hover:text-black border-2 border-black py-4 px-6 rounded btn btn-primary" href="{{  URL('/miPerfil')  }}">Volver</a>

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
<div class="w-[40%] ml-[33%] mt-10">
<p class="text-center text-4xl w-[80%]">{{$user->name}}, esta es tu entrada: </p>
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


    <div  id="mostrarReserva">
        <div class="flex ml-[28%] mt-20 pb-12 mb-20 items-center">
            <div class="h-auto">
            </div>

            <div class="h-auto text-xl text-center p-5 w-[60%]" style="border: black 1px dotted">
                <div class="h-auto w-[70%] xl:w-[25%] lg:ml-[10%] xl:ml-40 ml-[10%]">
                </div>
                <p class="text-xl pb-3">Tiene {{ sizeof($asientos) }} reservas en <b>{{ $reserva->cine->nombre }}</b> a <b>{{$reserva->fecha}}</b>
                    ({{ $reserva->cine->localidad->nombre }})
                </p>
                <p class="text-xl"><b>{{$reserva->pelicula->titulo}}</b></p>
                <p class="text-2xl"> </p>
                <p class="text-xl my-4"> Hora de inicio: {{ $reserva->hora_inicio }} </p>
                @if ($mostrar)

                <div class="flex justify-center bg-gray-300 pb-10 text-black">
                    <div>
                <p class="text-4xl mb-3 mt-3 text-center">Sala {{ $reserva->sala }}</p>
                <p class="text-2xl mb-5 text-left"> <b> Asientos: </b><br>

                    @foreach ($asientos as $asiento)
                        <span style="margin-right: 0%"> Fila: {{floor($asiento/16)+1}}</span> Asiento: {{$asiento%16+1}}<br>
                        @endforeach</p>

            </div>

                        @endif


            </div>
        </div>
    </div>
@endif
@endforeach
<div class="flex justify-center bg-gray-500 pb-10 text-black">
    <div><p class="text-3xl mb-8">¡Muestra este código en tu entrada!</p>
<div class="ml-[30%]">{{QrCode::size(200)->generate($reserva->pelicula->titulo)}} </div>
</div>
@endif


                        </body>
                        </html>
