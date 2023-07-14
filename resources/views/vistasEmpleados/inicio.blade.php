<x-appEmpleado title="Inicio" route="inicioEmpleado">
    @auth
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-subtitle text-gray-800 dark:text-white">Cursos: </h2>
                <span class="px-3 py-1 text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{Auth::user()->usercursos->count()}}</span>
            </div>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Lista de los cursos inscritos</p>
        </div>

    </div>

    <div class="mt-6 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <form action="{{ route('inicioEmpleado') }}" method="GET">
                <select name="estado" hidden>
                    <option value="Todos" selected></option>
                </select>
                <button type="submit" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                    Todos los cursos
                </button>
            </form>

            <form action="{{ route('inicioEmpleado') }}" method="GET">
                <select name="estado" hidden>
                    <option value="Aprobado"></option>
                </select>
                <button type="submit" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Cursos aprobados
                </button>
            </form>

            <form action="{{ route('inicioEmpleado') }}" method="GET">
                <select name="estado" hidden>
                    <option value="Pendiente"></option>
                </select>
                <button type="submit" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Cursos pendientes
                </button>
            </form>

            <form action="{{ route('inicioEmpleado') }}" method="GET">
                <select name="estado" hidden>
                    <option value="Reprobado"></option>
                </select>
                <button type="submit" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Cursos reprobados
                </button>
            </form>
        </div>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 text-sm font-normal  rtl:text-right text-gray-500 dark:text-gray-400">Imagén del Curso</th>
                                <th scope="col" class="py-3.5 text-center text-sm font-normal rtl:text-right text-gray-500 dark:text-gray-400"><span>Nombre del Curso</span></th>
                                <th scope="col" class="py-3.5 text-center text-sm font-normal rtl:text-right text-gray-500 dark:text-gray-400"><span>Num. Lecciones</span></th>

                                <th scope="col" class=" py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                    Estatus del curso
                                </th>

                                <th scope="col" class=" py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                    Estado del curso
                                </th>

                                <th scope="col" class=" py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                    Inicia el:
                                </th>

                                <th scope="col" class=" py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                    Termina el:
                                </th>

                                <th scope="col" class="py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">Calificación del curso</th>


                                <th scope="col" class="py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">Progreso del curso</th>

                                <th scope="col" class="py-3.5 text-sm font-normal text-center items-center rtl:text-right text-gray-500 dark:text-gray-400">Opciones</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach($calificacionesCursos as $calificacionesCurso)
                            @if ("Todos" === $estadoSeleccionado)
                            <tr>
                                <td class="px-4 py-4 justify-center flex text-sm font-medium">
                                    <img width="80" height="80" class="object-center" src="{{$calificacionesCurso['curso']->imagen}}" alt="imagen del curso">
                                </td>
                                <td class="px-12 py-4 text-center text-sm font-medium whitespace-nowrap">
                                    {{$calificacionesCurso['curso']->nombre}}
                                </td>
                                <td class="px-12 py-4 text-center text-sm font-medium whitespace-nowrap">
                                    {{$calificacionesCurso['lecciones']}}
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center items-center">
                                    <span class="relative inline-block px-3 py-1 text-center items-center text-green-900 leading-tight">
                                        @if($calificacionesCurso['estatus'])
                                        <span class="relative text-gray-800 font-bold">Activo</span>
                                        @elseif($calificacionesCurso['fecha'] < $calificacionesCurso['fecha_inicio']) <span class="relative text-gray-800 font-bold">Pendiente por iniciar</span>
                                    @else
                                    <span class="relative text-gray-800 font-bold">Expirado</span>
                                    @endif
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center items-center">
                                    @if($calificacionesCurso['estado'] === 'Reprobado')
                                    <span class="relative flex  px-3 py-1 text-center items-center text-green-900 leading-tight">
                                        <span class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></span>
                                        <span class="font-bold text-primary">{{$calificacionesCurso['estado']}}</span>
                                    </span>
                                    @elseif($calificacionesCurso['estado'] === 'Aprobado')
                                    <span class="relative flex  px-3 py-1 text-center items-center text-green-900 leading-tight">
                                        <span class="h-2.5 w-2.5 rounded-full bg-completed mr-2"></span>
                                        <span class="font-bold text-primary">{{$calificacionesCurso['estado']}}</span>
                                    </span>
                                    @elseif($calificacionesCurso['estado'] === 'Pendiente')
                                    <span class="relative flex  px-3 py-1 text-center items-center text-green-900 leading-tight">
                                        <span class="h-2.5 w-2.5 rounded-full bg-blue-500 mr-2"></span>
                                        <span class="font-bold text-primary">{{$calificacionesCurso['estado']}}</span>
                                    </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-center text-sm whitespace-nowrap">
                                    {{$calificacionesCurso['fecha_inicio']}}
                                </td>
                                <td class="px-4 py-4 text-center text-sm whitespace-nowrap">
                                    {{$calificacionesCurso['fecha_termino']}}
                                </td>
                                <td class="px-4 py-4 text-center text-sm whitespace-nowrap">
                                    {{$calificacionesCurso['calificacion']}}
                                </td>
                                <td class="text-sm items-center text-center whitespace-nowrap">
                                    @if($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] >= 80)
                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                        <div class="bg-green-600 text-xs font-bold text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $calificacionesCurso['progreso'] }}%">{{ $calificacionesCurso['progreso'] }}%</div>
                                    </div>
                                    @elseif($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] < 80) <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                        <div class="bg-red-600 text-xs font-bold text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $calificacionesCurso['progreso'] }}%">{{ $calificacionesCurso['progreso'] }}%</div>
                </div>
                @else
                <div class="flex justify-center mb-1">
                    <span class="text-sm font-medium text-blue-700 dark:text-white">{{ $calificacionesCurso['progreso'] }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                </div>
                @endif
                </td>
                <td class="py-4 text-sm whitespace-nowrap items-center text-center">
                    @if($calificacionesCurso['estatus'])
                    <a href="{{url('cursosEmpleados',$calificacionesCurso['curso']->id_curso)}}" type="button">
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                                    <path fill="#012254" d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0ZM1.5 8a6.5 6.5 0 1 0 13 0a6.5 6.5 0 0 0-13 0Zm4.879-2.773l4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215Z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">Ver curso</span>
                        </div>
                    </a><br><br>
                    @elseif($calificacionesCurso['fecha'] < $calificacionesCurso['fecha_inicio']) <a type="button">
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 512 512">
                                    <path fill="#012966" d="M115.063 21.97v9.343c0 101.953 38.158 189.648 96.343 222.093v6.094c-58.186 32.445-96.344 120.14-96.344 222.094v9.344H401.81v-9.344c0-102.552-38.804-190.274-97.53-222.188V253.5c58.722-31.917 97.53-119.64 97.53-222.188V21.97H115.06zM134 40.655h248.875c-2.477 96.445-42.742 175.523-91.938 198.906l-5.343 2.532v28.751l5.344 2.53c49.193 23.383 89.456 102.438 91.937 198.876H134c2.456-95.898 42.125-175.078 90.875-198.938l5.25-2.562v-28.594l-5.25-2.562c-48.748-23.86-88.42-103.04-90.875-198.938zm213.656 86.125c-57.607 27.81-124.526 27.84-177.562 4.095C184.748 181.78 213.91 218.012 248.22 224a12.178 12.178 0 0 0-2.47 7.344c0 6.76 5.488 12.25 12.25 12.25s12.25-5.49 12.25-12.25c0-2.72-.907-5.218-2.406-7.25c35.426-5.88 65.488-44.07 79.812-97.313zM258 258.626c-6.762 0-12.25 5.488-12.25 12.25s5.488 12.25 12.25 12.25s12.25-5.488 12.25-12.25s-5.488-12.25-12.25-12.25zm0 39.28c-6.762 0-12.25 5.49-12.25 12.25c0 6.763 5.488 12.25 12.25 12.25s12.25-5.487 12.25-12.25c0-6.76-5.488-12.25-12.25-12.25zm0 39.533c-6.762 0-12.25 5.488-12.25 12.25c0 6.76 5.488 12.25 12.25 12.25s12.25-5.49 12.25-12.25c0-6.762-5.488-12.25-12.25-12.25zm.125 39.906c-23.21.28-46.19 25.77-75.813 75.656h153c-30.523-51.003-53.977-75.936-77.187-75.656z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">Pendiente por iniciar</span>
                        </div>
                        </a><br><br>
                        @else
                        <a type="button">
                            <div class="flex justify-center">
                                <span class="text-sm font-medium text-blue-700 dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 48 48">
                                        <circle cx="17" cy="17" r="14" fill="#00ACC1" />
                                        <circle cx="17" cy="17" r="11" fill="#eee" />
                                        <path d="M16 8h2v9h-2z" />
                                        <path d="m22.655 20.954l-1.697 1.697l-4.808-4.807l1.697-1.697z" />
                                        <circle cx="17" cy="17" r="2" />
                                        <circle cx="17" cy="17" r="1" fill="#00ACC1" />
                                        <path fill="#FFC107" d="m11.9 42l14.4-24.1c.8-1.3 2.7-1.3 3.4 0L44.1 42c.8 1.3-.2 3-1.7 3H13.6c-1.5 0-2.5-1.7-1.7-3z" />
                                        <path fill="#263238" d="M26.4 39.9c0-.2 0-.4.1-.6s.2-.3.3-.5s.3-.2.5-.3s.4-.1.6-.1s.5 0 .7.1s.4.2.5.3s.2.3.3.5s.1.4.1.6s0 .4-.1.6s-.2.3-.3.5s-.3.2-.5.3s-.4.1-.7.1s-.5 0-.6-.1s-.4-.2-.5-.3s-.2-.3-.3-.5s-.1-.4-.1-.6zm2.8-3.1h-2.3l-.4-9.8h3l-.3 9.8z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex justify-center">
                                <span class="text-sm font-medium text-blue-700 dark:text-white">Curso expirado</span>
                            </div>
                        </a><br><br>
                        @endif
                        @if($calificacionesCurso['calificacion'] >= 80 and $calificacionesCurso['progreso'] == 100)
                        <a href="{{route('descargarCertificado',$calificacionesCurso['curso']->id_curso)}}" type="button">
                            <div class="flex justify-center">
                                <span class="text-sm font-medium text-blue-700 dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                                        <path fill="none" stroke="#012966" stroke-width="2" d="M15 19H2V1h16v4m0 0a5 5 0 1 1 0 10a5 5 0 0 1 0-10zm-3 9v8l3-2l3 2v-8M5 8h6m-6 3h5m-5 3h2M5 5h2" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex justify-center">
                                <span class="text-sm font-medium text-blue-700 dark:text-white">Descargar certificado</span>
                            </div>
                        </a>
                        @endif
                </td>
                </tr>
                @endif
                @if ($calificacionesCurso['estado'] === $estadoSeleccionado)
                <tr>
                    <td class="px-4 py-4 justify-center flex text-sm font-medium">
                        <img width="80" height="80" class="object-center" src="{{$calificacionesCurso['curso']->imagen}}" alt="imagen del curso">
                    </td>
                    <td class="px-12 py-4 text-center text-sm font-medium whitespace-nowrap">
                        {{$calificacionesCurso['curso']->nombre}}
                    </td>
                    <td class="px-12 py-4 text-center text-sm font-medium whitespace-nowrap">
                        {{$calificacionesCurso['lecciones']}}
                    </td>
                    <td class="px-4 py-4 text-sm whitespace-nowrap text-center items-center">
                        <span class="relative inline-block px-3 py-1 text-center items-center text-green-900 leading-tight">
                            @if($calificacionesCurso['estatus'])
                            <span class="relative text-gray-800 font-bold">Activo</span>
                            @elseif($calificacionesCurso['fecha'] < $calificacionesCurso['fecha_inicio']) <span class="relative text-gray-800 font-bold">Pendiente por Iniciar</span>
                        @else
                        <span class="relative text-gray-800 font-bold">Expirado</span>
                        @endif
                        </span>
                    </td>
                    <td class="px-4 py-4 text-sm whitespace-nowrap text-center items-center">
                        @if($calificacionesCurso['estado'] === 'Reprobado')
                        <span class="relative flex  px-3 py-1 text-center items-center text-green-900 leading-tight">
                            <span class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></span>
                            <span class="font-bold text-primary">{{$calificacionesCurso['estado']}}</span>
                        </span>
                        @elseif($calificacionesCurso['estado'] === 'Aprobado')
                        <span class="relative flex  px-3 py-1 text-center items-center text-green-900 leading-tight">
                            <span class="h-2.5 w-2.5 rounded-full bg-completed mr-2"></span>
                            <span class="font-bold text-primary">{{$calificacionesCurso['estado']}}</span>
                        </span>
                        @elseif($calificacionesCurso['estado'] === 'Pendiente')
                        <span class="relative flex  px-3 py-1 text-center items-center text-green-900 leading-tight">
                            <span class="h-2.5 w-2.5 rounded-full bg-blue-500 mr-2"></span>
                            <span class="font-bold text-primary">{{$calificacionesCurso['estado']}}</span>
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center text-sm whitespace-nowrap">
                        {{$calificacionesCurso['fecha_inicio']}}
                    </td>
                    <td class="px-4 py-4 text-center text-sm whitespace-nowrap">
                        {{$calificacionesCurso['fecha_termino']}}
                    </td>
                    <td class="px-4 py-4 text-center text-sm whitespace-nowrap">
                        {{$calificacionesCurso['calificacion']}}
                    </td>
                    <td class="text-sm items-center text-center whitespace-nowrap">
                        @if($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] >= 80)
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="bg-green-600 text-xs font-bold text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $calificacionesCurso['progreso'] }}%">{{ $calificacionesCurso['progreso'] }}%</div>
                        </div>
                        @elseif($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] < 80) <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="bg-red-600 text-xs font-bold text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $calificacionesCurso['progreso'] }}%">{{ $calificacionesCurso['progreso'] }}%</div>
            </div>
            @else
            <div class="flex justify-center mb-1">
                <span class="text-sm font-medium text-blue-700 dark:text-white">{{ $calificacionesCurso['progreso'] }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
            </div>
            @endif
            </td>
            <td class="py-4 text-sm whitespace-nowrap items-center text-center">
                @if($calificacionesCurso['fecha'] < $calificacionesCurso['fecha_inicio']) <a type="button">
                    <div class="flex justify-center">
                        <span class="text-sm font-medium text-blue-700 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 512 512">
                                <path fill="#012966" d="M115.063 21.97v9.343c0 101.953 38.158 189.648 96.343 222.093v6.094c-58.186 32.445-96.344 120.14-96.344 222.094v9.344H401.81v-9.344c0-102.552-38.804-190.274-97.53-222.188V253.5c58.722-31.917 97.53-119.64 97.53-222.188V21.97H115.06zM134 40.655h248.875c-2.477 96.445-42.742 175.523-91.938 198.906l-5.343 2.532v28.751l5.344 2.53c49.193 23.383 89.456 102.438 91.937 198.876H134c2.456-95.898 42.125-175.078 90.875-198.938l5.25-2.562v-28.594l-5.25-2.562c-48.748-23.86-88.42-103.04-90.875-198.938zm213.656 86.125c-57.607 27.81-124.526 27.84-177.562 4.095C184.748 181.78 213.91 218.012 248.22 224a12.178 12.178 0 0 0-2.47 7.344c0 6.76 5.488 12.25 12.25 12.25s12.25-5.49 12.25-12.25c0-2.72-.907-5.218-2.406-7.25c35.426-5.88 65.488-44.07 79.812-97.313zM258 258.626c-6.762 0-12.25 5.488-12.25 12.25s5.488 12.25 12.25 12.25s12.25-5.488 12.25-12.25s-5.488-12.25-12.25-12.25zm0 39.28c-6.762 0-12.25 5.49-12.25 12.25c0 6.763 5.488 12.25 12.25 12.25s12.25-5.487 12.25-12.25c0-6.76-5.488-12.25-12.25-12.25zm0 39.533c-6.762 0-12.25 5.488-12.25 12.25c0 6.76 5.488 12.25 12.25 12.25s12.25-5.49 12.25-12.25c0-6.762-5.488-12.25-12.25-12.25zm.125 39.906c-23.21.28-46.19 25.77-75.813 75.656h153c-30.523-51.003-53.977-75.936-77.187-75.656z" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex justify-center">
                        <span class="text-sm font-medium text-blue-700 dark:text-white">Pendiente por iniciar</span>
                    </div>
                    </a><br><br>
                    @elseif($calificacionesCurso['estatus'])
                    <a href="{{url('cursosEmpleados',$calificacionesCurso['curso']->id_curso)}}" type="button">
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                                    <path fill="#012254" d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0ZM1.5 8a6.5 6.5 0 1 0 13 0a6.5 6.5 0 0 0-13 0Zm4.879-2.773l4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215Z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">Ver curso</span>
                        </div>
                    </a><br><br>
                    @else
                    <a type="button">
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 48 48">
                                    <circle cx="17" cy="17" r="14" fill="#00ACC1" />
                                    <circle cx="17" cy="17" r="11" fill="#eee" />
                                    <path d="M16 8h2v9h-2z" />
                                    <path d="m22.655 20.954l-1.697 1.697l-4.808-4.807l1.697-1.697z" />
                                    <circle cx="17" cy="17" r="2" />
                                    <circle cx="17" cy="17" r="1" fill="#00ACC1" />
                                    <path fill="#FFC107" d="m11.9 42l14.4-24.1c.8-1.3 2.7-1.3 3.4 0L44.1 42c.8 1.3-.2 3-1.7 3H13.6c-1.5 0-2.5-1.7-1.7-3z" />
                                    <path fill="#263238" d="M26.4 39.9c0-.2 0-.4.1-.6s.2-.3.3-.5s.3-.2.5-.3s.4-.1.6-.1s.5 0 .7.1s.4.2.5.3s.2.3.3.5s.1.4.1.6s0 .4-.1.6s-.2.3-.3.5s-.3.2-.5.3s-.4.1-.7.1s-.5 0-.6-.1s-.4-.2-.5-.3s-.2-.3-.3-.5s-.1-.4-.1-.6zm2.8-3.1h-2.3l-.4-9.8h3l-.3 9.8z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">Curso expirado</span>
                        </div>
                    </a><br><br>
                    @endif
                    @if($calificacionesCurso['calificacion'] >= 80 and $calificacionesCurso['progreso'] == 100)
                    <a href="{{route('descargarCertificado',$calificacionesCurso['curso']->id_curso)}}" type="button">
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24">
                                    <path fill="none" stroke="#012966" stroke-width="2" d="M15 19H2V1h16v4m0 0a5 5 0 1 1 0 10a5 5 0 0 1 0-10zm-3 9v8l3-2l3 2v-8M5 8h6m-6 3h5m-5 3h2M5 5h2" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex justify-center">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">Descargar certificado</span>
                        </div>
                    </a>
                    @endif
            </td>
            </tr>

            @endif
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

    @endauth
</x-appEmpleado>