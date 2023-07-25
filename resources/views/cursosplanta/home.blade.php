<x-app title="INICIO">
    <div>
        <div class=" min-h-[80px]  mb-3 flex p-1 gap-8">
            <button id="btn-puestos"
                class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-base font-regular">Núm. Empleados <br /> por puesto</span>
                </div>
                <i class='bx bx-briefcase'></i>
            </button>
            <div
                class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{ $allEmpleados }}</span>
                    <span class="text-base font-regular">Empleados activos</span>
                </div>
                <i class='bx bx-user'></i>
            </div>
            <div
                class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{ $allSucursales }}</span>
                    <span class="text-base font-regular">Sucursales</span>
                </div>
                <i class='bx bx-buildings'></i>
            </div>
        </div>

        <div class="bg-primary py-2 px-2 rounded-md mb-4">
            <div class="flex items-center justify-between">
                <h2 class="font-poppins font-medium text-subtitle uppercase text-white">Historial</h2>
                <form id="cierre_mes" class="cierre_mes" action="{{ route('reporte.general') }}" method="POST">
                    @csrf
                    <input  type="submit"
                        class="bg-red-500 text-white uppercase font-semi-bold py-1 px-2 rounded-md cursor-pointer"
                        value="Cierre de mes" />
                </form>
            </div>
            <small class="text-white">Antes de cerrar mes, verifique el progreso de los empleados. Una vez cerrado el mes, podrá ver los cambios guardados en el mes siguiente</small>

            <x-tables.table-sucursal :data="$historial" :reporteMesActual="$reporteMesActual" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-poppins font-medium text-subtitle">PROGRESO DE LOS EMPLEADOS</h2>
                <x-search.search-input placeholder="id, id sgp, id sumtotal, nombre, puesto..." route="home" />
            </div>
            @if (count($data['data']) > 0)
                <!-- Mostrar enlaces de paginación -->
                <!-- Mostrar enlaces de paginación -->
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        {{-- $usuarios->currentPage(): Devuelve el número de página actual.
                        $usuarios->perPage(): Devuelve la cantidad de resultados mostrados por página.
                        $usuarios->total(): Devuelve el total de resultados obtenidos. --}}
                        <p class="text-sm text-gray-700">
                            Mostrando
                            <span class="font-medium">{{ $data['links']['paginator']->currentPage() }}</span>
                            a
                            <span class="font-medium">{{ $data['links']['paginator']->perPage() }}</span>
                            de
                            <span class="font-medium">{{ $data['links']['paginator']->total() }}</span>
                            resultados
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            <!-- Enlace a la primera página -->
                            @if ($data['links']['paginator']->currentPage() > 3)
                                <a href="{{ $data['links']['paginator']->url(1) }}"
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">1</a>
                                @if ($data['links']['paginator']->currentPage() > 4)
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">...</span>
                                @endif
                            @endif

                            {{-- Páginas --}}
                            @foreach ($data['links']['paginator']->getUrlRange(max(1, $data['links']['paginator']->currentPage() - 2), min($data['links']['paginator']->lastPage(), $data['links']['paginator']->currentPage() + 2)) as $page => $url)
                                {{-- Mostrar solo la página más cercana al margen --}}
                                @if (
                                    $page == 1 ||
                                        $page == $data['links']['paginator']->lastPage() ||
                                        abs($page - $data['links']['paginator']->currentPage()) <= 2)
                                    <a href="{{ $url }}"
                                        class="{{ $data['links']['paginator']->currentPage() === $page ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($data['links']['paginator']->currentPage() != $data['links']['paginator']->lastPage())
                                {{-- Mostrar siempre la última página --}}
                                @if ($data['links']['paginator']->lastPage() - $data['links']['paginator']->currentPage() > 2)
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">...</span>
                                @endif
                                <a href="{{ $data['links']['paginator']->url($data['links']['paginator']->lastPage()) }}"
                                    class="{{ $data['links']['paginator']->currentPage() === $data['links']['paginator']->lastPage() ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }}">{{ $data['links']['paginator']->lastPage() }}</a>
                            @endif

                            <!-- Enlace a la siguiente página -->
                            @if ($data['links']['paginator']->hasMorePages())
                                <a href="{{ $data['links']['paginator']->nextPageUrl() }}"
                                    aria-label="@lang('pagination.next')"
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

            @endif
            {{-- fin pagination --}}
            @if (count($data['data']) > 0)
                <div class="card-body">
                    <table class="min-w-full leading-normal my-2 border-2">
                        <thead class="border-b  dark:border-neutral-500 uppercase">
                            <tr
                                class="px-5 border-b-2 border-gray-300 bg-th-table text-th-table-text text-left text-sm font-semibold  uppercase tracking-wider">
                                <th scope="col" class="px-6 py-2 w-1/12">ID SGP</th>
                                <th scope="col" class="px-6 py-2">ID SUMTOTAL</th>
                                <th scope="col" class="px-6 py-2">empleado</th>
                                <th scope="col" class="px-6 py-2">puesto</th>
                                <th scope="col" class="px-6 py-2 w-1/12 ">total de cursos</th>
                                <th scope="col" class="px-6 py-2 w-1/12 ">cursos aprobados</th>
                                <th scope="col" class="px-6 py-2 w-1/12 ">cursos reprobados</th>
                                <th scope="col" class="px-6 py-2 w-1/12 ">cursos progresos</th>
                                <th scope="col" class="px-6 py-2 w-1/12 ">progreso</th>
                                <th scope="col" class="px-6 py-2">opciones</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($data['data'] as $usuario)
                                {{-- @dump($usuario) --}}

                                <tr class="border-b border-gray-300 hover:bg-gray-200 text-sm">
                                    <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                                    <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sumtotal }}</td>
                                    <td class="py-3 px-6 text-left capitalize">{{ $usuario->empleado }}</td>
                                    <td class="py-3 px-6 text-left">{{ $usuario->puesto }}</td>
                                    <td class="py-3 px-6 text-left">{{ $usuario->total }}</td>
                                    <td class="py-3 px-6 text-left w-1/12 ">{{ $usuario->totalCursosPasados }}</td>
                                    <td class="py-3 px-6 text-left w-1/12 ">{{ $usuario->cursosReprobados }}</td>
                                    <td class="py-3 px-6 text-left w-1/12 ">{{ $usuario->cursosEnProgreso }}</td>
                                    <td class="py-3 px-6 text-left w-1/12 ">{{ $usuario->promedioTotal }}</td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="w-full flex justify-end mt-2">
                                            <a target="_blank"
                                                href="{{ route('descargarPDF', $usuario->id_usuario) }}"
                                                class="text-white bg-btn-primary hover:bg-btn-primary-light focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ver
                                                reporte</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-title font-bold mt-6">Sin registros...</p>
            @endif
        </div>
    </div>


    <div id="content_modal" class="hidden fixed bottom-0 top-0 right-0 left-0 bg-[#00000080] z-50">
        <div class="m-auto  w-[50%] h-[80%] bg-white rounded-md py-4 px-3 overflow-auto">
            <x-loader.loader />
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const btnPuestos = $("#btn-puestos");
        const contentModal = $("#content_modal");

        contentModal.addEventListener('click', (event) => {
            if (event.target === contentModal) {
                contentModal.classList.add('hidden')
            }
        })

        btnPuestos.addEventListener('click', async (e) => {
            contentModal.classList.toggle('hidden')
            const data = await getData()
            contenidoTr = ""
            data.forEach(element => {
                contenidoTr += `<tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td> ${element.puesto}</td>
                                    <td class="py-3 px-6 text-center">${element.num_empleados}</td>
                                </tr>
                `
            });

            const contenido = `
            <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2  w-[50%] h-[80%] bg-white rounded-md py-4 px-3 overflow-auto">
                    <h2 class="text-section-subtitle font-bold">Puestos</h2>
                    <div>
                        <table class="min-w-full leading-normal my-2">
                            <thead class="border-b  dark:border-neutral-500 uppercase ">
                                <tr class="px-5 border-b-2 border-gray-200 bg-blue-200 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                    <th class="px-6 py-2">Puesto</th>
                                    <th>numero de empleados</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${contenidoTr}
                            </tbody>
                        </table>
                    </div>
                </div>
            `

            contentModal.innerHTML = contenido
        })



        async function getData() {
            // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
            const respuestaRaw = await fetch(`${API_URL}/cursosplanta/trabajadores/datos`);
            // Decodificar como JSON
            const respuesta = await respuestaRaw.json();
            // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
            // Obtener una referencia al elemento canvas del DOM

            console.log(respuesta);
            return respuesta
        }

        const btnCierre = $("#cierre_mes")

        btnCierre.addEventListener("submit", (e) => {
            e.preventDefault();

            swal.fire({
                title: 'Estas seguro de cerrar mes',
                text: "una vez cerrado el mes este boton desaparecera y ya no podras cerrar mes, hasta finales del siguiente mes",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    btnCierre.submit();
                    btnCierre.classList.add("hidden")
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado correctamente',
                        'error'
                    )
                }
            })
        });
    </script>
</x-app>
