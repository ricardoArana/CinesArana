<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="{{ URL('img/icon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cines Arana</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireStyles
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>

<body style="background-color: #FDF4E4; font-family: rockwell">
    <div class="font-sans text-gray-900 antialiased ">
        <header class="w-full h-28" style="background-color: #FDF4E4; font-family: Rockwell">
            <div class="flex justify-between mx-36 my-10 p-1 border-b-2 border-y-green-900">
                @if (Auth::user())
                <a class="text-3xl ml-4 hover:animate-waving hover:text-blue-800"
                    href="{{ route('inicio') }}"><img style="height: 100px; width: 100px;"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
                    @else
                    <a class="text-3xl ml-4 hover:animate-waving hover:text-blue-800"
                    href="{{ route('notuser') }}"><img style="height: 100px; width: 100px;"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
                @endif
                <a class="text-5xl h-10 mt-12 hover:animate-waving hover:text-green-800" href="{{ route('cines') }}">CINES</a>
                <a  class="text-5xl h-10 mt-12 hover:animate-waving hover:text-green-800"
                    href="{{ route('peliculas') }}">PELÍCULAS</a>
                @if (empty(Auth::user()))
                    <a class="text-5xl h-10 mt-12 mr-4 hover:animate-waving hover:text-green-800"
                        href="{{ route('login') }}">INICIAR SESIÓN</a>
                @else
                    {{-- <a class="text-3xl mr-4 hover:animate-waving hover:text-blue-800"
                        href="#">{{ Auth::user()->name }}</a> --}}

                    <div class="dropdown inline-block relative">
                        <button class="hover:animate-waving font-semibold rounded inline-flex items-center">
                            <span class="mr-1 text-5xl h-10 mt-12">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4 mt-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu absolute hidden pt-2 text-xl w-44">
                                    <li class=""><a
                                        class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('miPerfil') }}">Mi perfil</a></li>
                            <li class=""><a
                                    class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="{{ route('preguntas') }}">Necesito ayuda</a></li>
                            <li class="">
                                <form action="logout" method="post">
                                    @csrf
                                    <input type="submit" value="Cerrar Sesión" class="text-left w-44 bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"/>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </header>
        @if (session()->has('error'))
        <div class="bg-red-100 rounded-lg p-4 mt-4 mb-4 text-xl text-red-700" role="alert">
            <span class="font-semibold">Error:</span> {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="bg-green-100 rounded-lg p-4 mt-4 mb-4 text-xl text-green-700" role="alert">
            {{ session('success') }}
        </div>
    @endif
        <main class="mx-1 h-auto mt-4 pb-10 bg-contain"
            style="background-color: #BEF7CF">
            {{ $slot }}
        </main>
        <footer class="flex justify-center bg-gray-900   w-full h-96 mt-1">
            <div style="background-color: #FDF4E4;" class="bg-gray-100 mt-4 w-full mx-10 h-5/6">
                <div style="background-color: #FDF4E4;" class="grid grid-rows-3 grid-flow-col gap-4  h-4/5">
                    <div class="absolute mt-10">
                        <p class="ml-44 text-2xl">cines.arana@gmail.com</p>
                    </div>
                    <div class="inline-flex mt-20 ml-44 col-span-full">
                        <a href="https://www.facebook.com/"><img class="mt-3 mr-1 w-8 h-8"
                                src="{{ URL('img/facebook.png') }}" alt="facebook"></a>
                        <a href="https://www.instagram.com/"><img class="mt-1 mr-1 w-12 h-12"
                                src="{{ URL('img/instagram.png') }}" alt="instagram"></a>
                        <a href="https://www.twitter.com/"><img class="mt-3 mr-1 w-8 h-8"
                                src="{{ URL('img/twitter.png') }}" alt="twitter"></a>
                        <a href="https://www.youtube.com/"><img class="mt-3 mr-1 w-11 h-8"
                                src="{{ URL('img/youtube.png') }}" alt="youtube"></a>
                    </div>
                    <div class="col-span-2 row-span-4 text-right mr-44 mt-10">
                        <p class="text-2xl">¿Tiene algún problema?</p>
                        <p class="text-xl mr-3 mt-2"> <a class="text-[#1cc14e]" href="{{route('preguntas')}}">Contacte</a> con nosotros
                        </>
                    </div>
                </div>
            </div>
            <div class="w-full absolute mt-20">
                <p class="text-center text-2xl"><a class="hover:text-green-800" href="{{ route('cines') }}"> Nuestros
                        Cines</a>
                </p>
            </div>
            <div class="w-50 h-auto absolute mt-36">
                <a href="{{ route('inicio') }}"><img style="height: 20%; width: 20%; margin-left:40%" class="mt-3 mr-1"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>

</html>
