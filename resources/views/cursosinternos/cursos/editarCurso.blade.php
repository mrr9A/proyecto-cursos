                <form class="space-y-6" action="{{url('curs',$curso)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del curso</label>
                        <input type="text" id="nombre" name="nombre" value="{{$curso->nombre}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Codígo del curso</label>
                        <input type="text" id="codigo" name="codigo" value="{{$curso->codigo}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                        @error('codigo') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estatus del curso: </label>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                <input id="bordered-checkbox-1" type="radio" name="estado" value="1" {{{ $curso->estado == '1' ? "checked" : "" }}} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="bordered-checkbox-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Curso activo</label>
                            </div>
                            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                <input id="bordered-checkbox-1" type="radio" name="estado" value="0" {{{ $curso->estado == '0' ? "checked" : "" }}} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="bordered-checkbox-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Curso inactivo</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modalidad del curso:</label>
                        <select id="countries" name="modalidad_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($modalidad as $modi)
                            <option value="{{$modi->id_modalidad}}" {{{ $curso->modalidad_id == $modi->id_modalidad ? "selected" : "" }}}>{{$modi->modalidad}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo del curso:</label>
                        <select id="countries" name="tipo_curso_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($tipo as $tip)
                            <option value="{{$tip->id_tipo_curso}}" {{{ $curso->tipo_curso_id == $tip->id_tipo_curso ? "selected" : "" }}}>{{$tip->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">categoría del Curso:</label>
                        <select id="countries" name="categoria_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            @foreach ($categoria as $categori)
                            <option value="{{$categori->id_categoria}}" {{{ $curso->categoria[0]->id_categoria == $categori->id_categoria ? "selected" : "" }}}>{{$categori->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagen del curso</label>
                        <img src="{{$curso->imagen}}" width="150" height="150" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        <input type="file" id="imagen" accept="image/*" name="imagen" value="{{$curso->imagen}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <button class="w-full text-white bg-blue-700 hover:bg-dark-800 focus:ring-4 focus:outline-none focus:ring-dark-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-dark-900 dark:hover:bg-dark-700 dark:focus:ring-dark-800">
                        <span class="inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M3 5.75A2.75 2.75 0 0 1 5.75 3h9.964a3.25 3.25 0 0 1 2.299.952l2.035 2.035c.61.61.952 1.437.952 2.299v3.736a6.471 6.471 0 0 0-1.5-.709V8.287c0-.465-.184-.91-.513-1.238l-2.035-2.035a1.75 1.75 0 0 0-.952-.49V7.25a2.25 2.25 0 0 1-2.25 2.25h-4.5A2.25 2.25 0 0 1 7 7.25V4.5H5.75c-.69 0-1.25.56-1.25 1.25v12.5c0 .69.56 1.25 1.25 1.25H6v-5.25A2.25 2.25 0 0 1 8.25 12h5.784a6.534 6.534 0 0 0-1.658 1.5H8.25a.75.75 0 0 0-.75.75v5.25h3.813c.173.534.412 1.037.709 1.5H5.75A2.75 2.75 0 0 1 3 18.25V5.75ZM8.5 4.5v2.75c0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75V4.5h-6Zm14.5 13a5.5 5.5 0 1 1-11 0a5.5 5.5 0 0 1 11 0Zm-8.5-.5a.5.5 0 0 0 0 1h4.793l-1.647 1.646a.5.5 0 0 0 .708.708l2.5-2.5a.5.5 0 0 0 0-.708l-2.5-2.5a.5.5 0 0 0-.708.708L19.293 17H14.5Z" />
                            </svg>
                            Guardar
                        </span>
                    </button>
                </form>


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