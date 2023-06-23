<x-app title="Asignar Cursos">
    <form action="{{ route('planes.store') }}" method="POST" class="m-4 p-2">
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
        <div class="flex">
            <div class="flex flex-col justify-start">
                <label>Puesto</label>
                <select name="puesto_id" id="puestos"
                    class="py-2 text-sm leading-tight uppercase border-none focus:outline-none ">
                    <option value="" class="text-gray-400 lowercase">Selecciona un puesto</option>
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id_puesto }}">
                            {{ $puesto->puesto }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col">
                <p>trabajos</p>
                <div id="content-works" class="flex flex-wrap flex-1 gap-2 justify-start"></div>
            </div>
        </div>


        <x-input-submit text="Continuar" />


        <div class="mt-4">
            <div class="bg-primary flex flex-wrap rounded-md p-5 gap-2 ">
                @if (!is_null($cursos))
                    <x-checkbox.checkbox :cursos="$cursos" />
                @endif
            </div>
        </div>
    </form>



    <script>
        const idSelect = $('#puestos')
        const contentWorks = $("#content-works")
        idSelect.addEventListener('change', (event) => {
            let plan_id = event.target.value
            $$("option")[0].setAttribute("disabled", true);
            getJobsByPosition(plan_id);
            getCursos(plan_id)
        })

        function getJobsByPosition(id) {
            contentWorks.innerHTML = `<x-loader.loader />`
            fetch(`http://localhost:8000/api/cursosplanta/puesto/${id}/trabajos`)
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    let trabajos = ""
                    if (data.length < 1) {
                        contentWorks.innerHTML = "<span>No tiene trabajos</span>"
                        return
                    };

                    // console.log(puesto)
                    data.forEach(trabajo => {
                        trabajos +=
                            `<div class="flex items-center mr-4">
                                <input id="${trabajo.id_trabajo}" type="checkbox" value="${trabajo.id_trabajo}" name="trabajos[]"  class="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-black dark:focus:ring-black dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="${trabajo.id_trabajo}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">${trabajo.nombre}</label>
                              </div>`
                    });
                    contentWorks.innerHTML = trabajos
                })
                .catch(err => {
                    contentWorks.innerHTML = "<span>Selecione un trabajo</span>"
                    console.log(err)
                })
        }

        function getCursos(id) {
            return fetch(`http://localhost:8000/api/cursosxplanes/${id}`)
                .then(res => res.json())
                .then(data => {
                    let cursosPorPlan = ""
                    let cursosDisponibles = ""
                    data.cursosPorPlan.forEach(curso => {
                        cursosPorPlan += `
                <div class="cursor-pointer inline-block w-52 h-auto rounded-md shadow-[0_1px_5px_1px_rgba(150,50,200,0.4)] border-fuchsia-400 mb-4 overflow-hidden p-2">
                    <h2>${curso.curso}</h2>
                    <h3>${curso.codigo}</h3>
                </div>
            `
                    });
                    data.cursosDisponible.forEach(curso => {
                        cursosDisponibles += `
            <label
                class="cursor-pointer inline-block w-52 h-auto rounded-md shadow-[0_1px_5px_1px_rgba(150,50,200,0.4)] border-fuchsia-400 mb-4 overflow-hidden">
                <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />
                <div class="peer-checked:bg-fuchsia-50 p-2">
                    <h2>${curso.curso}</h2>
                    <h3>${curso.codigo}</h3>
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
