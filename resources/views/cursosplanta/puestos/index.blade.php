<x-app title="puestos">

    <form method="POST" id="crear_puesto" action="{{ route('puestos.store') }}"
        class="flex flex-wrap flex-col gap-4 mt-4">
        @csrf

        <div class="flex gap-3 items-center">
            <x-input-text placeholder="Ej. jefe de taller" nombre="puesto" text="Puesto" />

            <div class="flex flex-col font-poppins gap-21 text-text-input">
                <label class="mb-2 font-semi-bold">Seleccionar plan de informacion</label>
                <select name="plan_id"
                    class="py-1.5 px-2 leading-tight text-gray-700 border-2 rounded-lg border-input cursor-pointer uppercase">
                    <option value="" class="text-gray-400">plan de formacion</option>
                    @foreach ($planesFormacion as $plan)
                        <option value="{{ $plan->id_plan_formacion }}">
                            {{ $plan->tema }} {{ $plan->area }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <span class="flex items-center gap-2">
            ¿Desea asignar trbajos para este puesto?
            <button id="add_trabajo" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path fill="currentColor"
                        d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20a10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16z" />
                </svg>
            </button>
        </span>


        <div id="trabajos" class="flex flex-wrap gap-3 items-center">
        </div>

        <x-input-submit text="aceptar" />
    </form>



    <h2>Lista de puestos</h2>

    <div>
        <ul>
            @foreach ($puestos as $puesto)
                <li class="mb-4">
                    <div>
                        <div class="flex items-center">
                            <button class="edit_button" name="{{ $puesto->id_puesto }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38"
                                    viewBox="0 0 24 24">
                                    <g fill="none" stroke="#716ef9" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1">
                                        <path
                                            d="m16.474 5.408l2.118 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621Z" />
                                        <path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3" />
                                    </g>
                                </svg>
                            </button>

                            <form method="POST" action="{{ route('puestos.destroy', $puesto->id_puesto) }}">
                                @csrf
                                @method("DELETE")
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 256 256">
                                        <path fill="red"
                                            d="M216 50h-42V40a22 22 0 0 0-22-22h-48a22 22 0 0 0-22 22v10H40a6 6 0 0 0 0 12h10v146a14 14 0 0 0 14 14h128a14 14 0 0 0 14-14V62h10a6 6 0 0 0 0-12ZM94 40a10 10 0 0 1 10-10h48a10 10 0 0 1 10 10v10H94Zm100 168a2 2 0 0 1-2 2H64a2 2 0 0 1-2-2V62h132Zm-84-104v64a6 6 0 0 1-12 0v-64a6 6 0 0 1 12 0Zm48 0v64a6 6 0 0 1-12 0v-64a6 6 0 0 1 12 0Z" />
                                    </svg>
                                </button>
                            </form>

                            <div class="h-5">
                                <button data-popover-target="popover-click-{{ $puesto->id_puesto }}"
                                    data-popover-trigger="click" data-popover-placement="right" type="button"
                                    class="uppercase">{{ $puesto->puesto }}</button>

                                @if (count($puesto->trabajos) < 1)
                                    <p class="text-sm text-gray-light">Este puesto no cuenta con trabajos</p>
                                @else
                                    <p class="text-sm text-gray-light">trabajos
                                        <span
                                            class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ count($puesto->trabajos) }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>


                        <div data-popover id="popover-click-{{ $puesto->id_puesto }}" role="tooltip"
                            class="absolute z-10 invisible inline-block w-64  max-h-64 overflow-auto text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            <div
                                class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Trabajos</h3>
                            </div>
                            @if (count($puesto->trabajos) < 1)
                                <p>Este puesto no cuenta con trabajos</p>
                            @endif
                            <ul>
                                @foreach ($puesto->trabajos as $trabajo)
                                    <li>
                                        <div class="flex items-center">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="#716ef9" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1">
                                                        <path
                                                            d="m16.474 5.408l2.118 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621Z" />
                                                        <path
                                                            d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3" />
                                                    </g>
                                                </svg>
                                            </button>

                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                    viewBox="0 0 256 256">
                                                    <path fill="red"
                                                        d="M216 50h-42V40a22 22 0 0 0-22-22h-48a22 22 0 0 0-22 22v10H40a6 6 0 0 0 0 12h10v146a14 14 0 0 0 14 14h128a14 14 0 0 0 14-14V62h10a6 6 0 0 0 0-12ZM94 40a10 10 0 0 1 10-10h48a10 10 0 0 1 10 10v10H94Zm100 168a2 2 0 0 1-2 2H64a2 2 0 0 1-2-2V62h132Zm-84-104v64a6 6 0 0 1-12 0v-64a6 6 0 0 1 12 0Zm48 0v64a6 6 0 0 1-12 0v-64a6 6 0 0 1 12 0Z" />
                                                </svg>
                                            </button>

                                            <p>{{ $trabajo->nombre }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        const API_URL = "http://localhost:8000/api/"

        const buttonAddTrabajo = $('#add_trabajo');
        const containerTrabajos = $('#trabajos')

        const formCrearPuesto = $('#crear_puesto'); //-> formulario
        const editButtons = $$('.edit_button')

        const inputTrabajo = `
        <x-input-text placeholder="Ej. jefe de taller" nombre="trabajo[]" text="Trabajo" />
      `

        // AGREGANDO A CADA ELEMENTO DE EDITAR EL EVENTO CLICK
        editButtons.forEach(element => {
            element.addEventListener('click', (event) => {
                let id = event.currentTarget.name
                // CUANDO ESCUCHA EL EVENTO LLAMA A LA FUNCION
                getPuestoInfo(id)
            })
        });



        // CREANDO EL CAMPO PARA AGREGAR UN TRABAJO
        buttonAddTrabajo.addEventListener('click', (e) => {
            e.preventDefault()
            let div = document.createElement('div')
            div.innerHTML = inputTrabajo
            containerTrabajos.appendChild(div)
        })



        // VERIFICAR SI EL FORMULARIO ES PARA EDITAR Y GENERARA UN FORMDATA PARA ALMACENAR LOS DATOS A ACTUALIZAR Y ENVIARLOS A LA API
        formCrearPuesto.addEventListener('submit', e => {
            if ($('#submit_button').value === "editar") {
                e.preventDefault()
                const formData = new FormData();
                formData.append('id_puesto', formCrearPuesto.elements.puesto.name)
                formData.append('puesto', formCrearPuesto.elements.puesto.value)
                formData.append('plan_formacion_id', formCrearPuesto.elements.plan_id.value)

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

                fetch(`${API_URL}cursosplanta/puesto/edit/${id}`, {
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
            return fetch(`${API_URL}cursosplanta/puesto/${id}`)
                .then(res => res.json())
                .then(data => {
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
                })
        }
    </script>

</x-app>
