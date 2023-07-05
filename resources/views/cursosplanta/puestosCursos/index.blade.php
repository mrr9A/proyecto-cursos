<x-app title="Asignar Cursos">
    <form action="{{ route('planes.store') }}" method="POST" class="m-4 p-2" id="form-asignar-cursos">
        @csrf

        <div id="alert-additional-content-1"
            class="flex justify-between px-2 pr-8 mb-4 text-blue-800 rounded-lg bg-blue-50 py-1  dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
            role="alert">
            <div class="flex items-center gap-2">
                <i class='bx bxs-info-circle text-section-subtitle'></i>
                <div class=" text-sm">
                    Si el puesto tiene trabajos, puede seleccionar uno o mas trabajos y los cursos a
                    asignar en caso de que compartan cursos
                </div>
            </div>
            <span data-dismiss-target="#alert-additional-content-1" aria-label="Close">cerrar</span>
        </div>
        <div class="flex  gap-3 mb-2">
            <div class="flex flex-col justify-start">
                <label>Puesto</label>
                <select name="puesto_id" id="puestos"
                    class="py-2 text-sm leading-tight uppercase rounded-md border-input border-2  ">
                    <option value="" class="text-gray-400 lowercase">Selecciona un puesto</option>
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id_puesto }}">
                            {{ $puesto->puesto }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col justify-start hidden " id="trabajos">
                <label>Trabajos</label>
                <select name="trabajo_id" id="select-trabajos"
                    class="py-2 text-sm leading-tight uppercase rounded-md border-input border-2 " >
                </select>
            </div>
        </div>


        <x-input-submit text="Continuar" />


        <div class="mt-4">
            <div class="flex items-center w-[400px] relative my-2 self-end">
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

            <div id="content_cursos"
                class="bg-primary grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] p-2 gap-y-0 gap-x-2  rounded-md  ">
                @if (!is_null($cursos))
                    <x-checkbox.checkbox :cursos="$cursos" />
                @endif
            </div>
        </div>

        <div id="loader"></div>
    </form>


    <script>
        const loader = $('#loader')
        const selectPuesto = $('#puestos')
        const trabajos = $("#trabajos")
        const selectTrabajos = $('#select-trabajos')

        const buscador = $('#buscador')
        const btnBuscar = $('#submit-buscar')
        const contentCursos = $('#content_cursos')

        let trabajo_id = 0;
        let puesto_id = 0;
        selectPuesto.addEventListener('change', (event) => {
            puesto_id = event.target.value
            $$("option")[0].setAttribute("disabled", true);
            getJobsByPosition(puesto_id);
        })

        selectTrabajos.addEventListener('change', (event) => {
            trabajo_id = event.target.value
            $$("option")[0].setAttribute("disabled", true);
            getCursesByJob(trabajo_id,buscador.value);
        })

        buscador.addEventListener("keydown", function(event) {
            if (event.keyCode === 13) {
                // Se presionó la tecla "Enter"
                event.preventDefault()
                if(trabajo_id != 0){
                    console.log('buscar curso del trabajo')
                    getCursesByJob(trabajo_id,buscador.value);
                }else{
                    console.log('buscar normal')
                    searchCurses(buscador.value)
                }
            }
        });
        btnBuscar.addEventListener("click", function(event) {
            event.preventDefault()
            searchCurses(buscador.value)
        });



        function getJobsByPosition(id) {
            loader.innerHTML = `<x-loader.loader />`
            fetch(`http://localhost:8000/api/cursosplanta/puesto/${id}/trabajos`)
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    let opciones = '<option value="" class="text-gray-400 lowercase">Selecciona un trabajo</option>'
                    data.forEach(trabajo => {
                        opciones += `<option value="${trabajo.id_trabajo}">${trabajo.nombre}</option>`
                    });
                    selectTrabajos.innerHTML = opciones
                    loader.innerHTML = ""
                    trabajos.classList.remove('hidden')
                })
                .catch(err => {
                    selectTrabajos.innerHTML = "<span>Selecione un trabajo</span>"
                    console.log(err)
                })
        }

        function searchCurses(text) {
            fetch(`http://localhost:8000/api/cursosplanta/cursos?buscador=${text}`)
                .then(res => {
                    // manejando errores por si recibimos respuestas 4xx o 5xx que no entran en el catch
                    if (!res.ok) {
                        throw new Error("Error HTTP: " + res.status);
                    }
                    return res.json()
                })
                .then(data => {
                    let cursos = ''
                    data.forEach(curso => {
                        cursos += `<label class="cursor-pointer block  h-auto rounded-lg  border-fuchsia-400 mb-4 overflow-hidden bg-gray-50">
                                    <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />

                                    <div class="relative peer-checked:bg-orange-200 h-full p-2">
                                        <h2 class="uppercase text-sm">${curso.nombre}</h2>
                                        <h3 class="text-gray-500 text-[12px]">${curso.codigo}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                    </div>
                                 </label>`
                    })
                    if (data.length < 1)
                        cursos = '<p class="text-white font-title font-semi-bold">no se encontraron coincidencias</p>'
                    contentCursos.innerHTML = cursos
                })
                .catch(err => console.error(err))
        }
        function getCursesByJob(id,text) {
            fetch(`http://localhost:8000/api/cursosplanta/trabajo/${id}/cursos?buscador=${text}`)
                .then(res => {
                    // manejando errores por si recibimos respuestas 4xx o 5xx que no entran en el catch
                    if (!res.ok) {
                        throw new Error("Error HTTP: " + res.status);
                    }
                    return res.json()
                })
                .then(data => {
                    let cursos = ''
                    data.forEach(curso => {
                        cursos += `<label class="cursor-pointer block  h-auto rounded-lg  border-fuchsia-400 mb-4 overflow-hidden bg-gray-50">
                                    <input class="hidden peer" type="checkbox" name="cursos[]" ${curso.asignado == 1 ? 'checked' : ''} value="${curso.id_curso}" />

                                    <div class="relative peer-checked:bg-orange-200 h-full p-2">
                                        <h2 class="uppercase text-sm">${curso.nombre}</h2>
                                        <h3 class="text-gray-500 text-[12px]">${curso.codigo}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                    </div>
                                 </label>`
                    })
                    if (data.length < 1)
                        cursos = '<p class="text-white font-title font-semi-bold">no se encontraron coincidencias</p>'
                    contentCursos.innerHTML = cursos
                })
                .catch(err => console.error(err))
        }
        
    </script>

</x-app>
