<x-app title="Cursos">
    <div class="h-[calc(100%-70px)] flex gap-10 items-start justify-center">
        <div class="contain-modalidad-tipo-curso absolute  left-5 overflow-y-scroll max-h-[calc(100%-70px)] py-2 px-2 bg-gray-100 rounded-sm">
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">modalidades</p>
                    <x-modal icon="bx bxs-plus-circle" title="Crear modalidad" textButton="" id="crear_modalidad"
                        vistaContenidoModal="cursosplanta.modalidad.create" class="text-blue-800 hover:text-blue-700 " />
                </div>
                <ul class="">
                    @foreach ($modalidad as $modalidad)
                    <li class="flex items-center">

                        <x-modal edit title="Editar modalidad" id="editar_modalidad{{ $modalidad->id_modalidad }}"
                            :modalidad="$modalidad" vistaContenidoModal="cursosplanta.modalidad.edit"
                            class="bg-white text-blue-600  hover:bg-blue-100 hover:rounded-md hover:text-blue-400" />

                        <form method="post" action="{{ route('modalidad.destroy', $modalidad->id_modalidad) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 hover:font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 32 32">
                                    <path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z" />
                                    <path fill="currentColor"
                                        d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z" />
                                </svg>
                            </button>
                        </form>
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $modalidad->modalidad }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">Tipos de curso</p>
                    <x-modal icon="bx bxs-plus-circle" title="Crear tipo curso" textButton="" id="crear_tipo_curso"
                        vistaContenidoModal="cursosplanta.tipos.create" class="text-blue-800 hover:text-blue-700" />
                </div>
                    <ul>
                        @foreach ($tipos as $tipo)
                            <li class="flex items-center">

                                <x-modal edit title="Editar tipo curso" id="editar_tipo{{ $tipo->id_tipo_curso }}"
                                    :tipo="$tipo" vistaContenidoModal="cursosplanta.tipos.edit"
                                    class="bg-white text-blue-600  hover:bg-blue-100 hover:rounded-md hover:text-blue-400" />

                                <form method="post" action="{{ route('tipos.destroy', $tipo->id_tipo_curso) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 hover:font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 32 32">
                                            <path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z" />
                                            <path fill="currentColor"
                                                d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z" />
                                        </svg>
                                    </button>
                                </form>
                                <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $tipo->nombre }}</span>
                            </li>
                        @endforeach
                    </ul>
            </div>
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">categorias</p>
                    <x-modal icon="bx bxs-plus-circle" title="Crear categoria" textButton="" id="crear-categoria"
                        vistaContenidoModal="cursosinternos.categorias.create"
                        class="text-blue-800 hover:text-blue-700" />
                </div>
                <ul >
                    @foreach ($categorias as $categoria)
                    <li class="flex items-center">

                        <x-modal edit title="Editar modalidad" id="editar_categoria{{ $categoria->id_categoria }}"
                            :categoria="$categoria" vistaContenidoModal="cursosinternos.categorias.edit"
                            class="bg-white text-blue-600  hover:bg-blue-100 hover:rounded-md hover:text-blue-400" />

                        <form method="post" action="{{ route('categorias.destroy', $categoria->id_categoria) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 hover:font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 32 32">
                                    <path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z" />
                                    <path fill="currentColor"
                                        d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z" />
                                </svg>
                            </button>
                        </form>
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $categoria->nombre }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="ml-[15%] flex justify-center gap-10  mt-5 h-3/4 ">
            <a href="{{ route('cursos.index') }}"
                class="flex flex-col justify-center w-[400px] p-4  mt-4 bg-primary rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 hover:bg-primary-light">
                <h5 class="mb-4 text-title font-medium text-white dark:text-gray-400">Cursos planta</h5>
                <div class="text-gray-200 ">
                    <h6 class="text-3xl font-semibold">description</h6>
                    <p class="text-sm italic font-normal text-gray-300 dark:text-gray-400">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque itaque molestiae voluptate
                        consectetur amet veritatis quia facilis repellat, repudiandae omnis quod numquam ipsum modi
                        sequi necessitatibus facere, quidem voluptatibus ea?
                    </p>
                </div>
            </a>

            <a href="{{ route('curs.index') }}"
                class="flex flex-col justify-center w-[400px] p-4  mt-4 bg-primary rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 hover:bg-primary-light">
                <h5 class="mb-4 text-title font-medium text-white dark:text-gray-400">Cursos internos</h5>
                <div class="text-gray-200 ">
                    <h6 class="text-3xl font-semibold">description</h6>
                    <p class="text-sm italic font-normal text-gray-300 dark:text-gray-400">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque itaque molestiae voluptate
                        consectetur amet veritatis quia facilis repellat, repudiandae omnis quod numquam ipsum modi
                        sequi necessitatibus facere, quidem voluptatibus ea?
                    </p>
                </div>
            </a>
        </div>
    </div>

</x-app>
