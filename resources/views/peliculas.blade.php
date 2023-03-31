<x-guest-layout>
    <style>
        .carousel-open:checked+.carousel-item {
          position: static;
          opacity: 100;
        }

        .carousel-item {
          -webkit-transition: opacity 0.6s ease-out;
          transition: opacity 0.6s ease-out;
        }

        #carousel-1:checked~.control-1,
        #carousel-2:checked~.control-2,
        #carousel-3:checked~.control-3 {
          display: block;
        }

        .carousel-indicators {
          list-style: none;
          margin: 0;
          padding: 0;
          position: absolute;
          bottom: 2%;
          left: 0;
          right: 0;
          text-align: center;
          z-index: 10;
        }

        #carousel-1:checked~.control-1~.carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked~.control-2~.carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked~.control-3~.carousel-indicators li:nth-child(3) .carousel-bullet {
          color: #2b6cb0;
          /*El carrusel muestra 3 imagenes, las imagenes se cambian manualmente, abajo
            se muestran el resto de peliculas automáticamente */
        }
        </style>
        <div class="w-full h-28"></div>
        <div class="bg-black opacity-95 text-white p-0 carousel pt-5 rounded relative border-2 border-white">
            <p class="text-6xl text-center">Películas</p>
            <div class="mb-0 pb-0">
              <!--Slide 1-->
              <input class="carousel-open hidden" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden=""
                checked="checked">
              <div class="carousel-item mb-14 mt-8 absolute opacity-0 bg-center bg-no-repeat bg-contain" style="height:500px; background-image: url({{ URL('img/avatar.jpg') }})">

              </div>



              <!--Slide 2-->
              <input class="carousel-open hidden" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
              <div class="carousel-item mb-14 mt-8 absolute opacity-0 bg-center bg-contain bg-no-repeat" style="height:500px; background-image: url({{ URL('img/reza.jpg') }})">
              </div>

              <label for="carousel-3"
                class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer font-bold text-black rounded-full leading-tight text-center z-10 inset-y-0 right-0 my-auto">
            </label>

              <!--Slide 3-->
              <input class="carousel-open hidden" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
              <div class="carousel-item mb-14 mt-8 absolute opacity-0 bg-center bg-contain bg-no-repeat" style="height:500px; background-image: url({{ URL('img/vecino.jpg') }})">
              </div>



              <!-- Add additional indicators for each slide-->
              <ol class="carousel-indicators bg-black p-0">
                <li class="inline-block mr-3">
                  <label for="carousel-1"
                    class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                  <label for="carousel-2"
                    class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
                <li class="inline-block mr-3">
                  <label for="carousel-3"
                    class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
                </li>
              </ol>
              <div class="h-3 bg-black"></div>

            </div>
          </div>
    <div class=" h-auto bg-black text-white xl:mx-12 mt-5 pt-5">
        @if (Auth::user()->rol == 'admin')
        <div class="ml-[41.5%] mt-10 pb-10">
            <a  class="bg-blue-700 hover:bg-blue-900 text-white font-bold text-3xl py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="{{route('cines')}}">Añadir película</a></td>
        </div>
        @endif
        @foreach ($peliculas as $pelicula)
        <div class="lg:flex lg:justify-between mt-20 pb-12 mb-10">
            <div class="h-auto lg:ml-40 mb-20">
            <img class="h-auto w-96 mx-auto border-2 border-white" src="{{ URL($pelicula->url) }}" alt="imagen de la pelicula">
        </div>
        <div class="h-auto lg:w-1/2 lg:mr-44 lg:mt-7 ml-16 text-xl text-left">
            <p class="text-3xl pb-3"><b>{{$pelicula->titulo}}</b></p>
            {{$pelicula->sinopsis}}
            @if (Auth::user()->rol == 'admin')
        <div class="mt-20">
            <a  class="bg-blue-700 hover:bg-blue-900 text-white font-bold text-xl py-1 px-2 rounded focus:outline-none focus:shadow-outline" href="{{route('cines')}}">Modificar película</a></td>
        </div>
        @endif

        </div>
    </div>
@endforeach
    </div>
</x-guest-layout>
