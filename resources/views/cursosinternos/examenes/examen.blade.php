<x-app>
    <form action="{{url('examenes')}}" method="POST" class="card col-11 mx-6">
        @csrf
        <div class="col-11">
            <div class="col-11 mx-6">
                <br>
                <h3 class="font-semi-bold">Información General del Contenido</h3>
                <br>
                <input hidden type="text" rows="3" name="contenido_id" value="{{$id}}" required>
                <div class="grid col-4">
                    <label for="titulo" class="block mb-2 font-bold text-gray-900 dark:text-white">Título del examen: <span class="text-red-500">*</span></label>
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="nombre" id="titulo" required>
                </div><br>
                <div class="grid col-4">
                    <label for="duracion" class="block mb-2 font-bold text-gray-900 dark:text-white">Duración del examen: <span class="text-red-500">*</span></label>
                    <input type="number" min="0" max="60" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="duracion" id="duracion" required>
                </div>
                <br>
                <h3 for="preguntas" class="font-semi-bold">Preguntas:</h3><br>
                <div class="grid col-11 " id="preguntas" name="preguntas">
                    <div class="pregunta">
                        <label for="pregunta1" class="block mb-2  font-bold text-gray-900 dark:text-white">Pregunta 1: <span class="text-red-500">*</span></label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="arreglo[pregunta1][]" id="pregunta" required>
                        <br>
                        <label for="opciones1" class="block mb-2 font-semi-bold">Opciones: <span class="text-red-500">*</span></label>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div class="flex items-center rounded">
                                <input type="text" name="arreglo[pregunta1][opciones][]" class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 1 *" required>
                            </div>
                            <div class="flex items-center rounded">
                                <input type="text" name="arreglo[pregunta1][opciones][]" class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 2 *" required>
                            </div>
                            <div class="flex items-center rounded">
                                <input type="text" name="arreglo[pregunta1][opciones][]" class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 3 *" required>
                            </div>
                            <div class="flex items-center rounded">
                                <input type="text" name="arreglo[pregunta1][opciones][]" class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 4 *" required>
                            </div>
                        </div>
                        <div class="grid col-4">
                            <label for="respuesta1" class="block mb-2 font-bold text-gray-900 dark:text-white">Respuesta correcta: <span class="text-red-500">*</span></label>
                            <select name="arreglo[pregunta1][respuesta]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="0">Opción 1</option>
                                <option value="1">Opción 2</option>
                                <option value="2">Opción 3</option>
                                <option value="3">Opción 4</option>
                            </select>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="items-start">
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" id="agregarPregunta">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 48 48">
                        <mask id="ipSAddOne0">
                            <g fill="none" stroke-linejoin="round" stroke-width="4">
                                <path fill="#fff" stroke="#fff" d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z" />
                                <path stroke="#000" stroke-linecap="round" d="M24 16v16m-8-8h16" />
                            </g>
                        </mask>
                        <path fill="white" d="M0 0h48v48H0z" mask="url(#ipSAddOne0)" />
                    </svg>
                </span>
                <span>Agregar Pregunta</span>
            </button>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 48 48">
                        <g fill="white">
                            <path d="M20 15a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Zm-1 10a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Z" />
                            <path fill-rule="evenodd" d="M10 27a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-5Zm2 1v3h3v-3h-3Z" clip-rule="evenodd" />
                            <path d="M17.707 15.707a1 1 0 0 0-1.414-1.414L13 17.586l-1.293-1.293a1 1 0 0 0-1.414 1.414L13 20.414l4.707-4.707Z" />
                            <path fill-rule="evenodd" d="M10 6a4 4 0 0 0-4 4v28a4 4 0 0 0 4 4h20a4 4 0 0 0 4-4V10a4 4 0 0 0-4-4H10Zm-2 4a2 2 0 0 1 2-2h20a2 2 0 0 1 2 2v28a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2V10Zm28 6a3 3 0 1 1 6 0v20.303l-3 4.5l-3-4.5V16Zm3-1a1 1 0 0 0-1 1v2h2v-2a1 1 0 0 0-1-1Zm0 22.197l-1-1.5V20h2v15.697l-1 1.5Z" clip-rule="evenodd" />
                        </g>
                    </svg>
                </span>
                <span>
                    Crear examen
                </span>
            </button>
        </div>
    </form>

</x-app>

<script>
    // JavaScript para agregar preguntas dinámicamente
    let contadorPreguntas = 2; // Inicializar contador

    document.getElementById('agregarPregunta').addEventListener('click', function() {
        let preguntasDiv = document.getElementById('preguntas');

        let nuevaPregunta = document.createElement('div');
        nuevaPregunta.classList.add('pregunta');
        nuevaPregunta.innerHTML = `
            <label class=" block mb-2  font-bold text-gray-900 dark:text-white" for="pregunta${contadorPreguntas}">Pregunta ${contadorPreguntas}: <span class="text-red-500">*</span></label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="arreglo[pregunta${contadorPreguntas}][]" id="pregunta${contadorPreguntas}" required>
            <br>
            <label class="block mb-2  font-bold text-gray-900 dark:text-white" for="opciones${contadorPreguntas}">Opciones: <span class="text-red-500">*</span></label>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="arreglo[pregunta${contadorPreguntas}][opciones][]" placeholder="Opción 1 *" required>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="arreglo[pregunta${contadorPreguntas}][opciones][]" placeholder="Opción 2 *" required>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="arreglo[pregunta${contadorPreguntas}][opciones][]" placeholder="Opción 3 *" required>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="arreglo[pregunta${contadorPreguntas}][opciones][]" placeholder="Opción 4 *" required>
            </div>
            <div class="grid col-4">
            <label class="block mb-2 font-bold text-gray-900 dark:text-white" for="respuesta">Respuesta correcta: <span class="text-red-500">*</span></label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="arreglo[pregunta${contadorPreguntas}][respuesta]" required>
                <option value="0">Opción 1</option>
                <option value="1">Opción 2</option>
                <option value="2">Opción 3</option>
                <option value="3">Opción 4</option>
            </select>
            </div>
            <br/>
        `;

        preguntasDiv.appendChild(nuevaPregunta);
        contadorPreguntas++;
    });
</script>