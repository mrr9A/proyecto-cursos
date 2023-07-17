<x-app title="Cursos planta">
    <div class="-mt-3.5">
        <div class="">
            <div class="flex flex-col gap-2 items-start justify-center">
                <div class="flex items-center">
                    <h2 class="text-subtitle font-semi-bold">Lista de cursos</h2>
                    <a href="{{ route('cursos.create') }}"
                        class=" rounded-md  focus:outline-none text-base  text-blue-600 hover:rounded-t-md underline font-bold hover:text-blue-800">
                        Crear cursos
                    </a>
                </div>
            </div>
            <div class="flex items-center justify-between  mb-3 -mt-3">
                <a href="{{ route('planes.index') }}" target="_blanck"
                    class=" block text-base border-b-2 border-2 rounded-md  focus:outline-none font-medium px-5 py-1.5 text-center bg-btn-primary text-white hover:bg-btn-primary-light hover:text-gray-200">
                    Asignar cursos
                </a>
                <div class="flex flex-col justify-start">
                    <x-search.search-input placeholder="nombre, codigo, tipo ..." route="cursos.index" />
                    <span class="text-gray-600 text-sm">puede buscar cursos por tipo, nombre, codigo, modalidad</span>
                </div>
            </div>
            <div>
                {{-- PAGINACION --}}
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        {{-- $usuarios->currentPage(): Devuelve el número de página actual.
                            $usuarios->perPage(): Devuelve la cantidad de resultados mostrados por página.
                            $usuarios->total(): Devuelve el total de resultados obtenidos. --}}
                        <p class="text-sm text-gray-700">
                            Mostrando
                            <span class="font-medium">{{ $cursos->currentPage() }}</span>
                            a
                            <span class="font-medium">{{ $cursos->perPage() }}</span>
                            de
                            <span class="font-medium">{{ $cursos->total() }}</span>
                            resultados
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

                            @if ($cursos->onFirstPage())
                                <a href="#" aria-label="@lang('pagination.previous')"
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ $cursos->previousPageUrl() }}" aria-label="@lang('pagination.previous')"
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif

                            {{-- paginas --}}
                            @if ($cursos->currentPage() != 1)
                                <a href="{{ $cursos->url(1) }}"
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">1</a>
                            @endif


                            @foreach ($cursos->getUrlRange(max(1, $cursos->currentPage() - 2), min($cursos->lastPage(), $cursos->currentPage() + 2)) as $page => $url)
                                <a href="{{ $url }}"
                                    class="{{ $cursos->currentPage() === $page ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }}">{{ $page }}</a>
                            @endforeach

                            @if ($cursos->currentPage() != $cursos->lastPage())
                                <a href="{{ $cursos->url($cursos->lastPage()) }}"
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $cursos->lastPage() }}</a>
                            @endif

                            <!-- Enlace a la siguiente página -->
                            @if ($cursos->hasMorePages())
                                <a href="{{ $cursos->nextPageUrl() }}" aria-label="@lang('pagination.next')" 
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <div aria-hidden="true" aria-label="@lang('pagination.next')" aria-disabled="true"
                                    aria-label="@lang('pagination.next')"
                                    class="disabled relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif

                        </nav>
                    </div>
                </div>
                {{-- FIN DE LA PAGINACION --}}
                <table class="min-w-full leading-normal my-2">
                    <thead class="border-b  dark:border-neutral-500 uppercase">
                        <tr
                            class="px-5 py-3 border-b-2 border-gray-200 bg-th-table text-th-table-text text-left text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-2 w-1/12">Codigo</th>
                            <th class="px-6 py-2 ">Nombre</th>
                            <th class="px-6 py-2 ">tipo</th>
                            <th class="px-6 py-2 ">modalidad</th>
                            <th class="px-6 py-2 ">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $curso)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="whitespace-nowrap px-6 py-2 w-1/12 ">
                                    {{ $curso->codigo === null ? 'sin codigo' : $curso->codigo }}</td>
                                <td class="py-3 px-6 text-left">{{ $curso->nombre }}</td>
                                <td class="py-3 px-6 text-left">{{ $curso->tipo }}</td>
                                <td class="py-3 px-6 text-left">{{ $curso->modalidad }}</td>
                                <td class="py-3 px-6 text-left relative w-1/12">
                                    <div class="flex justify-center gap-2">
                                        <button id="{{ $curso->id_curso }}"
                                            class="cursos text-blue-600 text-sm hover:text-blue-800 hover:font-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="m14.06 9l.94.94L5.92 19H5v-.92L14.06 9m3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75Z" />
                                            </svg>
                                        </button>
                                        <form method="post" action="{{ route('cursos.destroy', $curso->id_curso) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 hover:font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 32 32">
                                                    <path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z" />
                                                    <path fill="currentColor"
                                                        d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div id="content_modal"
        class="hidden fixed bottom-0 top-0 right-0 left-0 bg-[#00000080] z-50 flex items-center justify-center">

        <x-loader.loader />
    </div>
    <script src="{{ asset('js/utils/validarInputs.js') }}"></script>
    <script>
        const btnsEditar = $$(".cursos");
        const contentModal = $("#content_modal");

        contentModal.addEventListener('click', (event) => {
            if (event.target === contentModal) {
                contentModal.classList.add('hidden')
            }
        })

        btnsEditar.forEach((elemento) => {
            elemento.addEventListener('click', async (e) => {
                const id = elemento.id;
                contentModal.classList.toggle('hidden')
                const data = await getData(id)

                optsModalidad = ''
                optsTipo = ''
                data.modalidades.forEach(e => {
                    optsModalidad +=
                        `<option value='${e.id_modalidad}' ${e.id_modalidad == data.curso.modalidad_id ? 'selected' : ''} >${e.modalidad}</option>`
                })
                data.tipos.forEach(e => {
                    optsTipo +=
                        `<option value='${e.id_tipo_curso}' ${e.id_tipo_curso == data.curso.tipo_curso_id ? 'selected' : ''} >${e.nombre}</option>`
                })

                contenido = `
                <div class="m-auto my-auto md:w-[70%] lg:w-[40%] h-[70%] bg-white rounded-md  overflow-auto flex justify-center p-2">
                    <form id="update_curso" method="POST"  class=" bg-white flex flex-col flex-1 h-full w-full justify-stretch">
                        @method('POST')
                        @csrf
                        <div id="container_cursos" class=" grid grid-cols-2 gap-4  w-full border-[1px] gap-y-5">
                                    <h2 class="col-span-2 py-1 px-2 bg-blue-200">Actualizar curso</h2>
                                    <x-input-text text="Nombre" nombre="nombre" placeholder="nombre" required classLabel="text-base" mensaje="nombre" value='${data.curso.nombre}' />
                                    <x-input-text text="codigo" nombre="codigo" placeholder="codigo " classLabel="text-base" mensaje="codigo" value='${data.curso.codigo}'/>
                                
                                    {{-- SELECTS --}}

                                    <div class="text-text-input relative">
                                        <label for="modalidad_id" class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">
                                            Modalidades
                                        </label>
                                        <select name="modalidad_id" id=""
                                            class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                            <option value="" id="select_puesto" class="text-gray-400">Seleciona una modalidad</option>
                                            ${optsModalidad}
                                        </select>
                                    </div>

                                    <div class="text-text-input relative">
                                        <label for="tipo_id" class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">
                                            Tipos
                                        </label>
                                        <select name="tipo_id" id=""
                                        class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                            <option value="" id="select_puesto" class="text-gray-400">Seleciona una tipo</option>
                                            ${optsTipo}
                                        </select>
                                    </div>
                        </div>
                        <div class="mt-4">
                            <x-input-submit text="Actualizar" class="w-full" />
                        </div>
                    </form>
                </div>
                `

                contentModal.innerHTML = contenido
                validarInputs()

                const updateForm = $('#update_curso')
                updateForm.addEventListener('submit', (e) => {
                    e.preventDefault()
                    const formData = new FormData(
                        updateForm); // Crea un objeto FormData con los datos del formulario

                    // valores de los campos del formulario
                    const nombre = formData.get('nombre');
                    const codigo = formData.get('codigo');
                    const fecha_inicio = formData.get('fecha_inicio');
                    const fecha_termino = formData.get('fecha_termino');
                    const modalidad_id = formData.get('modalidad_id');
                    const tipo_id = formData.get('tipo_id');
                    const data = {
                        nombre: nombre,
                        codigo,
                        fecha_inicio,
                        fecha_termino,
                        modalidad_id,
                        tipo_id
                    };

                    fetch(`${API_URL}/curso/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(result => {
                            // Procesa la respuesta de la API
                            console.log(result);
                            location.reload()
                        })
                        .catch(error => {
                            // Maneja cualquier error de la solicitud
                            console.error('Error:', error);
                        });
                })
            });
        });

        async function getData(id) {
            console.log(API_URL)
            // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
            const respuestaRaw = await fetch(`${API_URL}/cursosplanta/curso/${id}/edit`);
            // Decodificar como JSON
            const respuesta = await respuestaRaw.json();
            // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
            // Obtener una referencia al elemento canvas del DOM
            return respuesta
        }
    </script>
</x-app>
