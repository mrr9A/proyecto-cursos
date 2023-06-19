<x-app>
<div class="container mt-2 mx-3">
    <div class="row mb-12">
        <div class="col-lg-12 mb-6 mb-lg-0 position-relative">
            <div class="card p-5  text-center">
                <div class="card-header">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">BIENVENIDO ES MOMENTO DE AGREGAR CONTENIDO AL CURSO</h2><br>
                    <h3 class="text-1xl font-bold tracking-tight text-dark-500 sm:text-2xl">En este apartado se agregará el contenido</h3><br>
                    <h5 class="text-1xl font-bold tracking-tight text-gray-600 sm:text-2"><span>Siga los Pasos para crear corectamente el contenido</span></h5>
                    <h5 class="text-1xl font-bold tracking-tight text-gray-600 sm:text-2"><span>Comencemos</span> ...</h5>
                </div>
            </div>
            <br>
            <form action="{{url('contenidos')}}" method="POST" class="card" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="col-12 mx-6">
                        <br>
                        <h3>Información General del Contenido</h3>
                        <br>
                        <input hidden type="text" rows="3" name="leccion_id" value="{{$id}}" required>
                        <div class="grid col-4">
                            <label for="nombre">Nombre del Contenido <span class="text-danger">*</span></label>
                            <input type="text" rows="3" name="nombre" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_inicio" required>
                            @error('nombre') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <br>
                        <div class="grid col-11 ">
                            <label for="descripcion">Descripcion del Contenido <span class="text-danger">*</span></label>
                            <textarea type="text" rows="3" name="descripcion" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_inicio" required></textarea>
                            @error('descripcion') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <br>
                        <div class="col-11">
                            <label for="cover-photo">Archivo del Contenido <span class="text-danger">*</span></label>
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25">
                                <div class="text-center">
                                    <img src="../img/imagen.png" class="avatar" alt="">
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600" enctype="multipart/form-data">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Seleccionar un Archivo </span><span class="text-danger">*</span>
                                            <input id="file-upload" name="url" type="file" class="sr-only" accept="/*" required>
                                            @error('url_imagen') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">Formatos Admitidos: PNG, JPG, MP4 ...</p>
                                </div>
                            </div>
                        </div>
                        <br>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('agregado') == 'Agregado Correctamente')
<script>
    Swal.fire(
        'Contenido Agregado Correctamente!!!',
        'Para agregar el examen del contenido regrese ala pagina principal',
        'success'
    )
</script>
@endif
