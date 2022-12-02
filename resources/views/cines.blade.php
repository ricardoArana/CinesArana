<x-guest-layout>
    <div class="h-16"></div>
    @foreach ($cines as $cine)
    <div class=" pt-3 mb-3 mx-5 text-white" style="background-color: black;">
    <div class="xl:flex xl:justify-between mt-20 pb-12 mb-10">
        <div class="h-96 w-full mr-0 ml-16 text-xl text-left">
            <p class="text-3xl pb-3"><b>{{$cine->nombre}}</b> ({{$cine->localidad->nombre}})</p>
            {{$cine->descripcion}}
        </div>
        <div class="h-96 ml-10">
            <img class="w-96 h-auto" {{-- src="{{ URL($cine->url) }} --}} alt="imagen del cine">
        </div>
        <div class="mx-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d199.74994310364386!2d-6.357310041853046!3d36.77058929670994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dde3064f7854b%3A0x48e4ef02540819f9!2sMcDonald&#39;s!5e0!3m2!1ses!2ses!4v1669712585636!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        </div>
    </div>
@endforeach
</x-guest-layout>
