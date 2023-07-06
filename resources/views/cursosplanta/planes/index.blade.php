<x-app title="ASIGNAR CURSOS">
    <div class="flex gap-5 w-full">
        <form action="{{ route('planes.store') }}" method="POST"
            class="border-2 border-blue-200 rounded-md bg-blue-100 mt-2 p-2 w-1/2">
            @csrf
            <div class="flex  gap-3 mb-2 ">
                <div class="flex flex-col justify-start">
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

                <div class="flex flex-col justify-start">
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

            <div class="mt-2">
                <h2 class="text-gray-800 italic">Secciona los cursos a asignar al trabajo</h2>
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
            <form action="{{ route('planes.destroy', ':id') }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-subtitle">Cursos asignados</h2>
                    <x-input-submit text="Eliminar" />
                </div>
                <p>cursos asignados. seleccione los cursos a eliminar en del trabajo</p>
                <div id="cursos-por-puesto"
                    class="bg-primary grid grid-cols-[repeat(auto-fit,minmax(180px,1fr))] p-2 gap-y-0 gap-x-2  rounded-md">
                </div>
            </form>
        </div>
    </div>
    <script>
        const puestoSelect = document.getElementById('puestos')
        const trabajosSelector = document.getElementById("trabajos")
        const deleteForm = document.getElementById("delete-form");

        puestoSelect.addEventListener('change', (event) => {
            let puesto_id = event.target.value
            getJobsByPosition(puesto_id);
        })

        trabajosSelector.addEventListener('change', (event) => {
            let trabajo_id = event.target.value
            let actionUrl = deleteForm.getAttribute("action").replace(":id", trabajo_id);
            deleteForm.setAttribute("action", actionUrl);
            getCursos(trabajo_id)
        })

        function getJobsByPosition(id) {
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
                })
                .catch(err => console.log(err))
        }

        function getCursos(id) {
            console.log(id)
            return fetch(`${API_URL}/cursosplanta/cursosxplanes/${id}`)
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
                                    <h3 class="text-gray-500 text-[12px]">${curso.codigo}</h3>
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
                                    <h3 class="text-gray-500 text-[12px]">${curso.codigo}</h3>
                                    <h3 class="text-gray-500 text-[12px]">${curso.modalidad}</h3>
                                    <h3 class="text-gray-500 text-[12px]">${curso.tipo}</h3>
                                </div>
                            </label>`
                    });

                    document.getElementById("cursos-por-puesto").innerHTML = cursosPorPlan;
                    document.getElementById("cursos").innerHTML = cursosDisponibles;
                })
                .catch(err => console.log(err));
        }
    </script>

</x-app>
