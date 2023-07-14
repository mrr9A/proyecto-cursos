<x-app title="puestos">

    {{-- <a href="{{ route('puestos.cursos') }}" --}}
    <a href="{{ route('planes.index') }}"
        class="absolute right-4 text-base top-16 border-b-2 border-2 rounded-md  focus:outline-none font-medium px-5 py-1.5 text-center bg-blue-600 text-white hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
        Asignar cursos
    </a>

    <form method="POST" id="crear_puesto" action="{{ route('puestos.store') }}" class="flex flex-wrap flex-col gap-4 mt-4">
        @csrf

        <div class="flex gap-6 items-center">
            <x-input-text placeholder="0-12" nombre="codigo" text="Codigo" class="w-1/8" classLabel="text-base" required />
            <x-input-text placeholder="Ej. jefe de taller" nombre="puesto" text="Puesto" class="w-1/4"
                classLabel="text-base"  required/>

            <div class="relative flex flex-col font-poppins gap-21 text-base">
                <label class="mb-2 font-semi-bold">Seleccionar plan de informacion</label>
                <select name="plan_id" required
                    class="py-1.5 px-2 leading-tight text-gray-700 border-2 rounded-lg border-input cursor-pointer uppercase">
                    <option value="" class="text-gray-400">plan de formacion</option>
                    @foreach ($planesFormacion as $plan)
                        <option value="{{ $plan->id_plan_formacion }}">
                            {{ $plan->tema }} {{ $plan->area }}
                        </option>
                    @endforeach
                </select>
                @error('plan_id')
                    <!-- variable mensaje disponible por laravel -->
                    <small class="absolute -bottom-4 text-sm text-red-500 font-semibold italic">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div id="alert-additional-content-1"
            class="px-4 py-2 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
            role="alert">
            <div class="text-sm flex items-center">
                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>

                <span class="">si no crea trabajos para el puesto en automatico se creara un trabajo con el mismo
                    nombre del puesto</span>
            </div>

            <div class="flex">
                <button type="button"
                    class="border-none text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
                    data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                    cerrar
                </button>
            </div>
        </div>
        <span class="flex items-center gap-2">
            ¿Desea asignar trabajos para este puesto?
            <button id="add_trabajo" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path fill="currentColor"
                        d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20a10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16z" />
                </svg>
            </button>
        </span>


        <div id="trabajos" class="flex flex-wrap gap-3 items-center">
        </div>

        <x-input-submit text="Aceptar" class="w-32" />
    </form>

    {{-- Lista de los puestos --}}
    <div class="flex flex-col gap-3 mt-5">
        <h2 class="text-subtitle">Lista de puestos</h2>
        <table class="min-w-full">
            <thead class="uppercase bg-blue-200 text-left">
                <th class="px-6 py-2">Codigo</th>
                <th class="px-6 py-2">Plan de formacion</th>
                <th class="px-6 py-2">puesto</th>
                <th class="px-6 py-2">trabajos</th>
                <th class="px-6 py-2">opciones</th>
            </thead>
            <tbody class="uppercase">
                @foreach ($puestos as $puesto)
                    <tr class="mb-4 border-b border-gray-200 hover:bg-gray-100">
                        <td class="whitespace-nowrap px-6 py-1 ">
                            {{$puesto->codigo ?? 0}}
                        </td>
                        <td class="whitespace-nowrap px-6 py-1 ">
                            {{ $puesto->planes_formacion->tema }} {{ $puesto->planes_formacion->area }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-1 ">
                            <span>{{ $puesto->puesto }}</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-1 text-sm">
                            <ul>
                                @if (count($puesto->trabajos) < 1)
                                    <li>Este puesto no cuenta con trabajos</li>
                                @endif
                                @foreach ($puesto->trabajos as $trabajo)
                                    <li>
                                        <div class="flex items-center gap-2">
                                            @if ($trabajo->nombre != $puesto->puesto)
                                                <form action='{{ route('trabajos.destroy', $trabajo->id_trabajo) }}'
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <img src="/svg/delete.svg" />
                                                    </button>
                                                </form>
                                            @else
                                                <div class="w-[21px]"></div>
                                            @endif
                                            <p>{{ $trabajo->nombre }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="whitespace-nowrap px-6 py-1 ">
                            <button class="edit_button" name="{{ $puesto->id_puesto }}">
                                <img src="/svg/edit.svg" />
                            </button>

                            <button data-modal-target="puesto-{{ $puesto->id_puesto }}"
                                data-modal-toggle="puesto-{{ $puesto->id_puesto }}">
                                <img src="/svg/delete.svg" />
                            </button>

                            <x-modals.alert-modal id="puesto-{{ $puesto->id_puesto }}" route="puestos.destroy"
                                :parametroDeRoute="$puesto->id_puesto" title="Esta seguro de eliminar el puesto"
                                message="El puesto {{ $puesto->puesto }} sera eliminado" />

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-4">
            <ul class="flex items-center justify-center space-x-2">
                <!-- Enlace a la página anterior -->
                @if ($puestos->onFirstPage())
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="px-2 py-1 rounded bg-gray-300 text-gray-600 cursor-not-allowed"
                            aria-hidden="true">&laquo;</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $puestos->previousPageUrl() }}" rel="prev"
                            class="px-2 py-1 rounded bg-blue-500 text-white hover:bg-blue-600"
                            aria-label="@lang('pagination.previous')">&laquo;</a>
                    </li>
                @endif

                <!-- Enlaces a las páginas individuales -->
                @foreach ($puestos->links() as $link)
                    @if ($link['url'])
                        <li>
                            <a href="{{ $link['url'] }}"
                                class="{{ $link['active'] ? 'px-2 py-1 rounded bg-blue-500 text-white hover:bg-blue-600' : 'px-2 py-1 rounded text-gray-600 hover:text-blue-500' }}">{{ $link['label'] }}</a>
                        </li>
                    @else
                        <li class="disabled" aria-disabled="true">
                            <span class="px-2 py-1 rounded text-gray-600">{{ $link['label'] }}</span>
                        </li>
                    @endif
                @endforeach

                <!-- Enlace a la siguiente página -->
                @if ($puestos->hasMorePages())
                    <li>
                        <a href="{{ $puestos->nextPageUrl() }}" rel="next"
                            class="px-2 py-1 rounded bg-blue-500 text-white hover:bg-blue-600"
                            aria-label="@lang('pagination.next')">&raquo;</a>
                    </li>
                @else
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="px-2 py-1 rounded bg-gray-300 text-gray-600 cursor-not-allowed"
                            aria-hidden="true">&raquo;</span>
                    </li>
                @endif
            </ul>
        </div>

    </div>

    <div id="loader" />
    <script src="{{ asset('js/utils/validarInputs.js') }}"></script>
    <script>
        var id = 1
        const buttonAddTrabajo = $('#add_trabajo');
        const containerTrabajos = $('#trabajos')
        const loader = $('#loader')

        const formCrearPuesto = $('#crear_puesto'); //-> formulario
        const editButtons = $$('.edit_button')

        const inputTrabajo = (id) => (`
        <div class="relative">
            <button class="btnEliminarCurso absolute right-0 top-0 z-50 text-red-500" data-curso-id="${id}"><i class="bx bx-x-circle"></i></button>
            <x-input-text placeholder="Ej. jefe de taller" nombre="trabajo[]" text="Trabajo" />
        </div>
      `)
        validarInputs()

        // AGREGANDO A CADA ELEMENTO DE EDITAR EL EVENTO CLICK
        editButtons.forEach(element => {
            element.addEventListener('click', (event) => {
                let id = event.currentTarget.name
                // CUANDO ESCUCHA EL EVENTO LLAMA A LA FUNCION
                getPuestoInfo(id)
                window.scroll({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            })
        });
        // CREANDO EL CAMPO PARA AGREGAR UN TRABAJO
        buttonAddTrabajo.addEventListener('click', (e) => {
            e.preventDefault()
            let div = document.createElement('div')
            div.setAttribute('id', id);
            div.innerHTML = inputTrabajo(id)
            containerTrabajos.appendChild(div)
            id++

            validarInputs()

            let btnEliminarCurso = div.querySelector('.btnEliminarCurso');
            btnEliminarCurso.addEventListener('click', (event) => {
                event.preventDefault()
                let cursoId = event.target.parentElement.dataset.cursoId;
                console.log(cursoId)
                console.log(cursoId)
                let cursoElement = document.getElementById(cursoId);
                if (cursoElement) {
                    cursoElement.remove();
                }
            });
        })



        // VERIFICAR SI EL FORMULARIO ES PARA EDITAR Y GENERARA UN FORMDATA PARA ALMACENAR LOS DATOS A ACTUALIZAR Y ENVIARLOS A LA API
        formCrearPuesto.addEventListener('submit', e => {
            if ($('#submit_button').value === "editar") {
                e.preventDefault()
                const formData = new FormData();
                formData.append('id_puesto', formCrearPuesto.elements.puesto.name)
                formData.append('codigo', formCrearPuesto.elements.codigo.value)
                formData.append('puesto', formCrearPuesto.elements.puesto.value)
                formData.append('plan_id', formCrearPuesto.elements.plan_id.value)

                let trabajos = []
                $$("[name='trabajo[]']").forEach(trabajo => {
                    data = {
                        "id_trabajo": trabajo.id,
                        "nombre": trabajo.value
                    }
                    trabajos.push(data)
                })
                formData.append("trabajos", JSON.stringify(trabajos))
                formData.append("_method", 'put')

                let id = formCrearPuesto.elements.puesto.name

                // var formDataObj = Object.fromEntries(formData);

                fetch(`${API_URL}/cursosplanta/puesto/edit/${id}`, {
                        method: "post",
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data)
                        window.location.reload()
                    })
                    .catch(err => console.log(err))
            }
        })
        // OBTIENE LA INFORMACION DEL PUESTO A EDITAR Y LOS MUESTRA EN EL FORMULARIO
        function getPuestoInfo(id) {
            loader.innerHTML = `<x-loader.loader />`
            return fetch(`${API_URL}/cursosplanta/puesto/${id}`)
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    $('#submit_button').value = "editar";
                    $$('option').forEach(option => {
                        option.removeAttribute('selected')
                        if (Number(data.plan_formacion_id) === Number(option.value)) {
                            console.log("econtro algo")
                            option.setAttribute("selected", true)
                        }
                    })

                    if (data.trabajos.length > 0) {
                        let dataTrabajos = ""
                        data.trabajos.forEach((trabajo => {
                            dataTrabajos +=
                                `<x-input-text placeholder="Ej. jefe de taller" nombre="trabajo[]" text="Trabajo" value="${trabajo.nombre}" id="${trabajo.id_trabajo}" />`
                        }))
                        containerTrabajos.innerHTML = dataTrabajos
                    } else(
                        containerTrabajos.innerHTML = ""
                    )
                    $('#puesto').value = data.puesto
                    $('#puesto').name = data.id_puesto

                    $('#codigo').value = data.codigo

                    loader.innerHTML = ""
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                })
        }
    </script>

</x-app>
