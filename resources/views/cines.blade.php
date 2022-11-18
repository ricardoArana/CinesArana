<x-guest-layout>
    <div class="h-16"></div>
    @foreach ($cines as $cine)
    <div class=" pt-3 mb-3 mx-5 text-white" style="background-color: black;">
    <div class="flex justify-between mt-20 pb-12 mb-10">
        <div class="h-96 ml-40">
            <img class="h-96 w-full" src="{{ URL($cine->url) }}" alt="imagen del cine">
        </div>
        <div class="h-96 w-1/2 mr-44 ml-16 text-xl text-left">
            <p class="text-3xl pb-3"><b>{{$cine->nombre}}</b> ({{$cine->localidad->nombre}})</p>
            {{$cine->descripcion}}
        </div>

        </div>
    </div>
@endforeach
</x-guest-layout>
