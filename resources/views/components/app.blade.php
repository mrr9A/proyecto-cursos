<!DOCTYPE html>
<html lang="en" class="relative">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="">{{ $title ?? '' }}</title>
    <!-- ?? para poner un valor por default -->
    <!-- title es una variable que puede ser
recivida como atributo o encerrado en una etiqueta
slot con nombre
<x-slot name="title">Hola</x-slot>\
-->
    <meta name="description" content="{{ $metaDescription ?? 'default meta description' }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- cargando css desde la carpeta public -->
    <!-- <link href="/css/app.css" rel="stylesheet"/> -->
    <!-- cargando css y js con vite, renderiza en tiempo real -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    @livewireStyles

</head>


<body class="bg-[#fdfdfd]">
    <div class="flex h-full fixed w-[100vw]">
        <div>
            <header>
                <x-navs.nav />
            </header>
        </div>
        <div class="flex flex-grow overflow-x-auto">
            <main class=" h-full m-auto px-4 relative  overflow-x-auto min-w-[100%] z-20">
                <div class="flex items-center justify-between border-b-[1px] border-nav mb-5">
                    @if(is_null(($class ?? null)))
                    <h1 class="uppercase font-bold text-title ">{{ $title ?? 'INICIO' }}</h1>
                    @else
                    <h1 class="{{$class ?? ''}} uppercase font-bold ">{{ $title ?? 'INICIO' }}</h1>
                    @endif
                    <div class="flex gap-2 items-center cursor-pointer" id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation">
                        <x-navs.menu-profile />
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
    @livewireScripts
</body>

</html>