<x-app title="Editar Lección">
    <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 items-center text-center">
        <h2 class="text-subtitle font-bold tracking-tight text-gray-900">BIENVENIDO ES MOMENTO DE EDITAR LA LECCION DEL CURSO</h2>
        <h5 class="text-section-subtitle font-bold tracking-tight text-gray-600"><span>Una vez creadas las Lecciones podrá agregar contenido en la pagina principal</span></h5>
    </div>
    <br>
    <form action="{{url('Lecciones',[$leccion])}}" method="POST" class="w-full bg-white border border-gray-200 rounded-lg shadow md:p-8 dark:bg-gray-800 dark:border-gray-700" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="flex justify-between px-4 items-center overflow-auto gap-3 mb-5 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            <h3 class="font-bold">Información General:</h3>
            <div class="flex justify-end px-4">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path fill="white" d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A.999.999 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941z" />
                        </svg>
                    </span>
                    <span>Retroceder</span>
                </button>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <g fill="none" stroke="white" stroke-width="1.5">
                                <path d="M3 19V5a2 2 0 0 1 2-2h11.172a2 2 0 0 1 1.414.586l2.828 2.828A2 2 0 0 1 21 7.828V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z" />
                                <path d="M8.6 9h6.8a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6H8.6a.6.6 0 0 0-.6.6v4.8a.6.6 0 0 0 .6.6ZM6 13.6V21h12v-7.4a.6.6 0 0 0-.6-.6H6.6a.6.6 0 0 0-.6.6Z" />
                            </g>
                        </svg>
                    </span>
                    <span>Guardar</span>
                </button>
            </div>
        </div>
        <input hidden type="text" rows="3" name="curso_id" value="{{$leccion->curso_id}}" required>
        <div class="flex justify-between -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <div class="w-full px-3">
                    <label for="nombre" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nombre de la Lección <span class="text-red-700">*</span></label>
                    <input type="text" rows="3" name="nombre" value="{{$leccion->nombre}}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="fecha_inicio" required>
                    @error('nombre') <span class="error">{{ $message }}</span> @enderror
                </div><br>
                <div class="px-3">
                    <label for="descripcion" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descripcion de la Lección <span class="text-red-500">*</span></label>
                    <textarea rows="8" name="descripcion" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>{{$leccion->descripcion}}</textarea>
                    @error('descripcion') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label for="cover-photo" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Imagen de la Lección <span class="text-danger">*</span></label>
                <div class="col-11 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div class="mt-1 flex justify-center rounded-lg border border-dashed border-gray-900/25">
                        <div class="text-center">
                            <img src="../img/imagen.png" class="mt-8 inline-block" alt="">
                            <div class="mt-3 flex text-sm items-center text-center leading-6 text-gray-600">
                                <label for="url_imagen" class="bg-gray-50 border items-center border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <span class="">Seleccionar una Imagen</span>
                                    <input id="url_imagen" name="url_imagen" type="file" class="sr-only" accept="image/*">
                                    @error('url_imagen') <span class="error">{{ $message }}</span> @enderror
                                </label>
                            </div>
                            <div class="text-center mt-4">
                                <img src="{{$leccion->url_imagen}}" width="150" height="150" class="inline-block" alt="">
                            </div>
                            <p class="text-xs leading-5 text-gray-600 mt-1">Formatos Admitidos: PNG, JPG</p>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</x-app>

<script>
    const inputsTexts = $$("input[type='text']")
    inputsTexts.forEach(element => {
        element.addEventListener('keypress', (e) => {

            const charCode = e.which || e.keyCode;
            const char = String.fromCharCode(charCode);
            const pattern = /[a-zA-Z0-9\s\-+]/

            if (!pattern.test(char)) {
                e.preventDefault();
            }
        })

        element.addEventListener('input', function() {
            const maxLength = 45; // Define la longitud máxima permitida
            console.log('holas')
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength); // Limita la longitud del valor
            }
        });
    });
</script>