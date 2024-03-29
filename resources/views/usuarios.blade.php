<x-guest-layout>
    <div class="w-full h-28"></div>

    <div class=" h-auto bg-black text-white xl:mx-12 mt-5 pt-5">

        <h1 class="text-4xl font-semibold text-center mb-14">Lista de Usuarios:</h1>
        <form method="GET" action="{{ route('usuarios') }}" class="text-center mb-9 ">
            <input type="text" name="query" placeholder="Buscar por código o nombre" class="text-black w-[20%]">
            <input type="submit" value="Buscar" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
        </form>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8 mb-3">
                    <div class="overflow-hidden">
                        @if ($users->count() > 0)
                        <table class="min-w-full text-center text-xl font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Nombre</th>
                                    <th scope="col" class="px-6 py-4">Email</th>
                                    <th scope="col" class="px-6 py-4">Rol</th>
                                    <th scope="col" class="px-6 py-4"></th>
                                    <th scope="col" class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($users as $usuario)
                      <tr class="border-b dark:border-neutral-500">
                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$usuario->name}}</td>
                        <td class="whitespace-nowrap px-6 py-4">{{$usuario->email}}</td>
                        @if ($usuario->rol == 'admin')
                        <td class="whitespace-nowrap px-6 py-4" style="-webkit-text-stroke: 0.4px red;">{{$usuario->rol}}</td>
                        @else
                        <td class="whitespace-nowrap px-6 py-4">{{$usuario->rol}}</td>
                        @endif
                        <td class="whitespace-nowrap px-6 py-4"><a  class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline" href="{{route('modificarUsuario', $usuario->id)}}">Modificar</a></td>
                        <td class="whitespace-nowrap px-6 py-4"><a  class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline" href="{{route('reservasUsuario', $usuario->id)}}">Ver Reservas</a></td>
                        <td class="whitespace-nowrap px-6 py-4"><form action="{{ route('deleteUsuario', $usuario->id) }}" method="post" onsubmit="return confirm('¿Seguro que quieres borrar este usuario? Se borrarán todas sus reservas');">
                            @method('POST') @csrf
                            <input class="bg-red-700 hover:bg-red-900 cursor-pointer text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline" type="submit" value="Borrar">
                            </form>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  @else
                  <p>No se encontraron resultados.</p>
              @endif
                </div>
              </div>
            </div>
          </div>

  </tbody>
</table>

    </div>
    <div class="w-full h-28"></div>
</x-guest-layout>
