<x-guest-layout>
    <div class="h-16"></div>
    @foreach ($cines as $cine)
    <div class=" pt-3 mb-3 md:mx-5 text-white" style="background-color: black;">
    <div class="xl:flex xl:justify-between mt-20 pb-12 mb-10">
        <div class="h-auto lg:w-[50%] w-[80%] mr-0 ml-16 mb-7 text-xl text-left">
            <p class="text-3xl pb-3"><b>{{$cine->nombre}}</b> ({{$cine->localidad->nombre}})</p>
            {{$cine->descripcion}}
        </div>
{{--         <div class="h-96 ml-10">
            <img class="w-96 h-auto" src="{{ URL($cine->url) }} alt="imagen del cine">
        </div> --}}
        <div class="ml-6 mr-14">
            <iframe src="{{$cine->mapa}}" width="400" height="300" style="border:0;" allowfullscreen="" loading="" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        </div>
    </div>
@endforeach
</x-guest-layout>
