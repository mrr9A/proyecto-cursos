<x-app>

    <div class="container mt-2 mx-3">
        <div class="row mb-12">
            <div class="col-lg-12 mb-6 mb-lg-0 position-relative">
                <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 items-center text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">BIENVENIDO ES MOMENTO DE EDITAR LA LECCION DEL CURSO</h2><br>
                    <h3 class="text-1xl font-bold tracking-tight text-dark-500 sm:text-2xl">En este apartado solo se Agregaran las Lecciones </h3><br>
                    <h5 class="text-1xl font-bold tracking-tight text-gray-600 sm:text-2"><span>Una vez creadas las Lecciones podrá agregar contenido en la pagina principal</span></h5>
                    <h5 class="text-1xl font-bold tracking-tight text-gray-600 sm:text-2"><span>Comencemos</span> ...</h5>
                </div>
                <br>
                <form action="{{url('Lecciones',[$leccion])}}" method="POST" class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="col-12">
                        <div class="col-12 mx-6">
                            <br>
                            <h3>Información General de la Lección</h3>
                            <br>
                            <input hidden type="text" rows="3" name="curso_id" value="{{$leccion->curso_id}}" require>
                            <div class="grid col-4">
                                <label for="nombre">Nombre de la Lección <span class="text-danger">*</span></label>
                                <input type="text" rows="3" name="nombre" value="{{$leccion->nombre}}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="fecha_inicio" require>
                                @error('nombre') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <br>
                            <div class="grid col-6 ">
                                <label for="descripcion">Descripcion de la Lección <span class="text-red-500">*</span></label>
                                <textarea type="text" rows="3" name="descripcion" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" require>{{$leccion->descripcion}}</textarea>
                                @error('descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <br>
                            <label for="cover-photo">Imagen de la Lección <span class="text-danger">*</span></label>
                            <div class="col-11 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25">
                                    <div class="text-center">
                                        <img src="../img/imagen.png" class="inline-block" alt="">
                                        <div class="mt-4 flex text-sm items-center text-center leading-6 text-gray-600">
                                            <label for="url_imagen" class="bg-gray-50 border items-center border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <span class="">Seleccionar una Imagen</span>
                                                <input id="url_imagen" name="url_imagen" type="file" class="sr-only" accept="image/*" require>
                                                @error('url_imagen') <span class="error">{{ $message }}</span> @enderror
                                            </label>
                                            <div class="text-center">
                                                <img src="{{$leccion->url_imagen}}" width="150" height="150" class="inline-block" alt="">
                                            </div>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">Formatos Admitidos: PNG, JPG</p>
                                    </div>
                                </div><br>
                            </div>
                            <br>
                            <div>
                                <div id="contenido" class="col-12"></div><br>
                            </div>
                            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button">
                                <!-- <img src="../img/cancelar.png" class="avatar" alt=""> -->
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                        <path fill="white" d="M12 9.059V6.5a1.001 1.001 0 0 0-1.707-.708L4 12l6.293 6.207a.997.997 0 0 0 1.414 0A.999.999 0 0 0 12 17.5v-2.489c2.75.068 5.755.566 8 3.989v-1c0-4.633-3.5-8.443-8-8.941z" />
                                    </svg>
                                </span>
                                <span>Retroceder</span>
                            </button>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
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
                </form>
                <br />

            </div>
        </div>
    </div>

</x-app>

