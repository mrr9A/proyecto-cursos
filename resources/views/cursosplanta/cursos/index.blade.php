<x-app title="Cursos">
    <div class="-mt-2 mb-2">
        <p>Opciones</p>
        <div class=" flex items-center gap-2">
            <a href="{{ route('cursos.create') }}"
                class="border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-2 py-1.5  hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md'">
                Crear cursos
            </a>
            <a href="{{ route('cursos.puestos') }}"
                class="border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-1.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
                Asignar cursos
            </a>
        </div>
    </div>
    <div>
        <div class="contain-modalidad-tipo-curso flex flex-wrap gap-6 justify-between">
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">modalidades</p>
                    <x-modal title="Crear modalidad" textButton="" id="crear_modalidad"
                        vistaContenidoModal="cursosplanta.modalidad.create"
                        class="text-blue-800 hover:text-blue-700 " />
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($modalidad as $modalidad)
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $modalidad->modalidad }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">Tipos de curso</p>
                    <x-modal title="Crear tipo curso" textButton="" id="crear_tipo_curso"
                        vistaContenidoModal="cursosplanta.tipos.create" class="text-blue-800 hover:text-blue-700" />
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tipos as $tipo)
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $tipo->nombre }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="text-subtitle font-semi-bold">Lista de cursos</h2>
            <div class="flex justify-between items-center mb-3 -mt-3">
                <span class="text-gray-700 text-sm">puede buscar cursos por tipo, nombre, codigo, modalidad</span>
                <x-search.search-input placeholder="nombre, codigo, tipo ..." route="cursos.index" />
            </div>
            <div class="bg-primary grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] p-2 gap-2 rounded-md ">

                @if (!is_null($cursos))
                    @foreach ($cursos as $curso)
                        <x-cards.card-cursos :curso="$curso" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>



    <div id="content_modal"
        class="hidden fixed bottom-0 top-0 right-0 left-0 bg-[#00000080] z-50 flex items-center justify-center">

        <x-loader.loader />
    </div>

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
                <div class="m-auto my-auto w-[50%] h-[80%] bg-white rounded-md py-4 px-3 overflow-auto">
                    <form id="update_curso" method="POST"  class=" bg-white">
                    @method('POST')
                    @csrf
                        <div id="container_cursos" class="w-full gap-3">
                            <div id="curso_1" class="grid grid-cols-2 gap-3 w-full border-[1px]">
                                <h2 class="col-span-2 py-1 px-2 bg-blue-200">Actualizar curso</h2>
                                <x-input-text text="Nombre" nombre="nombre" placeholder="nombre" required
                                    classLabel="text-base" mensaje="nombre" value='${data.curso.nombre}' />
                                <x-input-text text="codigo" nombre="codigo" placeholder="codigo "
                                    classLabel="text-base" mensaje="codigo" value='${data.curso.codigo}'/>
                                <x-input-text type="date" text="Fecha inicio" nombre="fecha_inicio"
                                    placeholder="fecha_inicio " classLabel="text-base" mensaje="fecha_inicio" value='${data.curso.fecha_inicio}'/>
                                <x-input-text type="date" text="Fecha Termino" nombre="fecha_termino" value='${data.curso.fecha_termino}'
                                    placeholder="fecha_termino" classLabel="text-base" mensaje="fecha_termino"/>
                                
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
                        </div>
                    </form>
                </div>
                `

                contentModal.innerHTML = contenido

                const updateForm = $('#update_curso')
                updateForm.addEventListener('submit', (e) => {
                    e.preventDefault()
                    const formData = new FormData(updateForm); // Crea un objeto FormData con los datos del formulario

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
