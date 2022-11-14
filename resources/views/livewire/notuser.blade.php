<div>
    <div style="background-color: #FDF4E4" class="text-2xl flex h-36 mx-12 border-black border-2">
        <div class="w-full  ml-28 flex justify-center">
            <!-- Div donde se pregunta la ciudad-->
            <p class=" mt-10">Ciudad:</p>
            <div class="mt-8 w-full ">
                <form action="">
                    @csrf
                    <select id="ciudad" wire:model="localidadLive"
                        class="block appearance-none ml-10 w-72 text-2xl rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option selected="true" disabled="disabled" value="">Seleccione la ciudad</option>
                        @foreach ($localidads as $localidad)
                            <option value="{{ $localidad->nombre }}"> {{ $localidad->nombre }}</option>
                        @endforeach
                    </select>
            </div>
        </div>

        <div class="w-full mr-28 flex justify-center align-middle">
            <!-- Div donde se pregunta el cine-->
            <p class=" mt-10">Cine:</p>
            <div class="mt-8 w-1/2 ">
            <select id="cineSelect" wire:model="cineLive"
                class="block appearance-none ml-10 w-72 text-2xl  rounded shadow leading-tight focus:outline-none focus:shadow-outline">
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
<div style="background-color: #FDF4E4" class="mx-12 h-auto border-black border-2">
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
            Lo sentimos, parece que no hay películas disponibles para este cine</p>
    @endif
    @foreach ($peliculas as $pelicula)
        <div class="flex justify-between mt-20 pb-12 mb-10">
            <div class="h-96 ml-40">
                <img style="border: 10px solid #95F0B0;" class="h-96 w-full" src="{{ URL($pelicula->url) }}"
                    alt="imagen de la pelicula">
            </div>

            <div class="h-96 w-1/2 mr-44 ml-16 text-xl text-left">
                <p class="text-3xl pb-3"><b>{{ $pelicula->titulo }}</b></p>
                {{ $pelicula->sinopsis }}
                @foreach ($pelicula->proyecciones as $proyeccion)
                    @if ($proyeccion->cine->nombre == $cineLive)
                        <p><button class="bg-[#1cc14e] hover:bg-black text-white font-bold py-1 px-2 rounded-xl my-3"><a
                                    href="{{ route('reserva', [$proyeccion]) }}">{{ $proyeccion->hora_inicio }}</a></button>
                        </p>
                    @endif
                @endforeach

            </div>
        </div>
    @endforeach

</div>

