<x-app title="generar reportes">

    <form action="{{ route('reportes.index') }}" method="GET">
        @method('GET')
        <div class=" flex gap-4 flex-wrap items-end">
            <div>
                <x-selects.input-select textLabel="sucursales" name="filtros[sucursal_id]" class="text-sm"
                    textOptionDefault="sucursales" :sucursales="$sucursales" />
            </div>
            <div>
                <x-selects.input-select textLabel="puestos" name="filtros[puesto_id]" class="text-sm"
                    textOptionDefault="selecciona un puesto" :puestos="$puestos" id="puesto_id"  />
            </div>

            <div>
                <label for="trabajo_id"
                    class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">trabajos</label>
                <select id="trabajo_id" name="filtros[trabajo_id]"
                    class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white text-sm">
                    <option value="">selecciona un trabajo</option>
                </select>
            </div>

            <div>
                <label for="curso_id"
                    class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">Cursos</label>
                <select id="curso_id" name="filtros[curso_id]"
                    class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white text-sm">
                    <option value="">Selecciona un curso</option>
                </select>
            </div>


            <x-input-submit text="Filtrar" class="max-h-[40px]" />
        </div>
    </form>

    @if (count($data) > 0)
        <div class="mt-4 ">

            <div class="flex justify-end">
                <a href="{{ route('reportes.index', array_merge(request()->query(), ['export' => 1])) }}"
                    class="inline-block bg-blue-800 py-1.5 px-2 text-white font-bold rounded-md self-end">
                    Exportar datos a Excel
                </a>
            </div>


            <table class="min-w-full leading-normal my-2">
                <thead class="border-b  dark:border-neutral-500 uppercase">
                    <tr
                        class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th scope="col" class="px-6 py-2 w-1/12">ID SGP</th>
                        <th scope="col" class="px-6 py-2">ID SUMTOTAL</th>
                        <th scope="col" class="px-6 py-2 ">SUCURSAL</th>
                        <th scope="col" class="px-6 py-2">EMPLEADO</th>
                        <th scope="col" class="px-6 py-2">PUESTO</th>
                        <th scope="col" class="px-6 py-2">TRABAJO</th>
                        <th scope="col" class="px-6 py-2">CURSO</th>
                        <th scope="col" class="px-6 py-2">PROGRESO</th>
                        <th scope="col" class="px-6 py-2">ESTADO</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($data as $usuario)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->id_sumtotal }}</td>
                            <td class="py-3 px-6 text-left capitalize">{{ $usuario->sucursal }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->empleado }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->puesto }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->trabajo }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->curso }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->valor ?? 0 }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($usuario->valor == 0 && $usuario->estado == 1) En progreso @endif
                                @if ($usuario->estado == 2 || $usuario->estado === null)
                                    En progreso
                                @endif
                                @if ($usuario->estado === 0)
                                    Reprovado
                                @endif
                                @if ($usuario->estado == 1 && $usuario->valor == 100)
                                    Aprovado
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-title font-bold mt-6">Sin resultados...</p>
    @endif
    <div id="loader" />

    <script>
        const puestoSelect = $("#puesto_id")
        const trabajoSelect = $("#trabajo_id")
        const cursoSelect = $("#curso_id")


        document.addEventListener('DOMContentLoaded', function() {
            // Obtener el valor seleccionado del select
            let selectedValue = puestoSelect.value;
            console.log(puestoSelect.value)
            // Verificar si el valor seleccionado no es el valor por defecto
            // esto carga el puesto y trabajos del puesto del usuario
            if (selectedValue !== '') {
                getJobsByPosition(selectedValue);
            }
        });

        puestoSelect.addEventListener('change', (e) => {
            let id = e.target.value;
            puestoSelect.options[0].setAttribute('disabled', true)
            getJobsByPosition(id)
        })

        trabajoSelect.addEventListener('change', (e) => {
            let id = e.target.value;
            getCursos(id)
            trabajoSelect.options[0].setAttribute('disabled', true)
        })

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
                    trabajoSelect.innerHTML = trabajos
                    loader.innerHTML = ""
                })
                .catch(err => console.log(err))
        }

        function getCursos(id, text = "") {
            loader.innerHTML = `<x-loader.loader />`
            return fetch(`${API_URL}/cursosplanta/cursosxplanes/${id}?buscador=${text}`)
                .then(res => res.json())
                .then(data => {

                    let cursos = '<option value="" class="text-gray-400">Selecciona un curso</option>'
                    data.cursosPorTrabajo.forEach(curso => {
                        cursos +=
                            `<option value="${curso.id_curso}">${curso.nombre}</option>`
                    });

                    cursoSelect.innerHTML = cursos;
                    loader.innerHTML = ""
                    cursoSelect.options[0].setAttribute('disabled', true)
                })
                .catch(err => console.log(err));
        }
    </script>
</x-app>


{{-- 
             --}}
