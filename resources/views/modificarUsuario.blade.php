<x-guest-layout>
    <div class="w-full h-28"></div>

    <div class=" h-auto bg-black text-white xl:mx-12 mt-5 pt-5">

        <h1 class="text-4xl font-semibold text-center mb-14">Modificar Usuario:</h1>

    <form class="w-full max-w-lg mx-[35%] pb-12">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-last-name">
              Nombre
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Nombre" value="{{$usuario->name}}">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
              Email
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" value="{{$usuario->email}}">
            <p class="text-gray-600 text-xs italic">Ten cuidado al cambiar este campo</p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">

          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-state">
              Rol
            </label>
            <div class="relative">
              <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option>Cliente</option>
                <option>Administrador</option>
              </select>

            </div>
          </div>

        </div>
      </form>

    </div>
    <div class="w-full h-28"></div>
</x-guest-layout>
