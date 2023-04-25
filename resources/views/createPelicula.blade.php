<x-guest-layout>
    <div class="h-16"></div>
<div class="text-3xl text-white mb-0 pt-10 pl-10 bg-black">
    <p >Rellene los datos de la película que desea añadir:</p>
</div>
    <form class="w-full" action="{{route('storePelicula')}}" method="post"  enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="pl-[20%] py-20 border-b border-blue-500 bg-black text-white">
              <input class="mb-5 text-xl appearance-none bg-transparent border-none w-[50%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="titulo" required placeholder="Titulo de la pelicula">
              <input class="mb-5 text-xl appearance-none bg-transparent border-none w-[50%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="sinopsis" required placeholder="Sinopsis">
              <input class="mb-5 text-xl appearance-none bg-transparent border-none w-[50%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="duracion" required placeholder="Duración">
              <label><h4>Introduzca la imagen de la película</h4>
               <h4>Recuerde que debe ser la portada oficial de la película en orientación vertical para que el usuario pueda visualizarla correctamente en la web</h4>
            </label>
              <input type="file" class="mb-5 text-xl appearance-none bg-transparent border-none w-[50%] text-white mr-3 py-1 px-2 leading-tight focus:outline-none" required name="imagen">

<div class="mt-3">
              <input class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-m border-4 text-white py-1 px-2 rounded" type="submit" value="Añadir película">
            </form>
            <a href="{{ROUTE('peliculas')}}" class="flex-shrink-0 border-transparent border-4 text-blue-500 hover:text-blue-800 text-m py-1 px-2 rounded" type="button">
                Volver
            </a>
        </div>
    </div>


</x-guest-layout>
