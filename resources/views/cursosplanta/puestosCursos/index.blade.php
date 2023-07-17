<x-app title="Asignar Cursos">

    <div class="relative h-[calc(100%-80px)] w-full overflow-auto">

        <section class="mb-3">
            <p class="text-subtitle font-semi-bold">Trabajos</p>
            <small>click en los trabajos para ver sus cursos asignados</small>
            <div class="p-1 rounded-sm bg-gray-700 ">
                {{-- BUSCADOR TRABAJOS --}}
                <div class="flex mb-2 justify-end">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="buscador-trabajos" name="buscador"
                            class=" border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 px-2.5 "
                            placeholder="trabajos...">
                    </div>
                </div>
                {{-- BUSCADOR TRABAJOS --}}

                <div class="flex flex-wrap gap-1 text-white pb-3" id="content-trabajos">

                    @foreach ($trabajos as $trabajo)
                        <button id="{{ $trabajo->id_trabajo }}"
                            class="trabajos__btn bg-gray-500 py-1.5 px-2 hover:bg-gray-300 hover:text-gray-600">
                            {{ $trabajo->nombre }}
                        </button>
                    @endforeach
                </div>
            </div>
        </section>


        <form action="{{ route('planes.store') }}" method="POST" id="form-asignar-cursos">
            @csrf
            <div class="flex">



                <div class="flex-auto w-full min-w-0 lg:static lg:max-h-full lg:overflow-visible">
                    <div class="flex w-full justify-between ">

                        <div class="flex-auto  min-w-0 pt-6 lg:px-8 lg:pt-8 pb:12 xl:pb-24 lg:pb-16 bg-blue-600">
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-subtitle font-semi-bold text-white">Asignar cursos</p>
                                <x-input-submit text="Continuar" />
                            </div>
                            <div class="flex justify-between items-center">
                                <h2 class="text-white text-section-subtitle font-semi-bold">Lista de cursos</h2>
                                <div class="flex mb-2">
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 dark:text-gray-400"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="text" id="buscador" name="buscador"
                                            class=" border-gray-300  text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="nombre, modalidad, codigo...' }}">
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
                            </div>
                            <div id="content_cursos"
                                class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] p-2 gap-y-0 gap-x-2 overflow-y-auto  w-[calc(100%-100px)]">
                                @if (!is_null($cursos))
                                    <x-checkbox.checkbox :cursos="$cursos" />
                                @endif
                            </div>
                        </div>



                        <div class="flex-none hidden w-[300px] px-4  xl:text-sm xl:block ">
                            <div
                                class="flex overflow-y-auto sticky top-8 flex-col justify-between h-[calc(100vh-10rem)]">
                                <div class="container max-w-[350px] shadow-all px-2 h-full">
                                    <p class="font-semi-bold text-subtitle">Trabajos</p>
                                    <p class="text-sm font-semi-bold">Selecciona trabajos a los cuales deseas asignarle
                                        cursos
                                    </p>
                                    <div class="flex flex-col gap-1">
                                        @foreach ($trabajos as $trabajo)
                                            <div class="flex gap-3 items-center ">
                                                <input type="checkbox" id="trabajo_{{ $trabajo->id_trabajo }}"
                                                    value="{{ $trabajo->id_trabajo }}" name="trabajos[]"
                                                    class="cursor-pointer" />
                                                <label for="trabajo_{{ $trabajo->id_trabajo }}"
                                                    class="cursor-pointer">{{ $trabajo->nombre }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="loader"></div>
    <div id="" class="">
        <form action="{{ route('planes.destroy', ':id') }}" method="POST" id="content_modal"
            class="hidden fixed bottom-0 top-0 right-0 left-0 bg-[#00000080] z-50 flex items-center justify-center">
            @csrf
            @method('DELETE')
            <x-loader.loader />
        </form>
    </div>
    <script>
        const loader = $('#loader')
        const selectPuesto = $('#puestos')
        const selectTrabajos = $('#select-trabajos')

        const buscadorTrabajos = $('#buscador-trabajos')
        const buscador = $('#buscador')
        const btnBuscar = $('#submit-buscar')
        const contentCursos = $('#content_cursos')
        // 

        // 
        const contentModal = $("#content_modal");

        contentModal.addEventListener('click', (event) => {
            if (event.target === contentModal) {
                contentModal.innerHTML = `<x-loader.loader />`
                contentModal.classList.add('hidden')
            }
        })



        // Funciones para buscar los cursos
        buscadorTrabajos.addEventListener("keydown", function(event) {
            if (event.keyCode === 13) {
                // Se presionó la tecla "Enter"
                event.preventDefault()
                searchJobs(buscadorTrabajos.value)

            }
        });
        buscador.addEventListener("keydown", function(event) {
            if (event.keyCode === 13) {
                // Se presionó la tecla "Enter"
                event.preventDefault()
                searchCurses(buscador.value)
            }
        });
        btnBuscar.addEventListener("click", function(event) {
            event.preventDefault()
            searchCurses(buscador.value)
        });

        // Funcion para mostrar los cursos asignados  de los trabajos
        function addEventBtns() {
            const trabajos_btn = $$(".trabajos__btn")
            trabajos_btn.forEach(trabajo_btn => {
                trabajo_btn.addEventListener('click', (e) => {
                    let id = e.target.id
                    let trabajo = e.target.textContent
                    contentModal.classList.toggle('hidden')
                    let actionURL = contentModal.getAttribute("action").replace(":id", id);
                    contentModal.setAttribute("action", actionURL);
                    getCursesByJob(id, '', trabajo)
                })
            })
        }

        addEventBtns()

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
                    let cursos = ''
                    data.forEach(curso => {
                        cursos += `<label class="cursor-pointer block  h-auto rounded-lg  border-fuchsia-400 mb-4 overflow-hidden bg-gray-50">
                                    <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />

                                    <div class="relative peer-checked:bg-orange-200 h-full p-2">
                                        <h2 class="uppercase text-sm">${curso.nombre}</h2>
                                        <h3 class="text-gray-500 text-[12px]">${curso.codigo ?? ""}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                    </div>
                                 </label>`
                    })
                    if (data.length < 1)
                        cursos = '<p class="text-white font-title font-semi-bold">no se encontraron coincidencias</p>'
                    contentCursos.innerHTML = cursos
                    loader.innerHTML = ""
                })
                .catch(err => console.error(err))
        }

        function searchJobs(text) {
            const contentTrabajos = $('#content-trabajos')
            contentTrabajos.innerHTML = `<div role="status" class="flex flex-col items-center justify-center w-full">
                                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>`
            fetch(`${API_URL}/cursosplanta/trabajos?buscador=${text}`)
                .then(res => {
                    // manejando errores por si recibimos respuestas 4xx o 5xx que no entran en el catch
                    if (!res.ok) {
                        throw new Error("Error HTTP: " + res.status);
                    }
                    return res.json()
                })
                .then(data => {
                    console.log(data)
                    let trabajos = ''
                    data.forEach(trabajo => {
                        trabajos += `
                        <button id="${trabajo.id_trabajo}" class="trabajos__btn bg-gray-500 py-1.5 px-2 hover:bg-gray-300 hover:text-gray-600">
                            ${trabajo.nombre}
                        </button>`
                    })
                    if (data.length < 1)
                        trabajos = '<p class="text-white font-title font-semi-bold">no se encontraron coincidencias</p>'

                    contentTrabajos.innerHTML = trabajos
                    addEventBtns()
                })
                .catch(err => console.error(err))
        }

        function getCursesByJob(id, text, trabajo) {
            fetch(`${API_URL}/cursosplanta/cursosxplanes/${id}?buscador=${text}`)
                .then(res => {
                    // manejando errores por si recibimos respuestas 4xx o 5xx que no entran en el catch
                    if (!res.ok) {
                        throw new Error("Error HTTP: " + res.status);
                    }
                    return res.json()
                })
                .then(data => {
                    console.log(data.cursosPorTrabajo)

                    let cursos = ''
                    data.cursosPorTrabajo.forEach(curso => {
                        cursos += `<label class="cursor-pointer block  h-auto rounded-sm  bg-gray-200 mb-4 overflow-hidden">
                                    <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />

                                    <div class="relative peer-checked:bg-purple-200 h-full p-2">
                                        <h2 class="uppercase text-sm">${curso.nombre}</h2>
                                        <h3 class="text-gray-500 text-[12px]">${curso.codigo}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                        <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                    </div>
                                 </label>`
                    })
                    if (data.length < 1)
                        cursos = '<p class="text-white font-title font-semi-bold">no se encontraron coincidencias</p>'

                    contentModal.innerHTML = `
                        @csrf
                        @method('DELETE')
                        <div class="m-auto my-auto md:w-[70%] lg:w-[60%] h-[80%] bg-white rounded-md  overflow-auto p-2">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h2 class="text-subtitle font-semi-bold">${trabajo}</h2>
                                    <p class="font-bold text-base">Cursos asignados</p>
                                </div>
                                <x-input-submit text="Eliminar" />
                            </div>
                            <p class="text-sm">para eliminar los cursos del trabajo seleccione los cursos y click en eliminar</p>
                                <div class="grid grid-cols-[repeat(auto-fit,minmax(150px,1fr))] p-2 gap-y-0 gap-x-2 w-full">
                                ${cursos}
                                </div>
                        </div>`
                })
                .catch(err => console.error(err))
        }
    </script>

</x-app>
