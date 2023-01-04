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
                    <div style="margin-left: 22rem; margin-top:8px;"
                        title='Desde "mi perfil" puedes añadir tu cine favorito para que se muestre al iniciar nuestra web'
                        class="absolute">
                        @if (Auth::user()->cine_fav == '' || Auth::user()->cine_fav == 'nada')
                            <span id="starBlack" class="fa fa-star" checked="true" style="color: grey;"></span> <img src="{{ URL('img/interrogacion.png') }}" alt="icono de interrogacion" class="inline ml-10 w-5 h-5">
                    </div>
                @else
                    @php
                        $cineLive = Auth::user()->cine_fav;

                    @endphp
                    <span id="starOrange" class="fa fa-star" checked="false" style="color:orange"></span> <img src="{{ URL('img/interrogacion.png') }}" alt="icono de interrogacion" class="inline ml-10 w-5 h-5 mb-1">
            </div>
            @endif

            <select id="cineSelect" wire:model="cineLive"
                class="text-black block appearance-none ml-10 w-72 text-2xl  rounded shadow leading-tight focus:outline-none focus:shadow-outline">
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
<div style="background-color: black" class="opacity-[97%] text-white h-auto border-black border-2">
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
                    @if ($proyeccion->cine->nombre == $cineSelect->nombre)
                        <button class="bg-[#000c92] hover:bg-white text-white hover:text-black font-bold py-1 px-2 rounded-xl my-3 mr-5"><a
                                    href="{{ route('reserva', [$proyeccion]) }}">{{ $proyeccion->hora_inicio }}</a></button>
                                    @endif
                                    @endforeach
                                </p>

            </div>
        </div>
    @endforeach

 @php
     $cine_fav = Auth::user()->cine_fav;
 @endphp
    <input type="text" hidden id="cineFav" value="{{$cine_fav}}">
</div>

<script defer>
    spanBlack = document.getElementById("starBlack");
    spanOrange = document.getElementById("starOrange");
    cineFav = document.getElementById("cineFav").value;

    function colores() {

        cineOption = document.getElementById("cineSelect").value;


       if (spanOrange != null) {
        if (cineFav != cineOption) {
            spanOrange.style = "color:grey"
        }
        else{
            spanOrange.style = "color:orange"
        }
       }


    }
    setInterval(colores, 10);
</script>
