<x-app>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h6 class="mb-0">{{ __('Actualizar Sucursal') }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('sucursales',[$sucursale])}}" method="POST" class="formulario-actualizar">
                @csrf
                @method("PUT")
                <h6 class="heading-small text-muted mb-4">Datos Generales</h6>
                <div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="nombres">Nombre de la Sucursal</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Wolkswagen" value="{{$sucursale->nombre}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="apellidos">Dirección donde se localiza la Sucursal</label>
                                <input type="text" id="direccion" name="ciudad" class="form-control" placeholder="Plaza del Valle" value="{{$sucursale->ciudad}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Estatus de la Sucursal</label><br />
                            <label class="radio-inline"><input type="radio" name="estado" value="1" {{{ $sucursale->estado == '1' ? "checked" : "" }}}>Sucursal Activa</label>
                            <label class="radio-inline"><input type="radio" name="estado" value="0" {{{ $sucursale->estado == '0' ? "checked" : "" }}}>Sucursal Inactiva</label>
                            @error('stestadoatus') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <br>
                    <a href="{{url('sucursales')}}" class=" text-end btn btn-sm mb-0 btn-dark">
                        <img src="../img/cancelar.png" alt=""> <span>Volver</span>
                    </a>
                    <button type="submit" class=" text-end btn btn-sm mb-0 bg-dark">
                        <img src="../img/guardar.png" alt=""> <span class="text-white">Guardar</span>
                    </button>
            </form>
        </div>
</x-app>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const forms = document.querySelectorAll(".formulario-actualizar")

    forms.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas Seguro de Actualizar esta Sucursal',
                text: "Se actualizarán los Datos Seleccionados",
                icon: 'dark',
                showCancelButton: true,
                confirmButtonColor: '#3e5f8a',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado Correctamente',
                        'error'
                    )
                }
            })
        });
    })
</script>