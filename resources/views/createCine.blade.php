<x-guest-layout>
    <div class="h-16"></div>
<div class="text-3xl text-white mb-0 pt-10 pl-10 bg-black">
    <p >Rellene los datos del cine que desea añadir:</p>
</div>
    <form class="w-full" action="{{route('storeCine')}}" method="post"  enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="pl-[20%] py-20 border-b border-blue-500 bg-black text-white">
              <input class="mb-5 text-xl appearance-none bg-transparent border-none w-[50%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="nombre" required placeholder="Nombre del cine">
              <input class="mb-5 text-xl appearance-none bg-transparent border-none w-[50%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="descripcion" required placeholder="Descripción">
              <input class="mb-5 text-xl appearance-none bg-transparent border-none w-[50%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="asientos" required placeholder="Número de asientos">
              <br><label for="localidad"> Seleccione la localidad del cine:</label> <br>
              <select class="w-[20%] mb-5 text-black mr-3 py-1 px-2 leading-tight focus:outline-none" name="localidad">
                @foreach ($localidads as $localidad)
                <option class="text-black" value="{{$localidad->nombre}}">{{$localidad->nombre}}</option>
                @endforeach
            </select>
            <br>
              <input class="mb-5 text-xl appearance-none bg-transparent border-none w-[70%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="mapa" required placeholder="Código Google Maps">

<div class="mt-3">
              <input class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-m border-4 text-white py-1 px-2 rounded" type="submit" value="Añadir cine">
            </form>
            <a href="{{ROUTE('peliculas')}}" class="flex-shrink-0 border-transparent border-4 text-blue-500 hover:text-blue-800 text-m py-1 px-2 rounded" type="button">
                Volver
            </a>
        </div>
    </div>


</x-guest-layout>
