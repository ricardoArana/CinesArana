<x-guest-layout>
    <div class="w-full h-28"></div>

    <div class=" h-auto bg-black text-white xl:mx-12 mt-5 pt-5">

        <h1 class="text-4xl font-semibold text-center mb-14">Modificar Cine:</h1>

    <form class="w-full max-w-lg mx-[35%] pb-12" action="{{ route('updateCine', $cine->id) }}" method="post">
        @method('POST') @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-last-name">
              Nombre
            </label>
            <input name="nombre" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nombre" value="{{$cine->nombre}}">
            <input name="localidad" hidden id="grid-last-name" type="text" placeholder=""  value="{{$cine->localidad_id}}">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
                Descripción
              </label>
              <input name="descripcion" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" value="{{$cine->descripcion}}">

            </div>
          </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
              asientos
            </label>
            <input name="asientos" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" value="{{$cine->asientos}}">

          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">

          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

            <div class="relative">
                <div class="flex flex-wrap -mx-3 mb-6 w-full">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
                            mapa
                          </label>
                          <input name="mapa" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" value="{{$cine->mapa}}">

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
