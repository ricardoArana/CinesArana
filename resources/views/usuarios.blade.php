<x-guest-layout>
    <div class="w-full h-28"></div>

    <div class=" h-auto bg-black text-white xl:mx-12 mt-5 pt-5">

        <h1 class="text-4xl font-semibold text-center mb-14">Lista de Usuarios:</h1>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8 mb-3">
                    <div class="overflow-hidden">
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
                        @foreach ($usuarios as $usuario)
                      <tr class="border-b dark:border-neutral-500">
                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{$usuario->name}}</td>
                        <td class="whitespace-nowrap px-6 py-4">{{$usuario->email}}</td>
                        @if ($usuario->rol == 'admin')
                        <td class="whitespace-nowrap px-6 py-4" style="-webkit-text-stroke: 0.4px red;">{{$usuario->rol}}</td>
                        @else
                        <td class="whitespace-nowrap px-6 py-4">{{$usuario->rol}}</td>
                        @endif
                        <td class="whitespace-nowrap px-6 py-4"><a href="{{route('modificarUsuario', $usuario)}}">Modificar</a></td>
                        <td class="whitespace-nowrap px-6 py-4">Borrar</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

  </tbody>
</table>

    </div>
    <div class="w-full h-28"></div>
</x-guest-layout>
