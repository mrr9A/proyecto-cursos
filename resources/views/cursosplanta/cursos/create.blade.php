<x-app title="Crear curso">
    <div>
        <div>
            <h2>Puede crear mas de un curso al mismo tiempo, le recomiendo que no cree mas de 10 al mismo tiempo</h2>
        </div>
        <form id="form_cursos" action="{{ route('cursos.store') }}" method="POST" class="space-y-2">
            @method('POST')
            @csrf

            <button id="add_curso" class="bg-blue-400 py-1.5 px-2 rounded-md hover:bg-primary text-white">
                <i class='bx bx-close '></i>
                <span>Añadir otro curso</span>
            </button>
            <div id="container_cursos" class="grid grid-cols-3 w-full gap-3">
                <div id="curso_1" class="grid grid-cols-2 gap-3 w-full border-[1px]">
                    <h2 class="col-span-2 py-1 px-2 bg-blue-200">Curso 1</h2>
                    <x-input-text text="Nombre" nombre="curso_1[nombre]" placeholder="nombre" required
                        classLabel="text-base" mensaje="nombre" />
                    <x-input-text text="codigo" nombre="curso_1[codigo]" placeholder="codigo " classLabel="text-base"
                        mensaje="codigo" />
                    <x-input-text type="date" text="Fecha inicio" nombre="curso_1[fecha_inicio]"
                        placeholder="fecha_inicio " classLabel="text-base" mensaje="fecha_inicio" />
                    <x-input-text type="date" text="Fecha Termino" nombre="curso_1[fecha_termino]"
                        placeholder="fecha_termino" classLabel="text-base" mensaje="fecha_termino" />
                    {{-- SELECTS --}}
                    <x-selects.input-select textLabel="Modalidades" name="curso_1[modalidad_id]"
                        textOptionDefault="selecciona la modalidad" :modalidades="$modalidades" required mensaje="modalidad_id" />
                    <x-selects.input-select textLabel="tipo Curso" name="curso_1[tipo_id]"
                        textOptionDefault="selecciona tipo curso" :tipos="$tipos" required mensaje="tipo_id" />
                </div>
            </div>

            <div class="col-span-2">
                <x-input-submit text="crear" class="w-full" />

            </div>
        </form>
    </div>
    <script src="{{ asset('js/utils/validarInputs.js') }}"></script>
    <script>
        validarInputs();
        // validarInputs
        const containerCursos = $('#container_cursos')
        const btnAddCurso = $("#add_curso")
        const formCursos = $("#form_cursos")


        let cursoCounter = 1; // Inicializamos el contador en 1

        btnAddCurso.addEventListener('click', (event) => {
            event.preventDefault();

            // Incrementar el contador para el próximo curso
            cursoCounter++;
            // Generar un nuevo ID único para el curso
            let cursoId = `curso_${cursoCounter}`;


            // Crear el elemento div con el nuevo ID
            let divCurso = document.createElement('div');
            divCurso.setAttribute('id', cursoId);
            divCurso.className = 'grid grid-cols-2 gap-3 w-full border-[1px]';

            // Agregar el contenido al div
            divCurso.innerHTML = `
            <div class="col-span-2 flex justify-between px-2 w-full bg-blue-200">
                <h2 class="py-1 px-2">Curso ${cursoCounter}</h2>
                <button class="btnEliminarCurso text-red-500" data-curso-id="${cursoId}"><i class="bx bx-x-circle"></i></button>
            </div>
            <x-input-text text="Nombre" nombre="${cursoId}[nombre]" placeholder="nombre" required classLabel="text-base" mensaje="nombre"/>
            <x-input-text text="codigo" nombre="${cursoId}[codigo]" placeholder="codigo " classLabel="text-base" mensaje="codigo"/>
            <x-input-text type="date" text="Fecha inicio" nombre="${cursoId}[fecha_inicio]" placeholder="fecha_inicio " classLabel="text-base" mensaje="fecha_inicio" />
            <x-input-text type="date" text="Fecha Termino" nombre="${cursoId}[fecha_termino]" placeholder="fecha_termino" classLabel="text-base" mensaje="fecha_termino" />

            <x-selects.input-select textLabel="Modalidades" name="${cursoId}[modalidad_id]"
                        textOptionDefault="selecciona la modalidad" :modalidades="$modalidades" required mensaje="modalidad_id" />
                    <x-selects.input-select textLabel="tipo Curso" name="${cursoId}[tipo_id]"
                        textOptionDefault="selecciona tipo curso" :tipos="$tipos" required mensaje="tipo_id" />
                `;

            // Agregar el div al documento
            containerCursos.appendChild(divCurso);
            validarInputs();


            let btnEliminarCurso = divCurso.querySelector('.btnEliminarCurso');
            btnEliminarCurso.addEventListener('click', (event) => {
                let cursoId = event.target.parentElement.dataset.cursoId;
                let cursoElement = document.getElementById(cursoId);
                if (cursoElement) {
                    cursoElement.remove();
                }
            });
        });
    </script>

</x-app>
