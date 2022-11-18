<div class="min-h-screen flex flex-col sm:justify-center items-center pt-0 mt-0 sm:pt-0" style="background-image: url({{ URL('img/cineFondo.png') }})">
    <div>
        <img style="width: 40%; height: 40%; margin-left:30%" class="border-white border-[1px]" src="{{ URL('img/logo.png') }}" alt="logo">
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-2xl border-black border-[1px] overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
