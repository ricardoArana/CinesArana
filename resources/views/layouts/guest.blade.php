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
        .menuItem {
  display: block;
  margin: 2rem 4rem;
  font-size: 1.8rem;
  color: white;
  text-decoration: none;
}

.menuItem:hover {
  text-decoration: underline;
}

.hamburger {
  display: block;
  position: fixed;
  z-index: 100;
  top: 1rem;
  right: 1rem;
  padding: 4px;
  border: white solid 1px;
  background: black;
  cursor: pointer;
}

.closeIcon {
  display: none;
}

.menu {
  position: fixed;
  transform: translateY(-100%);
  transition: transform 0.2s;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 99;
  background: black;
  color: white;
  list-style: none;
  padding-top: 4rem;
  width: 50%;

}

.titulos{
    display: none;
}

@media only screen and (min-width: 1080px){
    .hamburger{
        display: none;
    }
    .titulos{
        display: flex;
        justify-content: space-between;
        margin: 40px 40px 40px 144px;
        padding: 4px;
        border-bottom: 8px;
        border-color: white;
    }
}




.showMenu {
  transform: translateY(0);
}
    </style>

    {{-- Recaptcha --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body style="background-color: black; font-family: rockwell">
    <div class="font-sans text-gray-900 antialiased ">
        <header class="w-full h-28 text-white" style="background-color: black; font-family: Rockwell">
            <ul class="menu">
                @if (Auth::user())
                <li><a class="menuItem" href="{{ route('inicio') }}"><img style="height: 100px; width: 100px;"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a></li>
                @else

                <li><a class="menuItem" href="{{ route('notuser') }}"><img style="height: 100px; width: 100px;"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a></li>
                @endif
                <li><a class="menuItem" href="{{ route('peliculas') }}">Películas</a></li>
                <li><a class="menuItem" href="{{ route('cines') }}" style="margin-bottom:0%;">Cines</a></li>
                @if (Auth::user())
                <li class="z-10">
                    <div class="dropdown inline-block relative ml-[4rem] z-10">
                        <button class="hover:animate-waving font-semibold rounded inline-flex items-center z-10">
                            <span class="mr-1 text-3xl h-auto mt-[2rem]">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4 mt-[2rem]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul class="border-white border-b-2 dropdown-menu absolute hidden pt-2 text-xl w-44 z-10">
                                    <li class=""><a
                                        class="bg-black z-10 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('miPerfil') }}">Mi perfil</a></li>
                            <li class=""><a
                                    class="bg-black z-10 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="{{ route('preguntas') }}">Necesito ayuda</a></li>



                            <li class="">
                                <form action="logout" method="post">
                                    @csrf
                                    <input type="submit" value="Cerrar Sesión" class="text-left w-44 bg-black z-10 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"/>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                @else

                <li><a class="menuItem" href="{{ route('login') }}">Iniciar Sesión</a></li>
                @endif
              </ul>
              <button class="hamburger">
                <!-- material icons https://material.io/resources/icons/ -->
                <i class="menuIcon material-icons">menu</i>
                <i class="closeIcon material-icons">close</i>
              </button>
            <div class="titulos">
                @if (Auth::user())
                <a class="text-3xl ml-4 hover:animate-waving hover:text-blue-800"
                    href="{{ route('inicio') }}"><img style="height: 100px; width: 100px;"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
                    @else
                    <a class="text-3xl ml-4 hover:animate-waving hover:text-blue-800"
                    href="{{ route('notuser') }}"><img style="height: 100px; width: 100px;"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
                @endif
                <a class="text-5xl h-10 mt-12 hover:animate-waving hover:text-blue-800" href="{{ route('cines') }}">CINES</a>
                <a  class="text-5xl h-10 mt-12 hover:animate-waving hover:text-blue-800"
                    href="{{ route('peliculas') }}">PELÍCULAS</a>
                @if (empty(Auth::user()))
                    <a class="text-5xl h-10 mt-12 mr-4 hover:animate-waving hover:text-blue-800"
                        href="{{ route('login') }}">INICIAR SESIÓN</a>
                @else

                    <div class="dropdown inline-block relative">
                        <button class="hover:animate-waving font-semibold rounded inline-flex items-center">
                            @if (Auth::user()->rol == 'admin')
                            <span style="-webkit-text-stroke: 0.8px red;" class="mr-1 text-5xl h-10 mt-12">{{ Auth::user()->name }}</span>
                            @else
                            <span class="mr-1 text-5xl h-10 mt-12">{{ Auth::user()->name }}</span>
                            @endif
                            <svg class="fill-current h-4 w-4 mt-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul class="border-white border-b-2 dropdown-menu absolute hidden pt-2 text-xl w-44">
                                    <li class=""><a
                                        class="bg-black hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('miPerfil') }}">Mi perfil</a></li>
                            <li class=""><a
                                    class="bg-black hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="{{ route('preguntas') }}">Necesito ayuda</a></li>
                                    @if (Auth::user()->rol == 'admin')
                                    <li class=""><a style="-webkit-text-stroke: 0.3px red;"
                                        class="bg-black z-10 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('usuarios') }}">Lista usuarios</a></li>
                                    @endif
                            <li class="">
                                <form action="logout" method="post">
                                    @csrf
                                    <input type="submit" value="Cerrar Sesión" class="text-left w-44 bg-black hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"/>
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
            style="background-image: url({{URL('img/cineFondo.jpg')}}); background-repeat: repeat; background-size: 563px 700px;">
            {{ $slot }}
        </main>
        {{-- <footer class="flex justify-center bg-white w-full h-96 mt-1">
            <div style="background-color: black;" class="text-white bg-gray-100 mt-4 w-full mx-10 h-5/6">
                <div style="background-color: black;" class="text-white grid grid-rows-3 grid-flow-col gap-4  h-4/5">
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
                        <p class="text-xl mr-3 mt-2"> <a class="text-white hover:text-[#2635da] cursor-pointer" href="{{route('preguntas')}}">Contacte</a> con nosotros
                        </>
                    </div>
                </div>
            </div>
            <div class="w-full absolute mt-20">
                <p class="text-center text-2xl text-white"><a class="hover:text-[#2635da]" href="{{ route('cines') }}"> Nuestros
                        Cines</a>
                </p>
            </div>
            <div class="w-50 h-auto absolute mt-36">
                <a href="{{ route('inicio') }}"><img style="height: 20%; width: 20%; margin-left:40%" class="mt-3 mr-1"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
            </div>
        </footer> --}}


        <footer class="text-center bg-black text-white">
            <div class="container px-6 pt-6">
              <div class="flex ml-[50%] mb-6">
                <a href="#!" type="button" class="rounded-full border-2 border-white text-white leading-normal uppercase hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-9 h-9 m-1">
                  <svg aria-hidden="true"
                  focusable="false"
                  data-prefix="fab"
                  data-icon="facebook-f"
                  class="w-2 h-full mx-auto"
                  role="img"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 320 512"
                >
                  <path
                    fill="currentColor"
                    d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
                  ></path>
                  </svg>
                </a>

                <a href="#!" type="button" class="rounded-full border-2 border-white text-white leading-normal uppercase hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-9 h-9 m-1">
                  <svg aria-hidden="true"
                  focusable="false"
                  data-prefix="fab"
                    data-icon="twitter"
                    class="w-3 h-full mx-auto"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                  >
                    <path
                      fill="currentColor"
                      d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                    ></path>
                  </svg>
                </a>

                <a href="#!" type="button" class="rounded-full border-2 border-white text-white leading-normal uppercase hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-9 h-9 m-1">
                  <svg aria-hidden="true"
                  focusable="false"
                  data-prefix="fab"
                    data-icon="google"
                    class="w-3 h-full mx-auto"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 488 512"
                  >
                    <path
                      fill="currentColor"
                      d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"
                    ></path>
                  </svg>
                </a>

                <a href="#!" type="button" class="rounded-full border-2 border-white text-white leading-normal uppercase hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-9 h-9 m-1">
                  <svg aria-hidden="true"
                  focusable="false"
                  data-prefix="fab"
                  data-icon="instagram"
                    class="w-3 h-full mx-auto"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"
                  >
                    <path
                      fill="currentColor"
                      d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                    ></path>
                  </svg>
                </a>

                <a href="#!" type="button" class="rounded-full border-2 border-white text-white leading-normal uppercase hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-9 h-9 m-1">
                  <svg aria-hidden="true"
                  focusable="false"
                  data-prefix="fab"
                  data-icon="linkedin-in"
                    class="w-3 h-full mx-auto"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"
                  >
                    <path
                      fill="currentColor"
                      d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"
                    ></path>
                  </svg>
                </a>

                <a href="#!" type="button" class="rounded-full border-2 border-white text-white leading-normal uppercase hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-9 h-9 m-1">
                  <svg aria-hidden="true"
                  focusable="false"
                  data-prefix="fab"
                  data-icon="github"
                    class="w-3 h-full mx-auto"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 496 512"
                  >
                    <path
                      fill="currentColor"
                      d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"
                    ></path>
                  </svg>
                </a>
              </div>
            </div>

            <div class="p-4 lg:ml-[5%] xl:ml-[0%] ml-[8%] bg-black">
              © 2022 Copyright:
              <a class="text-whitehite" href="#">Cines Arana</a>
            </div>
          </footer>

    </div>
    @livewireScripts
</body>
<script>
    const menu = document.querySelector(".menu");
const menuItems = document.querySelectorAll(".menuItem");
const hamburger= document.querySelector(".hamburger");
const closeIcon= document.querySelector(".closeIcon");
const menuIcon = document.querySelector(".menuIcon");

function toggleMenu() {
  if (menu.classList.contains("showMenu")) {
    menu.classList.remove("showMenu");
    closeIcon.style.display = "none";
    menuIcon.style.display = "block";
  } else {
    menu.classList.add("showMenu");
    closeIcon.style.display = "block";
    menuIcon.style.display = "none";
  }
}

hamburger.addEventListener("click", toggleMenu);

menuItems.forEach(
  function(menuItem) {
    menuItem.addEventListener("click", toggleMenu);
  }
)
</script>
</html>
