<x-app>
    <!-- La cotorisa  podcats-->
    <div class="container mt-2 mx-3">
        <div class="flex">
            <!-- CUERPO DE TODO INFORMACION DEL CURSO, LECCIONES. CONTENIDO -->
            <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <!-- OPCIONES -->
                <div class="flex justify-start mx-12 items-center">
                    <x-modal title="EDITAR CURSO" textButton="Editar Información Curso" id="editar_curso_interno" vistaContenidoModal="cursosinternos.cursos.editarCurso" :curso="$curso" :modalidad="$modalidad" :tipo="$tipo" />
                    <div>
                        <form action="{{ url('Lecciones',[$curso]) }}">
                            <button class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">Agregar una Lección</button>
                        </form>
                    </div>
                </div><br>
                <!-- FIN -->
                <div class="p-2 bg-white border border-gray-200 rounded-lg shadow mx-12 text-center">
                    <img src="{{$curso['imagen']}}" class="rounded-full w-96 h-96 inline-block " width="350" height="350">
                </div>
                <div class="p-2 bg-white border border-gray-200 rounded-lg shadow mx-12 text-center">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 bg:text-4xl">Nombre del Curso: {{$curso->nombre}}</h2><br>
                        <h3 class="text-1xl font-bold tracking-tight text-dark-500 bg:text-2xl">Codigo del Curso: {{$curso->codigo}}</h3><br>
                        <h5 class="text-1xl font-bold tracking-tight text-gray-600 bg:text-2">Modalidad del Curso:
                            @foreach($modalidad as $modi)
                            @if($modi->id_modalidad == $curso->modalidad_id)
                            {{$modi->modalidad}}
                            @endif
                            @endforeach
                        </h5><br>
                        <h5 class="text-1xl font-bold tracking-tight text-gray-600 sm:text-2">Tipo de Curso:
                            @foreach($tipo as $tip)
                            @if($tip->id_tipo_curso == $curso->tipo_curso_id)
                            {{$tip->nombre}}
                            @endif
                            @endforeach
                        </h5>
                    </div>
                </div>
                <br>
                <div id="accordion-color" data-accordion="collapse" data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                    @foreach($curso->lecciones as $leccion)
                    <h2 id="accordion-color-heading-{{$leccion->id_leccion}}" class="col-lg-12 mb-6 mb-lg-0 position-relative">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-color-body-{{$leccion->id_leccion}}" aria-expanded="true" aria-controls="accordion-color-body-{{$leccion->id_leccion}}">
                            <span><img src="{{$leccion->url_imagen}}" width="50" height="50" class="avatar" alt="Imagen"></span>
                            <span>{{$leccion->nombre}}</span>
                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-color-body-{{$leccion->id_leccion}}" class="hidden" aria-labelledby="accordion-color-heading-{{$leccion->id_leccion}}">
                        <div class="border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900 col-lg-12 mb-6 mb-lg-0 position-relative">
                            <br>
                            <div class="flex justify-between px-4 items-center overflow-auto gap-3">
                                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">DESCRIPCIÓN DEL CURSO</h5>
                                    <p>{{$leccion->descripcion}}</p>
                                </div>
                                <!-- OPCIONES -->
                                <div class="flex justify-end px-4">
                                    <button id="dropdownButton3-{{$leccion->id_leccion}}" data-dropdown-toggle="dropdown3-{{$leccion->id_leccion}}" class="flex items-center text-input font-bold dark:text-gray-400 hover:bg-gray-300 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg p-1.5" type="button">
                                        <span>Opciones</span>
                                        <span class="justify-end">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                                    <circle cx="8" cy="2.5" r=".75" />
                                                    <circle cx="8" cy="8" r=".75" />
                                                    <circle cx="8" cy="13.5" r=".75" />
                                                </g>
                                            </svg>
                                        </span>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown3-{{$leccion->id_leccion}}" class=" hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <ul class="py-2" aria-labelledby="dropdownButton3-{{$leccion->id_leccion}}">
                                            <li>
                                                <a href="{{ url('contenidos',[$leccion]) }}" class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
                                                    Agregar Contenido
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('editLec',[$leccion]) }}" class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
                                                    Editar Leccion
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ url('Lecciones',[$leccion]) }}" method="POST" class="formulario-eliminar">
                                                    @method("DELETE")
                                                    @csrf
                                                    <button type="submit" class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
                                                        Eliminar Lección
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- FIN -->
                            </div><br>
                            @foreach($leccion->contenido as $conteni)
                            <div class="border-top px-2 py-3 mx-4 min-height-70 d-md-flex align-items-center bg-gray-100 col-lg-11 mb-6 mb-lg-0">
                                <div class="flex justify-between px-4 items-center overflow-auto gap-3">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 20 20">
                                            <path fill="currentColor" d="M10 2c4.42 0 8 3.58 8 8s-3.58 8-8 8s-8-3.58-8-8s3.58-8 8-8zm0 14c3.31 0 6-2.69 6-6s-2.69-6-6-6s-6 2.69-6 6s2.69 6 6 6zm-.71-5.29c.07.05.14.1.23.15l-.02.02L14 13l-3.03-3.19L10 5l-.97 4.81h.01c0 .02-.01.05-.02.09S9 9.97 9 10c0 .28.1.52.29.71z" />
                                        </svg>
                                    </span>{{$conteni->nombre}}
                                    <div class="flex overflow-auto gap-3 items-center">
                                        <form action="{{url('contenidos',[$conteni])}}" method="POST" id="{{$conteni->nombre}}" class="text-secondary formulario-eliminarCont">
                                            @method("DELETE")
                                            @csrf

                                            <button type="submit" class="btn text-red-500 text-center">
                                                <span class="text-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 50 50">
                                                        <path d="M 21.800781 10.099609 C 20.916781 10.099609 20.199219 10.815219 20.199219 11.699219 L 20.199219 12.099609 L 9.8007812 12.099609 C 9.5247813 12.099609 9.3007812 12.323609 9.3007812 12.599609 C 9.3007812 12.875609 9.5247813 13.099609 9.8007812 13.099609 L 11.740234 13.099609 L 13.857422 38.507812 C 14.017422 40.410812 15.636922 41.900391 17.544922 41.900391 L 32.455078 41.900391 C 34.363078 41.900391 35.982625 40.410812 36.140625 38.507812 L 38.257812 13.099609 L 40.199219 13.099609 C 40.476219 13.099609 40.699219 12.875609 40.699219 12.599609 C 40.699219 12.323609 40.475219 12.099609 40.199219 12.099609 L 29.800781 12.099609 L 29.800781 11.699219 C 29.800781 10.815219 29.083219 10.099609 28.199219 10.099609 L 21.800781 10.099609 z M 12.742188 13.099609 L 37.255859 13.099609 L 35.144531 38.423828 C 35.028531 39.812828 33.848078 40.900391 32.455078 40.900391 L 17.542969 40.900391 C 16.150969 40.900391 14.969516 39.811828 14.853516 38.423828 L 12.742188 13.099609 z"></path>
                                                    </svg>
                                                </span>
                                                <span class="text-sm">Eliminar Contenido</span>
                                            </button>
                                        </form>
                                        <a href="{{route('ediConte',[$conteni])}}" class="text-secondary">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 50 50">
                                                    <path d="M40.561,11.987c0.586,0.586,0.586,1.536,0,2.121L15.488,39.181l-5.292,1.77c-0.709,0.237-1.384-0.438-1.147-1.147	l1.77-5.292L35.892,9.439c0.586-0.586,1.536-0.586,2.121,0L40.561,11.987z M33.274,13.294L11.583,34.985l-1.058,3.164l1.325,1.325	l3.165-1.058l21.691-21.691L33.274,13.294z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-sm">Edita Contenido</span>
                                        </a>
                                        @if(count($conteni->examen) > 0 )
                                        <form action="{{url('examenes',[$conteni->examen[0]->id_examen])}}" method="POST" id="{{$conteni->nombre}}" class="text-secondary formulario-eliminarEx">
                                            @method("DELETE")
                                            @csrf

                                            <button type="submit" class="btn text-center">
                                                <span class="text-center text-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 48 48">
                                                        <g fill="currentColor">
                                                            <path d="M20 15a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Zm-1 10a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Z" />
                                                            <path fill-rule="evenodd" d="M10 27a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-5Zm2 1v3h3v-3h-3Z" clip-rule="evenodd" />
                                                            <path d="M17.707 15.707a1 1 0 0 0-1.414-1.414L13 17.586l-1.293-1.293a1 1 0 0 0-1.414 1.414L13 20.414l4.707-4.707Z" />
                                                            <path fill-rule="evenodd" d="M10 6a4 4 0 0 0-4 4v28a4 4 0 0 0 4 4h20a4 4 0 0 0 4-4V10a4 4 0 0 0-4-4H10Zm-2 4a2 2 0 0 1 2-2h20a2 2 0 0 1 2 2v28a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2V10Zm28 6a3 3 0 1 1 6 0v20.303l-3 4.5l-3-4.5V16Zm3-1a1 1 0 0 0-1 1v2h2v-2a1 1 0 0 0-1-1Zm0 22.197l-1-1.5V20h2v15.697l-1 1.5Z" clip-rule="evenodd" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <span class="text-center text-sm text-red-500">Eliminar examen</span><br>
                                            </button>
                                        </form>
                                        @else
                                        <a href="{{url('examenes',[$conteni])}}">
                                            <span class="text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 48 48">
                                                    <g fill="currentColor">
                                                        <path d="M20 15a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Zm-1 10a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Z" />
                                                        <path fill-rule="evenodd" d="M10 27a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-5Zm2 1v3h3v-3h-3Z" clip-rule="evenodd" />
                                                        <path d="M17.707 15.707a1 1 0 0 0-1.414-1.414L13 17.586l-1.293-1.293a1 1 0 0 0-1.414 1.414L13 20.414l4.707-4.707Z" />
                                                        <path fill-rule="evenodd" d="M10 6a4 4 0 0 0-4 4v28a4 4 0 0 0 4 4h20a4 4 0 0 0 4-4V10a4 4 0 0 0-4-4H10Zm-2 4a2 2 0 0 1 2-2h20a2 2 0 0 1 2 2v28a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2V10Zm28 6a3 3 0 1 1 6 0v20.303l-3 4.5l-3-4.5V16Zm3-1a1 1 0 0 0-1 1v2h2v-2a1 1 0 0 0-1-1Zm0 22.197l-1-1.5V20h2v15.697l-1 1.5Z" clip-rule="evenodd" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <span class="text-center">examen</span>
                                        </a>
                                        @endif
                                        <a href="{{route('ver',[$conteni])}}" class="text-secondary">
                                            <!-- Icon -->
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 16 16">
                                                    <path fill="currentColor" d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0ZM1.5 8a6.5 6.5 0 1 0 13 0a6.5 6.5 0 0 0-13 0Zm4.879-2.773l4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215Z" />
                                                </svg>
                                            </span>
                                            <span class="text-sm">Ver Contenido</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- ---------------------------------- -->
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>

            <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <!-- CARDS DE LA INFORMACION MAS RELEVANTE DELCURSO -->
                <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <div class="pt-5 pb-4 px-5 px-lg-3 px-xl-5">
                        <h3 class="mb-5 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Información General del Curso</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="text-secondary items-center flex icon-uxs">
                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"></path>
                                        <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"></path>
                                    </svg>
                                    <h6 class="mb-0 ml-3 mr-2 font-bold tracking-tight text-gray-900">Duración: </h6>
                                    <span>
                                        @foreach($tipo as $tip)
                                        @if($tip->id_tipo_curso == $curso->tipo_curso_id)
                                        {{$tip->duracion}}
                                        @endif
                                        @endforeach
                                    </span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="text-secondary items-center flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.7262 1.94825C13.4059 0.396725 10.401 0.315126 8.00002 1.73839C5.59897 0.315126 2.59406 0.396725 0.273859 1.94825C0.102729 2.06241 -3.54271e-05 2.25456 6.30651e-07 2.46027V14.6553C-0.000323889 14.8826 0.124616 15.0914 0.324917 15.1987C0.525109 15.3058 0.768066 15.294 0.9569 15.168C2.98471 13.8111 5.63063 13.8111 7.65844 15.168C7.66645 15.1735 7.67568 15.1747 7.68368 15.1796C7.69169 15.1846 7.7003 15.1932 7.70953 15.1987C7.73102 15.2079 7.75302 15.2159 7.77538 15.2227C7.79773 15.2329 7.82077 15.2415 7.84428 15.2486C7.87828 15.2564 7.91286 15.2616 7.94766 15.264C7.96551 15.264 7.98213 15.2714 7.99998 15.2714C8.00492 15.2714 8.00982 15.2714 8.01538 15.2714C8.03604 15.2699 8.05655 15.2672 8.07693 15.2634C8.10808 15.2602 8.13895 15.2547 8.16923 15.2467C8.19018 15.2399 8.21074 15.2319 8.23078 15.2227C8.24986 15.2147 8.27016 15.2104 8.28862 15.2006C8.29724 15.1956 8.30402 15.1883 8.31264 15.1827C8.32125 15.1772 8.3311 15.1753 8.33971 15.1698C10.3675 13.8129 13.0134 13.8129 15.0413 15.1698C15.3233 15.3595 15.7057 15.2846 15.8953 15.0026C15.9643 14.9 16.0008 14.779 16 14.6554V2.46027C16 2.25456 15.8973 2.06241 15.7262 1.94825ZM7.38462 13.6036C5.43516 12.6896 3.18022 12.6896 1.23076 13.6036V2.79993C3.12732 1.67313 5.48806 1.67313 7.38462 2.79993V13.6036ZM14.7692 13.6036C12.8198 12.6896 10.5648 12.6896 8.61538 13.6036V2.79993C10.5119 1.67313 12.8727 1.67313 14.7692 2.79993V13.6036Z" fill="currentColor"></path>
                                    </svg>
                                    <h6 class="mb-0 ml-3 mr-2 font-bold tracking-tight text-gray-900">Lecciones: </h6>
                                    <span> 32 Lecciones</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="text-secondary items-center flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.7188 9.8575V3.1875C15.7188 2.41209 15.0879 1.78125 14.3125 1.78125H12.4688V1.25C12.4688 0.991125 12.2589 0.78125 12 0.78125C11.7411 0.78125 11.5312 0.991125 11.5312 1.25V1.78125H8.46875V1.25C8.46875 0.991125 8.25887 0.78125 8 0.78125C7.74113 0.78125 7.53125 0.991125 7.53125 1.25V1.78125H4.46875V1.25C4.46875 0.991125 4.25887 0.78125 4 0.78125C3.74113 0.78125 3.53125 0.991125 3.53125 1.25V1.78125H1.40625C0.630844 1.78125 0 2.41209 0 3.1875V11.8125C0 12.5879 0.630844 13.2188 1.40625 13.2188H8.68531C9.35484 14.4112 10.6317 15.2188 12.0938 15.2188C14.2477 15.2188 16 13.4664 16 11.3125C16 10.7985 15.9 10.3074 15.7188 9.8575ZM12.5625 8.38087C13.8248 8.58197 14.8243 9.58144 15.0254 10.8438H12.5625V8.38087ZM1.40625 12.2812C1.14778 12.2812 0.9375 12.071 0.9375 11.8125V3.1875C0.9375 2.92903 1.14778 2.71875 1.40625 2.71875H3.53125V3.28125C3.53125 3.54012 3.74113 3.75 4 3.75C4.25887 3.75 4.46875 3.54012 4.46875 3.28125V2.71875H7.53125V3.28125C7.53125 3.54012 7.74113 3.75 8 3.75C8.25887 3.75 8.46875 3.54012 8.46875 3.28125V2.71875H11.5312V3.28125C11.5312 3.54012 11.7411 3.75 12 3.75C12.2589 3.75 12.4688 3.54012 12.4688 3.28125V2.71875H14.3125C14.571 2.71875 14.7812 2.92903 14.7812 3.1875V8.48034C14.0805 7.81506 13.134 7.40625 12.0938 7.40625C9.93984 7.40625 8.1875 9.15859 8.1875 11.3125C8.1875 11.6468 8.22978 11.9713 8.30916 12.2812H1.40625ZM12.0938 14.2812C10.4568 14.2812 9.125 12.9495 9.125 11.3125C9.125 9.83503 10.21 8.60631 11.625 8.38087V11.3125C11.625 11.5714 11.8349 11.7812 12.0938 11.7812H15.0254C14.7999 13.1962 13.5712 14.2812 12.0938 14.2812Z" fill="currentColor"></path>
                                        <path d="M3.25 5.78125H2.5C2.24112 5.78125 2.03125 5.99112 2.03125 6.25C2.03125 6.50888 2.24112 6.71875 2.5 6.71875H3.25C3.50888 6.71875 3.71875 6.50888 3.71875 6.25C3.71875 5.99112 3.50888 5.78125 3.25 5.78125Z" fill="currentColor"></path>
                                        <path d="M6 5.78125H5.25C4.99112 5.78125 4.78125 5.99112 4.78125 6.25C4.78125 6.50888 4.99112 6.71875 5.25 6.71875H6C6.25888 6.71875 6.46875 6.50888 6.46875 6.25C6.46875 5.99112 6.25888 5.78125 6 5.78125Z" fill="currentColor"></path>
                                        <path d="M6 7.78125H5.25C4.99112 7.78125 4.78125 7.99112 4.78125 8.25C4.78125 8.50888 4.99112 8.71875 5.25 8.71875H6C6.25888 8.71875 6.46875 8.50888 6.46875 8.25C6.46875 7.99112 6.25888 7.78125 6 7.78125Z" fill="currentColor"></path>
                                        <path d="M3.25 7.78125H2.5C2.24112 7.78125 2.03125 7.99112 2.03125 8.25C2.03125 8.50888 2.24112 8.71875 2.5 8.71875H3.25C3.50888 8.71875 3.71875 8.50888 3.71875 8.25C3.71875 7.99112 3.50888 7.78125 3.25 7.78125Z" fill="currentColor"></path>
                                        <path d="M3.25 9.78125H2.5C2.24112 9.78125 2.03125 9.99112 2.03125 10.25C2.03125 10.5089 2.24112 10.7188 2.5 10.7188H3.25C3.50888 10.7188 3.71875 10.5089 3.71875 10.25C3.71875 9.99112 3.50888 9.78125 3.25 9.78125Z" fill="currentColor"></path>
                                        <path d="M6 9.78125H5.25C4.99112 9.78125 4.78125 9.99112 4.78125 10.25C4.78125 10.5089 4.99112 10.7188 5.25 10.7188H6C6.25888 10.7188 6.46875 10.5089 6.46875 10.25C6.46875 9.99112 6.25888 9.78125 6 9.78125Z" fill="currentColor"></path>
                                    </svg>
                                    <h6 class="mb-0 ml-3 mr-2 font-bold tracking-tight text-gray-900">Publicado el: </h6>
                                    <span>{{$curso->fecha_inicio}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="text-secondary items-center flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.7188 9.8575V3.1875C15.7188 2.41209 15.0879 1.78125 14.3125 1.78125H12.4688V1.25C12.4688 0.991125 12.2589 0.78125 12 0.78125C11.7411 0.78125 11.5312 0.991125 11.5312 1.25V1.78125H8.46875V1.25C8.46875 0.991125 8.25887 0.78125 8 0.78125C7.74113 0.78125 7.53125 0.991125 7.53125 1.25V1.78125H4.46875V1.25C4.46875 0.991125 4.25887 0.78125 4 0.78125C3.74113 0.78125 3.53125 0.991125 3.53125 1.25V1.78125H1.40625C0.630844 1.78125 0 2.41209 0 3.1875V11.8125C0 12.5879 0.630844 13.2188 1.40625 13.2188H8.68531C9.35484 14.4112 10.6317 15.2188 12.0938 15.2188C14.2477 15.2188 16 13.4664 16 11.3125C16 10.7985 15.9 10.3074 15.7188 9.8575ZM12.5625 8.38087C13.8248 8.58197 14.8243 9.58144 15.0254 10.8438H12.5625V8.38087ZM1.40625 12.2812C1.14778 12.2812 0.9375 12.071 0.9375 11.8125V3.1875C0.9375 2.92903 1.14778 2.71875 1.40625 2.71875H3.53125V3.28125C3.53125 3.54012 3.74113 3.75 4 3.75C4.25887 3.75 4.46875 3.54012 4.46875 3.28125V2.71875H7.53125V3.28125C7.53125 3.54012 7.74113 3.75 8 3.75C8.25887 3.75 8.46875 3.54012 8.46875 3.28125V2.71875H11.5312V3.28125C11.5312 3.54012 11.7411 3.75 12 3.75C12.2589 3.75 12.4688 3.54012 12.4688 3.28125V2.71875H14.3125C14.571 2.71875 14.7812 2.92903 14.7812 3.1875V8.48034C14.0805 7.81506 13.134 7.40625 12.0938 7.40625C9.93984 7.40625 8.1875 9.15859 8.1875 11.3125C8.1875 11.6468 8.22978 11.9713 8.30916 12.2812H1.40625ZM12.0938 14.2812C10.4568 14.2812 9.125 12.9495 9.125 11.3125C9.125 9.83503 10.21 8.60631 11.625 8.38087V11.3125C11.625 11.5714 11.8349 11.7812 12.0938 11.7812H15.0254C14.7999 13.1962 13.5712 14.2812 12.0938 14.2812Z" fill="currentColor"></path>
                                        <path d="M3.25 5.78125H2.5C2.24112 5.78125 2.03125 5.99112 2.03125 6.25C2.03125 6.50888 2.24112 6.71875 2.5 6.71875H3.25C3.50888 6.71875 3.71875 6.50888 3.71875 6.25C3.71875 5.99112 3.50888 5.78125 3.25 5.78125Z" fill="currentColor"></path>
                                        <path d="M6 5.78125H5.25C4.99112 5.78125 4.78125 5.99112 4.78125 6.25C4.78125 6.50888 4.99112 6.71875 5.25 6.71875H6C6.25888 6.71875 6.46875 6.50888 6.46875 6.25C6.46875 5.99112 6.25888 5.78125 6 5.78125Z" fill="currentColor"></path>
                                        <path d="M6 7.78125H5.25C4.99112 7.78125 4.78125 7.99112 4.78125 8.25C4.78125 8.50888 4.99112 8.71875 5.25 8.71875H6C6.25888 8.71875 6.46875 8.50888 6.46875 8.25C6.46875 7.99112 6.25888 7.78125 6 7.78125Z" fill="currentColor"></path>
                                        <path d="M3.25 7.78125H2.5C2.24112 7.78125 2.03125 7.99112 2.03125 8.25C2.03125 8.50888 2.24112 8.71875 2.5 8.71875H3.25C3.50888 8.71875 3.71875 8.50888 3.71875 8.25C3.71875 7.99112 3.50888 7.78125 3.25 7.78125Z" fill="currentColor"></path>
                                        <path d="M3.25 9.78125H2.5C2.24112 9.78125 2.03125 9.99112 2.03125 10.25C2.03125 10.5089 2.24112 10.7188 2.5 10.7188H3.25C3.50888 10.7188 3.71875 10.5089 3.71875 10.25C3.71875 9.99112 3.50888 9.78125 3.25 9.78125Z" fill="currentColor"></path>
                                        <path d="M6 9.78125H5.25C4.99112 9.78125 4.78125 9.99112 4.78125 10.25C4.78125 10.5089 4.99112 10.7188 5.25 10.7188H6C6.25888 10.7188 6.46875 10.5089 6.46875 10.25C6.46875 9.99112 6.25888 9.78125 6 9.78125Z" fill="currentColor"></path>
                                    </svg>
                                    <h6 class="mb-0 ml-3 mr-2 font-bold tracking-tight text-gray-900">Termina el: </h6>
                                    <span>{{$curso->fecha_termino}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="text-secondary items-center flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.5465 5.13024L15.2322 4.02945L14.9329 2.34131C14.8335 1.78023 14.348 1.37335 13.7783 1.37335C13.778 1.37335 13.7775 1.37335 13.7772 1.37335L12.0628 1.37488L10.7485 0.274205C10.3114 -0.0919028 9.67738 -0.0913556 9.24091 0.275574L7.92861 1.37875L6.2142 1.38035C5.64405 1.3809 5.15872 1.78887 5.06026 2.35042L4.76408 4.03907L3.45178 5.14228C3.01535 5.50917 2.90582 6.13362 3.19137 6.62712L4.04992 8.1111L3.75378 9.79967C3.65524 10.3613 3.97276 10.91 4.50875 11.1046L5.9543 11.6292L5.95989 18.8268C5.95989 19.2647 6.20095 19.6629 6.58899 19.8659C6.76059 19.9556 6.94712 20 7.13295 20C7.36737 20 7.60062 19.9294 7.8013 19.7901L9.9861 18.2734L12.1709 19.7901C12.5306 20.0398 12.9951 20.0689 13.3832 19.8659C13.7712 19.6629 14.0123 19.2647 14.0123 18.8268V11.6377L15.5005 11.0945C16.0361 10.899 16.3526 10.3496 16.2531 9.78825L15.9538 8.10015L16.8096 6.61461C17.0943 6.12056 16.9836 5.49631 16.5465 5.13024ZM10.3205 17.078C10.1194 16.9385 9.85281 16.9385 9.65178 17.078L7.13264 18.8265C7.13264 18.8264 7.13264 18.8263 7.13264 18.8263L7.12842 13.3771C7.35154 13.6218 7.66652 13.7592 7.99315 13.7592C8.12738 13.7592 8.26357 13.7361 8.39608 13.6877L10.0065 13.0999L11.6181 13.6848C12.0517 13.842 12.5242 13.7298 12.8396 13.4196L12.8395 18.8266L10.3205 17.078ZM14.9377 7.51475C14.8003 7.75327 14.7511 8.03382 14.7992 8.30482L15.0984 9.99292L13.4878 10.5808C13.286 10.6545 13.1095 10.783 12.9761 10.949C12.9697 10.9566 12.9639 10.9647 12.9579 10.9727C12.9277 11.0123 12.899 11.0533 12.8739 11.0969L12.0185 12.5825C12.0185 12.5825 12.0183 12.5825 12.0181 12.5824L10.4065 11.9976C10.1478 11.9037 9.86297 11.9039 9.6044 11.9983L7.99393 12.5861L7.13538 11.1022C7.08925 11.0224 7.03339 10.9496 6.97073 10.8835C6.96507 10.8774 6.95975 10.871 6.95381 10.8652C6.83236 10.7425 6.68464 10.6468 6.52039 10.5871L4.90882 10.0022L5.205 8.31358C5.2525 8.04245 5.20277 7.76199 5.06495 7.52378L4.20639 6.03984L5.51869 4.93663C5.72942 4.75952 5.87163 4.51263 5.91912 4.24159L6.2153 2.55298L7.92963 2.55138C8.20489 2.55114 8.47254 2.45346 8.68319 2.27635L9.99549 1.17318L11.3098 2.27389C11.5205 2.45041 11.7879 2.54759 12.0629 2.54759H12.0638L13.7783 2.54602L14.0775 4.23416C14.1255 4.50517 14.2682 4.75166 14.4792 4.92842L15.7935 6.02921L14.9377 7.51475Z" fill="currentColor"></path>
                                        <path d="M9.99928 3.64673C8.13493 3.64673 6.61816 5.1635 6.61816 7.02785C6.61816 8.89221 8.13493 10.409 9.99928 10.409C11.8636 10.409 13.3804 8.89221 13.3804 7.02785C13.3804 5.1635 11.8636 3.64673 9.99928 3.64673ZM9.99928 9.23631C8.78154 9.23631 7.79083 8.2456 7.79083 7.02785C7.79083 5.81011 8.78154 4.8194 9.99928 4.8194C11.217 4.8194 12.2078 5.81011 12.2078 7.02785C12.2078 8.2456 11.217 9.23631 9.99928 9.23631Z" fill="currentColor"></path>
                                    </svg>
                                    <h6 class="mb-0 ml-4 mr-2 font-bold tracking-tight text-gray-900">Certificación: </h6>
                                    <span> Sí</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><br>
                <!-- CARD DE USUARIOS INSCRITOS -->
                <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <div class="flex justify-between px-4 items-center overflow-auto gap-3 mb-5 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        Usuarios Inscritos al Curso
                        <!-- OPCIONES -->
                        <div class="flex justify-end">
                            <button id="dropdownButton1" data-dropdown-toggle="dropdown1" class="flex items-center text-input font-semi-bold dark:text-gray-400 hover:bg-gray-300 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg p-1.5" type="button">
                                <!-- <span>Opciones</span> -->
                                <span class="justify-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                            <circle cx="8" cy="2.5" r=".75" />
                                            <circle cx="8" cy="8" r=".75" />
                                            <circle cx="8" cy="13.5" r=".75" />
                                        </g>
                                    </svg>
                                </span>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdown1" class=" hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="dropdownButton1">
                                    <li>
                                        <!-- Modal toggle -->
                                        <button data-modal-target="agregar_usuario_curso_interno" data-modal-toggle="agregar_usuario_curso_interno" class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md" type="button"> Agregar Usuario al Curso
                                        </button>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- FIN -->
                    </div>
                    <div class="pt-5 pb-4 px-5 px-lg-3 px-xl-5">
                        <ul class="list-group list-group-flush">
                            <table class="w-full text-center text-gray-500 dark:text-gray-400">
                                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            C.SGP
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($curso->usuarioCurso as $userCurso)
                                    <tr class="bg-white border-b dark:bg-gray-800 text-sm dark:border-gray-800 text-center">
                                        <td class="py-4 font-bold">
                                            {{$userCurso->id_sgp}}
                                        </td>
                                        <td class="py-4 font-bold">
                                            {{$userCurso->nombre}} {{$userCurso->segundo_nombre}} {{$userCurso->apellido_paterno}} {{$userCurso->apellido_materno}}
                                        </td>
                                        <td class="py-4 font-bold">
                                            <form action="{{route('destroyuser',[$userCurso])}}" method="POST" class="formulario-eliminar-User">
                                                @method("DELETE")
                                                @csrf
                                                <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- MODAL DE AÑADIR USUARIO -->
    <x-modal-prueba title="Agregar Usuario al Curso" textButton="Agregar Usuarios" id="agregar_usuario_curso_interno" vistaContenidoModal="cursosinternos.cursos.agregarUsuarioCurso" :curso="$curso" :usuarios="$usuarios" :tipo="$tipo" />

</x-app>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('actualizado') == 'Actualizado Correctamente')
<script>
    Swal.fire(
        'Actualizado!',
        'Actualizado Correctamente',
        'success'
    )
</script>
@endif
@if (session('agregado') == 'Agregado Correctamente')
<script>
    Swal.fire(
        'Creado Correctamente!!!!!',
        'Felicidades ahora Termina de configurar tu curso!!!!',
        'success'
    )
</script>
@endif
@if (session('agregado') == 'Usuario agregado a curso')
<script>
    Swal.fire(
        'Usuarios Agregados Correctamente!!!!!',
        'Felicidades!!!!',
        'success'
    )
</script>
@endif
@if (session('agregado') == 'Leccion Agregado Correctamente')
<script>
    Swal.fire(
        'Leccion Creada Correctamente!!!!!',
        'Felicidades ahora Puede Agregar Contenido a ella!!!!',
        'success'
    )
</script>
@endif
@if (session('agregado') == 'Examen Agregado Correctamente')
<script>
    Swal.fire(
        'Examen Creado Correctamente!!!!!',
        'Felicidades!!!!',
        'success'
    )
</script>
@endif
@if (session('actualizado') == 'Actualizado Correctamente')
<script>
    Swal.fire(
        'Curso Actualizado Correctamente!!!!!',
        'Felicidades!!!!',
        'success'
    )
</script>
@endif
@if (session('agregado') == 'Leccion Actualizada Correctamente')
<script>
    Swal.fire(
        'Leccion Actualizada Correctamente!!!!!',
        'Felicidades!!!!',
        'success'
    )
</script>
@endif

@if (session('eliminado') == 'Eliminado Correctamente')
<script>
    Swal.fire(
        'Eliminado!',
        'Eliminado Correctamente',
        'success'
    )
</script>
@endif
<script>
    const forms = document.querySelectorAll(".formulario-eliminar")

    forms.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas Seguro de Eliminar esta Lección',
                text: "Si lo eliminas ya no lo podras recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado Correctamente',
                        'error'
                    )
                }
            })
        });
    })
</script>
<script>
    const forms1 = document.querySelectorAll(".formulario-eliminarCont")

    forms1.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas Seguro de Eliminar este Contenido',
                text: "Asegurate de eliminar el Examen antes de Continuar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado Correctamente',
                        'error'
                    )
                }
            })
        });
    })
</script>
<script>
    const forms4 = document.querySelectorAll(".formulario-eliminar-User")

    forms4.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas Seguro de Eliminar a este Usuario del Curso',
                text: "Si lo elimina ya no podra Tomar el curso",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado Correctamente',
                        'error'
                    )
                }
            })
        });
    })
</script>
<script>
    const forms2 = document.querySelectorAll(".formulario-eliminarEx")

    forms2.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas Seguro de Eliminar este Contenido',
                text: "Asegurate de eliminar el Examen antes de Continuar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado Correctamente',
                        'error'
                    )
                }
            })
        });
    })
</script>