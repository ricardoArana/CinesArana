<x-guest-layout>
    <div class="w-full h-28"></div>

    <div class=" h-auto bg-black text-white xl:mx-12 mt-5 pt-5">

        <h1 class="text-4xl font-semibold text-center mb-14">Modificar pelicula:</h1>

    <form class="w-full max-w-lg mx-[35%] pb-12" action="{{ route('updatePelicula', $pelicula->id) }}" method="post" enctype="multipart/form-data">
        @method('POST') @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-last-name">
              Titulo
            </label>
            <input name="titulo" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nombre" value="{{$pelicula->titulo}}">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
                Duración
              </label>
              <input name="duracion" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" value="{{$pelicula->duracion}}">

            </div>
          </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
              Sinopsis
            </label>
            <input name="sinopsis" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" value="{{$pelicula->sinopsis}}">
            <p class="text-gray-600 text-xs italic">La sinopsis debe ser la oficial</p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">

          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

            <div class="relative">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                      <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
                        Cambiar la portada:
                      </label>
                      <input type="file" class="mb-5 text-xl appearance-none bg-transparent border-none text-white mr-3 py-1 px-2 leading-tight focus:outline-none" name="imagen">

                    </div>
                  </div>

              <input class="bg-blue-700 hover:bg-blue-900 mt-6 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Modificar">
            </div>
          </div>

        </div>
      </form>

    </div>
    <div class="w-full h-28"></div>
</x-guest-layout>
