<div>
    <div class="bg-black text-2xl xl:flex justify-center items-center h-auto mx-12 border-white border-2">
        <div class="w-full flex justify-center">
            <!-- Div donde se pregunta la ciudad-->
            <p class="text-white  mt-10 md:block hidden">Ciudad:</p>
            <div class="mt-8 xl:mb-8 w-auto mr-20 ">
                <form action="">
                    @csrf
                    <select id="ciudad" wire:model="localidadLive"
                        class="block text-black appearance-none ml-10 w-72 text-2xl rounded shadow leading-tight focus:outline-none focus:shadow-outline">
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
                class="block text-black appearance-none ml-10 w-72 text-2xl  rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected="true" value="cine1">Seleccione el cine </option>
                {{-- <input type="text" hidden value="{{$cines->count()}}"> --}}
                @foreach ($cines as $cine)
                <option class="cinesOption" value="{{ $cine->nombre }}">{{ $cine->nombre }} </option>
                @endforeach
            </select>
        </div>
    </div>
    </form>
</div>
<div class="w-max h-16"></div>
<div style="background-color: black" class="opacity-95 text-white mx-12 h-auto border-black border-2">
    <p class="text-center text-7xl mb-10 pt-5">Cartelera</p>
    <p class="text-center text-2xl">
        @php
            $fecha = date('d-m-Y', strtotime('+1 day', time()));
            $localidadMostrar = $cineSelect->localidad;
            echo "<b>$cineSelect->nombre</b> en <b>$localidadMostrar->nombre </b> a <b>$fecha</b>";
        @endphp
    </p>
    @if ($peliculas->isEmpty())
        <p class="text-center text-2xl h-60 mt-32">
            Lo sentimos, parece que no hay películas disponibles en este momento</p>
    @endif
    @foreach ($peliculas as $pelicula)
        <div class="lg:flex lg:justify-between mt-10 pb-12 mb-10 h-auto">
            <div class="w-96 h-auto mx-auto lg:ml-40">
                <img style="border: 10px solid white;" class="h-auto w-full" src="{{ URL($pelicula->url) }}"
                    alt="imagen de la pelicula">
            </div>

            <div class="h-96 xl:w-1/2 w-1/2 mr-44 mx-auto lg:ml-16 mt-10 text-xl text-left">
                <p class="text-3xl pb-3"><b>{{ $pelicula->titulo }}</b></p>
                {{ $pelicula->sinopsis }}
                @foreach ($pelicula->proyecciones as $proyeccion)
                    @if ($proyeccion->cine->nombre == $cineLive)
                        <p><button class="bg-[#000c92] hover:bg-black text-white font-bold py-1 px-2 rounded-xl my-3"><a
                                    href="{{ route('reserva', [$proyeccion]) }}">{{ $proyeccion->hora_inicio }}</a></button>
                        </p>
                    @endif
                @endforeach

            </div>
        </div>
    @endforeach

</div>

