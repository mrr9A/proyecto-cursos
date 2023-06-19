<x-ap>
<form action="{{url('examenes')}}" method="POST" class="card col-11 mx-6">
    @csrf
    <div class="col-11">
        <div class="col-11 mx-6">
            <br>
            <h3>Información General del Contenido</h3>
            <br>
            <input hidden type="text" rows="3" name="contenido_id" value="{{$id}}" require>
            <div class="grid col-4">
                <label for="titulo" class="block mb-2 text-sm font text-gray-900 dark:text-white">Título del examen: <span class="text-danger">*</span></label>
                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="nombre" id="titulo" required>
            </div>
            <br>
            <h3 for="preguntas">Preguntas:</h3><br>
            <div class="grid col-11 " id="preguntas" name="preguntas">
                <div class="pregunta">
                    <label for="pregunta1" class="block mb-2 text-sm font text-gray-900 dark:text-white">Pregunta 1: <span class="text-danger">*</span></label>
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="preguntas[pregunta1]" id="pregunta" required>
                    <br>
                    <label for="opciones1" class="block mb-2 text-sm font text-gray-900 dark:text-white">Opciones: <span class="text-danger">*</span></label>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <input type="text" name="preguntas[opciones][]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 1" required>
                        <input type="text" name="preguntas[opciones][]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 2" required>
                        <input type="text" name="preguntas[opciones][]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 3" required>
                        <input type="text" name="preguntas[opciones][]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Opción 4" required>
                    </div>
                    <div class="grid col-4">
                    <label for="respuesta1" class="block mb-2 text-sm font text-gray-900 dark:text-white">Respuesta correcta: <span class="text-danger">*</span></label>
                    <select name="preguntas[respuesta1]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
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
    <button class="btn bg-blue-300 text-dark" id="agregarPregunta">Agregar pregunta</button>
    <br>

    <button type="submit" class="btn bg-dark text-white">Crear examen</button>
</form>

</x-ap>

<script>
    // JavaScript para agregar preguntas dinámicamente
    let contadorPreguntas = 2; // Inicializar contador

    document.getElementById('agregarPregunta').addEventListener('click', function() {
        let preguntasDiv = document.getElementById('preguntas');

        let nuevaPregunta = document.createElement('div');
        nuevaPregunta.classList.add('pregunta');
        nuevaPregunta.innerHTML = `
            <label class=" block mb-2 text-sm font text-gray-900 dark:text-white" for="pregunta${contadorPreguntas}">Pregunta ${contadorPreguntas}: <span class="text-danger">*</span></label>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="preguntas[pregunta${contadorPreguntas}]" id="pregunta${contadorPreguntas}" required>
            <br>
            <label class="block mb-2 text-sm font text-gray-900 dark:text-white" for="opciones${contadorPreguntas}">Opciones: <span class="text-danger">*</span></label>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="preguntas[opciones${contadorPreguntas}][]" placeholder="Opción 1" required>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="preguntas[opciones${contadorPreguntas}][]" placeholder="Opción 2" required>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="preguntas[opciones${contadorPreguntas}][]" placeholder="Opción 3" required>
            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="preguntas[opciones${contadorPreguntas}][]" placeholder="Opción 4" required>
            </div>
            <div class="grid col-4">
            <label class="block mb-2 text-sm font text-gray-900 dark:text-white" for="respuesta${contadorPreguntas}">Respuesta correcta: <span class="text-danger">*</span></label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="preguntas[respuesta${contadorPreguntas}]" required>
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