<div>
    <div class="bg-[#191919] text-2xl xl:flex justify-center items-center h-auto mx-12 border-white border-2">
        <div class="w-full flex justify-center">
            <!-- Div donde se pregunta la ciudad-->
            <p class="text-white mt-10 md:block hidden">Ciudad:</p>
            <div class="mt-8 xl:mb-8 w-auto mr-20 ">
                <form action="">
                    @csrf
                    <select id="ciudad" wire:model="localidadLive"
                        class="text-black block appearance-none ml-10 w-72 text-2xl rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option selected="true" disabled="disabled" value="">Seleccione la ciudad</option>
                        @foreach ($localidads as $localidad)
                            <option value="{{ $localidad->nombre }}"> {{ $localidad->nombre }}</option>
                        @endforeach
                    </select>
            </div>
        </div>

        <div class="w-full md:ml-4 ml-0 flex justify-center">
            <!-- Div donde se pregunta el cine-->
            <p class="text-white mt-10 md:block hidden">Cine:</p>
            <div class="my-8 w-auto mr-20 ">
                <select id="cineSelect" wire:model="cineLive"
                class="text-black block appearance-none ml-10 w-72 text-2xl  rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected="true" value="Las Dunnas">Seleccione el cine </option>
                {{-- <input type="text" hidden value="{{$cines->count()}}"> --}}
                @foreach ($cines as $cine)
                <option class="cinesOption" value="{{ $cine->nombre }}">{{ $cine->nombre }} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="w-max h-16"></div>
<div style="background-color: black" class="opacity-95 text-white h-auto border-black border-2">
    <p class="text-center text-7xl mb-10 pt-5">Cartelera</p>
    <p class="text-center text-2xl">
        @php
            $fecha = date('d-m-Y', strtotime('+1 day', time()));
            $localidadMostrar = $cineSelect->localidad;
            echo "<b>$cineSelect->nombre</b> en <b>$localidadMostrar->nombre </b> a <b>$fecha</b>";
        @endphp
        <select class="text-black text-l" name="fechaOption" wire:model="fechaLive">
            <option value="{{ date('d-m-Y', strtotime('+0 day', time())) }}"> {{ date('d-m-Y', strtotime('+0 day', time())) . ' (' . date('l', strtotime('+0 day', time())) . ')' }} </option>
            <option value="{{ date('d-m-Y', strtotime('+1 day', time())) }}"> {{ date('d-m-Y', strtotime('+1 day', time())) . ' (' . date('l', strtotime('+1 day', time())) . ')' }} </option>
            <option value="{{ date('d-m-Y', strtotime('+2 day', time())) }}"> {{ date('d-m-Y', strtotime('+2 day', time())) . ' (' . date('l', strtotime('+2 day', time())) . ')'}} </option>
            <option value="{{ date('d-m-Y', strtotime('+3 day', time())) }}"> {{ date('d-m-Y', strtotime('+3 day', time())) . ' (' . date('l', strtotime('+3 day', time())) . ')'}} </option>
            <option value="{{ date('d-m-Y', strtotime('+4 day', time())) }}"> {{ date('d-m-Y', strtotime('+4 day', time())) . ' (' . date('l', strtotime('+4 day', time())) . ')'}} </option>
            <option value="{{ date('d-m-Y', strtotime('+5 day', time())) }}"> {{ date('d-m-Y', strtotime('+5 day', time())) . ' (' . date('l', strtotime('+5 day', time())) . ')'}} </option>
            <option value="{{ date('d-m-Y', strtotime('+6 day', time())) }}"> {{ date('d-m-Y', strtotime('+6 day', time())) . ' (' . date('l', strtotime('+6 day', time())) . ')'}} </option>
            <option value="{{ date('d-m-Y', strtotime('+7 day', time())) }}"> {{ date('d-m-Y', strtotime('+7 day', time())) . ' (' . date('l', strtotime('+7 day', time())) . ')'}} </option>
        </select>
    </p>
</form>
    @if ($peliculas->isEmpty())
        <p class="text-center text-2xl h-60 mt-32">
            Lo sentimos, parece que no hay películas disponibles para este cine</p>
    @endif
    @foreach ($peliculas as $pelicula)
        <div class="lg:flex lg:justify-between mt-10 pb-12 mb-10 h-auto">
            <div class="w-96 h-auto mx-auto lg:ml-40 opacity-100">
                <img style="border: 5px solid white;" class="h-auto w-full" src="{{ URL($pelicula->url) }}"
                    alt="imagen de la pelicula">
            </div>

            <div class="h-auto w-1/2 ml-[15%] mr-[5%] lg:mr-[5%] lg:ml-[2%]  md:mr-44 md:ml-[25%] mt-10 text-xl text-left">
                <p class="text-3xl pb-3"><b>{{ $pelicula->titulo }}</b></p>
                {{ $pelicula->sinopsis }}
                <p class="mt-5">
                @foreach ($pelicula->proyecciones as $proyeccion)
                    @if ($proyeccion->cine->nombre == $cineSelect->nombre && $proyeccion->fecha == $fechaLive)
                        <button class="bg-[#000c92] hover:bg-white text-white hover:text-black font-bold py-1 px-2 rounded-xl my-3 mr-5"><a
                                    href="{{ route('reserva', [$proyeccion]) }}">{{ $proyeccion->hora_inicio }}</a></button>
                                    @endif
                                    @endforeach
                                </p>

            </div>
        </div>
    @endforeach

</div>
