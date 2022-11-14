<div class="min-h-screen flex flex-col sm:justify-center items-center pt-0 mt-0 sm:pt-0" style="background-color: #FDF4E4;">
    <div>
        <img style="width: 30%; height: 30%; margin-left:35%" src="{{ URL('img/logo.png') }}" alt="logo">
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
