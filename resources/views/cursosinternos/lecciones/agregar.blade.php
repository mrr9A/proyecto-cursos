<x-app>

<div class="container mt-2 mx-3">
    <div class="row mb-12">
        <div class="col-lg-12 mb-6 mb-lg-0 position-relative">
            <div class="card p-5  text-center card">
                <div class="card-header card ">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">BIENVENIDO ES MOMENTO DE AGREGAR LAS LECCIONES AL CURSO</h2><br>
                    <h3 class="text-1xl font-bold tracking-tight text-dark-500 sm:text-2xl">En este apartado solo se Agregaran las Lecciones </h3><br>
                    <h5 class="text-1xl font-bold tracking-tight text-gray-600 sm:text-2"><span>Una vez creadas las Lecciones podrá agregar contenido en la pagina principal</span></h5>
                    <h5 class="text-1xl font-bold tracking-tight text-gray-600 sm:text-2"><span>Comencemos</span> ...</h5>
                </div>
            </div>
            <br>
            <form action="{{url('Lecciones')}}" method="POST" class="card" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="col-12 mx-6">
                        <br>
                        <h3>Información General de la Lección</h3>
                        <br>
                        <input hidden type="text" rows="3" name="curso_id" value="{{$id}}" require>
                        <div class="grid col-4">
                            <label for="nombre">Nombre de la Lección <span class="text-danger">*</span></label>
                            <input type="text" rows="3" name="nombre" class="block bg-blue-50 w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_inicio" require>
                            @error('nombre') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <br>
                        <div class="grid col-6 ">
                            <label for="descripcion">Descripcion de la Lección <span class="text-danger">*</span></label>
                            <textarea type="text" rows="3" name="descripcion" class="block bg-blue-50 w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_inicio" require></textarea>
                            @error('descripcion') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <br>
                        <label for="cover-photo">Imagen de la Lección <span class="text-danger">*</span></label>
                        <div class="col-11 bg-blue-50">
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25">
                                <div class="text-center">
                                    <img src="../img/imagen.png" class="avatar" alt="">
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <label for="url_imagen" class="bg-blue-50 relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span class="bg-blue-50">Seleccionar una Imagen</span>
                                            <input id="url_imagen" name="url_imagen" type="file" class="sr-only" accept="image/*" require>
                                            @error('url_imagen') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">Formatos Admitidos: PNG, JPG</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <div id="contenido" class="col-12"></div><br>
                        </div>
                        <button class="btn btn-danger nextBtn btn-lg bg-dark" type="button">
                            <img src="../img/cancelar.png" class="avatar" alt=""><span>Eliminar</span>
                        </button>
                        <button class="btn btn-primary nextBtn btn-lg bg-dark">
                            <img src="../img/guardar.png" class="avatar" alt=""><span>Guardar</span>
                        </button>
                    </div>
                </div>
            </form>
            <br />

        </div>
    </div>
</div>

</x-app>
