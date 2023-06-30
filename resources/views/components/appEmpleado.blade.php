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
    <!-- cargando css y js con vite, renderiza en tiempo real -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    @livewireStyles

</head>

<body class="bg-[#fdfdfd]">
    <div class="flex h-full fixed w-[100vw]">
        <div>
            <header>
                <!-- <x-navs.nav /> -->
            </header>
        </div>
        <div class="flex flex-grow overflow-x-auto">
            <main class=" h-full m-auto px-4 relative  overflow-x-auto min-w-[100%] z-20">
                <div class="flex items-center justify-between border-b-[1px] border-nav mb-5 py-2">
                    @if(is_null(($class ?? null)))
                    <h1 class="uppercase font-bold text-title ">
                        <div class="inline-flex items-center">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24">
                                    <path fill="#012254" fill-opacity="0" d="M5 8.5L12 3L19 8.5V21H15V13L14 12H10L9 13V21H5V8.5Z">
                                        <animate fill="freeze" attributeName="fill-opacity" begin="0.9s" dur="0.15s" values="0;0.3" />
                                    </path>
                                    <g fill="none" stroke="#012254" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke-dasharray="15" stroke-dashoffset="15" d="M4.5 21.5h15">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="15;0" />
                                        </path>
                                        <path stroke-dasharray="15" stroke-dashoffset="15" d="M4.5 21.5V8M19.5 21.5V8">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="15;0" />
                                        </path>
                                        <path stroke-dasharray="24" stroke-dashoffset="24" d="M9.5 21.5V12.5H14.5V21.5">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.4s" values="24;0" />
                                        </path>
                                        <path stroke-dasharray="30" stroke-dashoffset="30" stroke-width="2" d="M2 10L12 2L22 10">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.4s" values="30;0" />
                                        </path>
                                    </g>
                                </svg></span>
                                <span class="mx-3">{{ $title ?? 'INICIO' }} </span>
                        </div>
                    </h1>
                    @else
                    <h1 class="{{$class ?? ''}} uppercase font-bold ">{{ $title ?? 'INICIO' }}</h1>
                    @endif
                    <div class="flex gap-2 items-center cursor-pointer" id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation">
                        <x-navs.nav-empleado route={{$route}}/>
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