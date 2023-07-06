<x-appEmpleado title="Inicio" route="inicioEmpleado">
    @auth
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-subtitle text-gray-800 dark:text-white">Cursos: </h2>
                <span class="px-3 py-1 text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{Auth::user()->cursos->count()}}</span>
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
                    Todos los Cursos
                </button>
            </form>

            <form action="{{ route('inicioEmpleado') }}" method="GET">
                <select name="estado" hidden>
                    <option value="Aprobado"></option>
                </select>
                <button type="submit" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Cursos Aprovados
                </button>
            </form>

            <form action="{{ route('inicioEmpleado') }}" method="GET">
                <select name="estado" hidden>
                    <option value="Pendiente"></option>
                </select>
                <button type="submit" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Cursos Pendientes
                </button>
            </form>

            <form action="{{ route('inicioEmpleado') }}" method="GET">
                <select name="estado" hidden>
                    <option value="Reprobado"></option>
                </select>
                <button type="submit" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Cursos Reprobados
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

                                <th scope="col" class=" py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                    Curso Activo o Inactivo
                                </th>

                                <th scope="col" class=" py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                    Estado del curso
                                </th>

                                <th scope="col" class="py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">Calificación del Curso</th>


                                <th scope="col" class="py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">Porcentaje del curso hecho</th>

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
                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center items-center">
                                    <span class="relative inline-block px-3 py-1 text-center items-center text-green-900 leading-tight">
                                        <span aria-hidden class="absolute bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-gray-800 font-bold">{{$calificacionesCurso['curso']->estado ? 'Activo' : 'Inactivo'}}</span>
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
                                    {{$calificacionesCurso['calificacion']}}
                                </td>
                                <td class="text-sm items-center text-center whitespace-nowrap">
                                    @if($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] >= 80)
                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                        <div class="bg-green-600 text-xs font-bold text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $calificacionesCurso['progreso'] }}%">{{ $calificacionesCurso['progreso'] }}%</div>
                                    </div>
                                    @elseif($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] < 80)
                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
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
                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center items-center">
                                    <span class="relative inline-block px-3 py-1 text-center items-center text-green-900 leading-tight">
                                        <span aria-hidden class="absolute bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-gray-800 font-bold">{{$calificacionesCurso['curso']->estado ? 'Activo' : 'Inactivo'}}</span>
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
                                    {{$calificacionesCurso['calificacion']}}
                                </td>
                                <td class="text-sm items-center text-center whitespace-nowrap">
                                @if($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] >= 80)
                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                        <div class="bg-green-600 text-xs font-bold text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $calificacionesCurso['progreso'] }}%">{{ $calificacionesCurso['progreso'] }}%</div>
                                    </div>
                                    @elseif($calificacionesCurso['progreso'] > 0 and $calificacionesCurso['calificacion'] < 80)
                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
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

    <!-- <div class="mt-6 sm:flex sm:items-center sm:justify-between ">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Page <span class="font-medium text-gray-700 dark:text-gray-100">1 of 10</span>
        </div>

        <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
            <a href="#" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>

                <span>
                    previous
                </span>
            </a>

            <a href="#" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                <span>
                    Next
                </span>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
    </div> -->
    @endauth
</x-appEmpleado>