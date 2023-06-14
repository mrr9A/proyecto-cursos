<!DOCTYPE html>
<html lang="en" class="relative ">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}</title>
    <!-- ?? para poner un valor por default -->
    <!-- title es una variable que puede ser
recivida como atributo o encerrado en una etiqueta
slot con nombre
<x-slot name="title">Hola</x-slot>\
-->
    <meta name="description" content="{{ $metaDescription ?? 'default meta description' }}" />
    <!-- cargando css desde la carpeta public -->
    <!-- <link href="/css/app.css" rel="stylesheet"/> -->
    <!-- cargando css y js con vite, renderiza en tiempo real -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>
    <div class="flex h-full fixed w-[100vw]">
        <div>
            <header>
                <x-navs.nav />
            </header>
        </div>
        <div class="flex flex-grow overflow-x-auto">
            <main class=" h-full m-auto px-4 relative  overflow-x-auto min-w-[100%] z-20">
                <div class="flex items-center justify-between">
                    <h1 class="uppercase font-bold text-title">{{ $title ?? 'INICIO' }}</h1>
                    <div class="flex gap-2 items-center">
                        <div class="w-9 h-9 bg-primary rounded-full"></div>
                        <ul>
                            <li>
                                <a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 16 16">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5">
                                            <circle cx="8" cy="2.5" r=".75" />
                                            <circle cx="8" cy="8" r=".75" />
                                            <circle cx="8" cy="13.5" r=".75" />
                                        </g>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                @if (session('status'))
                    <!-- verifica si existe un mensaje de sesion con la clave status -->
                    <div class="status">
                        {{ session('status') }}
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
        <!-- slot es una variable definida que indica donde se vacolocar el html dinamico -->
    </div>
</body>

</html>
