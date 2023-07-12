<x-app title="ASIGNAR CURSOS">
    <div class="flex gap-5 w-full">
        <form action="{{ route('planes.store') }}" method="POST"
            class="border-2 border-blue-200 rounded-md bg-blue-100 mt-2 p-2 w-1/2">
            @csrf
            <div class="flex  gap-3 mb-2 ">
                <div class="flex flex-col justify-start relative">
                    <label>Puesto</label>
                    <select name="puesto_id" id="puestos"
                        class="py-2 text-sm leading-tight uppercase rounded-md border-input border-2  ">
                        <option value="" class="text-gray-400 lowercase">Selecciona un puesto</option>
                        @foreach ($puestos as $puesto)
                            <option value="{{ $puesto->id_puesto }}"
                                {{ old('puesto_id') == $puesto->id_puesto ? 'selected' : '' }}>
                                {{ $puesto->puesto }}
                            </option>
                        @endforeach
                    </select>
                    @error('puesto_id')
                        <small
                            class="absolute -bottom-4 text-sm text-red-500 font-semibold italic">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col justify-start relative">
                    <label>Trabajos</label>
                    <select name="trabajo_id" id="trabajos"
                        class="py-2 text-sm leading-tight uppercase rounded-md border-input border-2 ">
                        <option value="">Selecciona un trabajo</option>
                    </select>
                    @error('trabajo_id')
                        <small
                            class="absolute -bottom-4 text-sm text-red-500 font-semibold italic">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <x-input-submit text="Agregar" />



            {{-- Lista de los cursos --}}
            <div class="mt-2">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-gray-800 italic">Secciona los cursos a asignar al trabajo</h2>
                </div>
                <div id="cursos"
                    class="bg-primary grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] p-2 gap-y-0 gap-x-2  rounded-md">
                    @if ($cursos == [])
                        Sin cursos, por favor crea cursos para continuar
                        <a href="{{ route('cursos.index') }}">crear cursos</a>
                    @else
                        <x-checkbox.checkbox :cursos="$cursos" />
                    @endif
                </div>
            </div>

        </form>

        <div class=" w-1/2">

            <div class="flex mb-5">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="buscador" name="buscador"
                        class=" border-gray-300  text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ $placeholder ?? 'Identificador, puesto, nombre ...' }}">
                </div>

                <button type="button" id="submit-buscar"
                    class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>

            <form action="{{ route('planes.destroy', ':id') }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-subtitle">Cursos asignados</h2>
                    <x-input-submit text="Eliminar" />
                </div>
                <p class="text-sm">para eliminar los cursos del trabajo seleccione los cursos y click en eliminar</p>
                <div id="cursos-por-puesto"
                    class="bg-primary grid grid-cols-[repeat(auto-fit,minmax(180px,1fr))] p-2 gap-y-0 gap-x-2  rounded-md">
                    <p class="text-white text-subtitle font-semi-bold">Aun no ha seleccionado un trabajo<span class="block text-base">para ver los cursos asignados seleccione un trabajo</span></p>
                </div>
            </form>
        </div>

        <div id="loader" />
    </div>
    <script>
        const puestoSelect = document.getElementById('puestos')
        const trabajosSelector = document.getElementById("trabajos")
        const deleteForm = document.getElementById("delete-form");
        const loader = $('#loader')
        const cursosPuesto = document.getElementById("cursos-por-puesto");
        const cursos = document.getElementById("cursos");

        const buscador = $('#buscador')
        const btnBuscar = $('#submit-buscar')
        let trabajo_id = 0 // variable para saber si ya se seleccion un trabajo

        document.addEventListener('DOMContentLoaded', function() {
            puestoSelect.options[0].setAttribute("disabled", true)
            // Obtener el valor seleccionado del select
            let selectedValue = puestoSelect.value;
            if (selectedValue !== '') {
                getJobsByPosition(selectedValue);
            }
        });


        puestoSelect.addEventListener('change', (event) => {
            puestoSelect.options[0].setAttribute("disabled", true)
            let puesto_id = event.target.value
            getJobsByPosition(puesto_id);
        })

        trabajosSelector.addEventListener('change', (event) => {
            trabajosSelector.options[0].setAttribute("disabled", true)
            trabajo_id = event.target.value
            let actionUrl = deleteForm.getAttribute("action").replace(":id", trabajo_id);
            deleteForm.setAttribute("action", actionUrl);
            getCursos(trabajo_id)
        })


        buscador.addEventListener("keydown", function(event) {
            if (event.keyCode === 13) {
                // Se presionó la tecla "Enter"
                console.log('hola')
                event.preventDefault()
                if (trabajo_id != 0) {
                    console.log('buscar curso del trabajo')
                    getCursos(trabajo_id, buscador.value);
                } else {
                    console.log('buscar normal')
                    searchCurses(buscador.value)
                }
            }
        });
        btnBuscar.addEventListener("click", function(event) {
            event.preventDefault()
            if (trabajo_id != 0) {
                console.log('buscar curso del trabajo')
                getCursos(trabajo_id, buscador.value);
            } else {
                console.log('buscar normal')
                searchCurses(buscador.value)
            }
        });


        function getJobsByPosition(id) {
            loader.innerHTML = `<x-loader.loader />`
            fetch(`${API_URL}/cursosplanta/puesto/${id}/trabajos`)
                .then(res => res.json())
                .then(data => {
                    let trabajos = '<option value="" class="text-gray-400">Selecciona un trabajo</option>'
                    if (data.length < 1) return;

                    data.forEach(trabajo => {
                        trabajos +=
                            `<option value="${trabajo.id_trabajo}">
                              ${trabajo.nombre}
                          </option>`
                    });
                    trabajosSelector.innerHTML = trabajos
                    loader.innerHTML = ""
                })
                .catch(err => console.log(err))
        }

        function getCursos(id, text = "") {
            loader.innerHTML = `<x-loader.loader />`
            return fetch(`${API_URL}/cursosplanta/cursosxplanes/${id}?buscador=${text}`)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    let cursosPorPlan = ""
                    let cursosDisponibles = ""
                    data.cursosPorTrabajo.forEach(curso => {
                        cursosPorPlan += `
                            <label
                                class="cursor-pointer block  h-auto rounded-sm  border-fuchsia-400 mb-4 overflow-hidden bg-gray-50">
                                <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />
                                <div class="relative peer-checked:bg-orange-200 h-full p-2">
                                    <h2 class="uppercase text-sm">${curso.nombre}</h2>
                                    <h3 class="text-gray-500 text-[12px]">${curso.codigo == null ? '' : curso.codigo}</h3>
                                    <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                    <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                </div>
                            </label>
                    `
                    });
                    data.cursosDisponibles.forEach(curso => {
                        cursosDisponibles += `
                            <label
                                class="cursor-pointer block  h-auto rounded-sm  border-fuchsia-400 mb-4 overflow-hidden bg-gray-50">
                                <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />
                                <div class="relative peer-checked:bg-orange-200 h-full p-2">
                                    <h2 class="uppercase text-sm">${curso.nombre}</h2>
                                    <h3 class="text-gray-500 text-[12px]">${curso.codigo == null ? '' : curso.codigo}</h3>
                                    <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                    <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                </div>
                            </label>`
                    });

                    cursosPuesto.innerHTML = cursosPorPlan;
                    cursos.innerHTML = cursosDisponibles;
                    loader.innerHTML = ""
                })
                .catch(err => console.log(err));
        }

        function searchCurses(text) {
            loader.innerHTML = `<x-loader.loader />`
            fetch(`${API_URL}/cursosplanta/cursos?buscador=${text}`)
                .then(res => {
                    // manejando errores por si recibimos respuestas 4xx o 5xx que no entran en el catch
                    if (!res.ok) {
                        throw new Error("Error HTTP: " + res.status);
                    }
                    return res.json()
                })
                .then(data => {
                    console.log(data)
                    if (data.length < 1){
                        console.log('dasdasdasdasds')
                        cursos.innerHTML = '<p class="text-white font-title font-semi-bold">no se encontraron coincidencias</p>'
                        loader.innerHTML = ""
                        return;
                    }

                    console.log('error')

                    let cursosCheck = ''
                    data.forEach(curso => {
                        cursosCheck += `<label class="cursor-pointer block  h-auto rounded-lg  border-fuchsia-400 mb-4 overflow-hidden bg-gray-50">
                                    <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />

                                    <div class="relative peer-checked:bg-orange-200 h-full p-2">
                                        <h2 class="uppercase text-sm">${curso.nombre}</h2>
                                        <h3 class="text-gray-500 text-[12px]">${curso.codigo == null ? '' : curso.codigo}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                    </div>
                                 </label>`
                    })
                    cursos.innerHTML = cursosCheck
                    loader.innerHTML = ""
                })
                .catch(err => console.error(err))
        }
    </script>

</x-app>
