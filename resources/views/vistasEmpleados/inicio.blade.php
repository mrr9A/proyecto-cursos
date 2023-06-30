<x-appEmpleado title="Inicio" route="home">
    @auth
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-subtitle text-gray-800 dark:text-white">Cursos: </h2>

                <span class="px-3 py-1 text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">TOTAL DE CURSOS</span>
            </div>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Lista de los cursos inscritos</p>
        </div>

    </div>

    <div class="mt-6 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                Todos los Cursos
            </button>

            <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Cursos Aprovados
            </button>

            <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Pendientes
            </button>
            <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Reprobados
            </button>
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
                                    Estatus del curso
                                </th>

                                <th scope="col" class="py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">Calificación del Curso</th>


                                <th scope="col" class="py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">Progreso del curso</th>

                                <th scope="col" class="py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500 dark:text-gray-400">Opciones</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                            @dump(Auth::user()->cursos)

                            @foreach(Auth::user()->cursos as $curso)
                            <tr>
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <img width="50" height="50" src="{{$curso->imagen}}" alt="imagen del curso">
                                </td>
                                <td class="px-12 py-4 text-center text-sm font-medium whitespace-nowrap">
                                    {{$curso->nombre}}
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center items-center">
                                    <span class="relative inline-block px-3 py-1 text-center items-center font-semibold text-green-900 leading-tight">
                                        <span aria-hidden class="absolute bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">{{$curso->estado ? 'Activo' : 'Inactivo'}}</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center text-sm whitespace-nowrap">
                                    96
                                </td>

                                <td class="text-sm items-center text-center whitespace-nowrap">
                                    <div class="w-48 h-1.5 items-center text-center bg-blue-200 rounded-full">
                                        <div class="bg-blue-500 items-center text-center w-2/3 h-1.5"></div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-sm whitespace-nowrap items-center text-center">
                                    <button class="px-1 py-1 text-gray-500 text-center items-center transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                                            <path fill="#012254" d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0ZM1.5 8a6.5 6.5 0 1 0 13 0a6.5 6.5 0 0 0-13 0Zm4.879-2.773l4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215Z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 sm:flex sm:items-center sm:justify-between ">
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
    </div>
    @endauth
</x-appEmpleado>