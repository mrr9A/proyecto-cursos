<x-app title="Crear curso">
    <div>
        <div>
            <form id="form_cursos" action="{{ route('cursos.store') }}" method="POST" class="space-y-2">
                @method('POST')
                @csrf

                <div class="flex gap-2 ">
                    <div>
                        <h2>Selecciona trabajos a los cuales deseas asignar los cursos a crear</h2>
                        @foreach ($trabajos as $trabajo)
                            <div class="flex gap-2 items-center">
                                <input type="checkbox" value="{{ $trabajo->id_trabajo }}" name="trabajos[]" />
                                <label for="trabajos[]" >{{ $trabajo->nombre }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <button id="add_curso" class="bg-blue-400 py-1.5 px-2 rounded-md hover:bg-primary text-white">
                            <i class='bx bx-close '></i>
                            <span>Añadir otro curso</span>
                        </button>
                        <div id="container_cursos" class="grid grid-cols-3 w-full gap-3 sm:grid-cols-2">
                            <div id="curso_1" class="grid grid-cols-2 gap-3 w-full border-[1px]">
                                <h2 class="col-span-2 py-1 px-2 bg-blue-200">Curso 1</h2>
                                <x-input-text text="Nombre" nombre="cursos[curso_1][nombre]" placeholder="nombre" required
                                    classLabel="text-base" mensaje="nombre" />
                                <x-input-text text="codigo" nombre="cursos[curso_1][codigo]" placeholder="codigo "
                                    classLabel="text-base" mensaje="codigo" id="codigo" />
                                <x-selects.input-select textLabel="Modalidades" name="cursos[curso_1][modalidad_id]"
                                    textOptionDefault="selecciona la modalidad" :modalidades="$modalidades" required
                                    mensaje="modalidad_id" />
                                <x-selects.input-select textLabel="tipo Curso" name="cursos[curso_1][tipo_id]"
                                    textOptionDefault="selecciona tipo curso" :tipos="$tipos" required
                                    mensaje="tipo_id" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-2">
                    <x-input-submit text="crear" class="w-full" />

                </div>
            </form>
        </div>
    </div>
    <script>
        function validarInputs() {
            const inputsTexts = $$("input[type='text']")
            inputsTexts.forEach(element => {
                element.addEventListener('keypress', (e) => {

                    const charCode = e.which || e.keyCode;
                    const char = String.fromCharCode(charCode);
                    let pattern = /[a-zA-Z0-9\s]/;
                    if (e.target.id === 'codigo') {
                        pattern = /[a-zA-Z0-9\s\-]/
                    }
                    if (!pattern.test(char)) {
                        e.preventDefault();
                    }
                })

                element.addEventListener('input', function(e) {
                    let maxLength = 70; // Define la longitud máxima permitida
                    if (e.target.id === 'codigo') {
                        maxLength = 12
                    }
                    if (element.value.length > maxLength) {
                        element.value = element.value.slice(0, maxLength); // Limita la longitud del valor
                    }
                });
            });

        }
        validarInputs()
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
            <x-input-text text="Nombre" nombre="cursos[${cursoId}][nombre]" placeholder="nombre" required classLabel="text-base" mensaje="nombre"/>
            <x-input-text text="codigo" nombre="cursos[${cursoId}][codigo]" placeholder="codigo " classLabel="text-base" mensaje="codigo" id="codigo"/>
            <x-selects.input-select textLabel="Modalidades" name="cursos[${cursoId}][modalidad_id]"
                        textOptionDefault="selecciona la modalidad" :modalidades="$modalidades" required mensaje="modalidad_id" />
                    <x-selects.input-select textLabel="tipo Curso" name="cursos[${cursoId}][tipo_id]"
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
