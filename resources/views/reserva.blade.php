<x-guest-layout>

    <div class="w-full h-16"></div>
    <div class="text-3xl text-center pt-10 pb-10 bg-black text-white">
        <p class="mb-5 text-white">Comprar entradas:</p>
        {{-- Obtener el nombre y la localidad del cine --}}
        <p class="mb-5 pb-5 text-2xl"><b>{{ $proyeccion->cine->nombre }}</b> en
            <b>{{ $proyeccion->cine->localidad->nombre }} ({{ $proyeccion->hora_inicio }})</b>
        </p>
        <div class="flex justify-between mt-20 pb-12 mb-10">
            <div class="h-96 ml-40">
                <img style="border: 5px solid #95F0B0;" class="h-96 w-full" src="{{ URL($proyeccion->pelicula->url) }}" alt="imagen de la pelicula">
            </div>

            <div class="h-96 w-1/2 mr-44 ml-16 text-xl text-left">
                <p class="text-3xl pb-3"><b>{{ $proyeccion->pelicula->titulo }}</b></p>
                {{ $proyeccion->pelicula->sinopsis }}
                <br> <br>
                Sala {{ $proyeccion->sala }}

            </div>
        </div>
        <div class="mt-16 pt-16 bg-white text-black">
            <div class="mb-10">
            <label class="container" for="blanco">
                <input type="checkbox" value="blanco" name="blanco"
                id="blanco" disabled>
                <span class="checkmark text-xl"> Asiento disponible</span>
            </label>
            <br>
            <label class="container" for="blanco">
                <input style="color: black" type="checkbox" value="blanco" name="blanco"
                id="blanco" checked disabled>
                <span class="checkmark text-xl"> Asiento ocupado</span>
            </label>
        </div>
            <p class="mb-5">Seleccione su asiento:</p>
            @php
                $asientos = $proyeccion->cine->asientos;
            @endphp
            <form action="" id="sitios" onsubmit="event.preventDefault()">
                @for ($i = 0; $i < $asientos+1; $i++)
                    @if (gettype($i / 16) == 'integer' && $i / 16 != 0)
                    <span class="text-xl"> {{$i/16}} </span>

                       <br>
                    @endif
                    <label class="container" for="{{ $i }}">
                        <input type="checkbox" style="color:blue" value="{{ $i }}" name="{{ $i }}"
                            id="{{ $i }}">
                        <span class="checkmark"></span>
                    </label>
                @endfor
                <div class="flex justify-center">
                    <div style="width: 370px" class="bg-white border-2 border-black mt-10 mb-5 h-8 px-10 text-xl">
                       <p> Pantalla</p></div>
                </div>
                @php
                    $arr = '';

                @endphp
                @foreach ($reservas as $reserva)
                    @php

                        $arr = $arr . ' ' . $reserva->asiento;

                    @endphp
                @endforeach
                <input hidden id="reservados" type="text" value="{{ $arr }}">

                <script>
                    window.onload = asientosReservados;
                    sitios = document.forms["sitios"].elements.length;
                    reservados = document.getElementById("reservados").value;
                    reservados = reservados.split(" ");

                    function asientosReservados() {
                        let iguales = [];
                        for (let i = 0; i < sitios; i++) {
                            for (let j = 0; j < sitios; j++) {
                                if (document.forms["sitios"].elements[i].id == reservados[j])
                                    iguales.push(reservados[j]);
                            }
                        }
                        for (let i = 0;  i< iguales.length; i++) {
                            color = iguales[i];
                            document.forms["sitios"].elements[color].checked = true
                        }
                        for (let i = 0; i < sitios; i++) {
                            if (document.forms["sitios"].elements[i].checked) {
                                document.forms["sitios"].elements[i].style = "color: black;"
                                document.forms["sitios"].elements[i].disabled = "true"
                            }

                        }
                    }

                    function mostrar() {
                        asientos = [];
                        for (let i = 0; i < sitios; i++) {
                            if (document.forms["sitios"].elements[i].checked && !document.forms["sitios"].elements[i].disabled) {
                                asientos.push(i);
                            }
                        }
                        for (let i = 0; i < sitios; i++) {
                            document.forms["sitios"].elements[i].disabled = true;
                        }
                        if (asientos.length == 0) {
                            document.getElementById("precio").innerHTML = "No hay asientos seleccionados"
                        } else {
                            document.getElementById("comprar").style.display = "none";
                            document.getElementById("pagar").style.display = "block";
                            filas = [];
                            columnas = [];
                            for (let i = 0; i < asientos.length; i++) {
                                filas.push(Math.floor(asientos[i] / 16))
                                columnas.push(asientos[i] % 16+1)
                            }
                            document.getElementById("asientosSelec").innerHTML = `Ha seleccionado ${asientos.length} asientos.`
                            document.getElementById("sitioSelec").innerHTML += `Sus sitios son:`
                            for (let i = 0; i < filas.length; i++) {
                                document.getElementById("sitioSelec").innerHTML += `<br> Fila: ${filas[i]+1} `
                                document.getElementById("sitioSelec").innerHTML += ` Asiento: ${columnas[i]}`

                            }
                            document.getElementById("precio").innerHTML = `Precio: ${asientos.length * 7}&euro;`
                        }
                        document.getElementById("asientosPOST").value = asientos
                    }
                </script>
                <div>{{-- Boton de comprar --}}
                    <input id="comprar" onclick="mostrar()" type="submit" value="Comprar"
                        class="bg-[#000c92] hover:bg-black text-white font-bold py-1 px-2 rounded-full my-5">
                </div>
            </form>
            <div id="asientosSelec" class="mt-10"></div>
            <div id="sitioSelec" class="mt-2 text-xl"></div>
            <div id="precio" class="mt-10 "></div>
            <div class="flex justify-center">
                <form class="py-4" action="{{ route('reservar') }}" method="POST">
                    @method('POST')
                    @csrf
                    <input hidden type="text" value="" id="asientosPOST" name="asientos">
                    <input hidden type="text" value="{{ $proyeccion->pelicula->id }}" name="pel_id">
                    <input hidden type="text" value="{{ $proyeccion->cine->id }}" name="cine_id">
                    <input hidden type="text" value="{{ $proyeccion->sala }}" name="sala">
                    <input hidden type="text" value="{{ $proyeccion->hora_inicio }}" name="hora_inicio">
                    <input id="pagar" value="Pagar" style="display: none" type="submit"
                        class="bg-[#000c92] hover:bg-black text-white font-bold py-1 px-2 rounded-full my-5">
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
