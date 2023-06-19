<x-app>

<!-- <h5>Todos los usuarios</h5> -->
<!-- Cuerpo de nuestro buscador -->

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-3 shadow-none border-radius-xl loopple-navbar-empty" id="navbarTop">
    <div class="navbar-add" data-toggle="modal" data-target="#navbarModal">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
        </div>
    </div>
</nav>
<!-- cuerpo de nuestras tablas -->
<div class="container-fluid pt-3">
    <div>
        <button class="btn btn-dark" data-op="1" data-bs-toggle="modal" data-bs-target="#modalSucursales">
            <img src="./img/agregar.png" alt=""><span>Agregar Sucursal</span>
        </button>
    </div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Sucursales</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-striped">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-center text-xs text-dark font-weight-bolder opacity-7">Avatar</th>
                            <th class="text-uppercase text-secondary text-center text-xs text-dark font-weight-bolder opacity-7">Nombre de la Sucursal</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Dirección</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Estatus</th>
                            <th class="text-center text-uppercase text-center text-dark text-secondary text-xs font-weight-bolder opacity-7">Editar</th>
                            <th class="text-center text-uppercase text-center text-dark text-secondary text-xs font-weight-bolder opacity-7">Eliminar/Desactivar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($sucursales as $sucursal)
                        <tr>
                            <td class="text-center">
                                <img src="./img/edificio-de-oficinas.png" class="avatar">
                            </td>
                            <td class="text-center text-dark">{{$sucursal->nombre}}</td>
                            <td class="text-center text-dark">{{$sucursal->ciudad}}</td>
                            <td class="text-center text-dark">
                            @if ($sucursal->estado == 1)
                                <span class="badge badge-sm bg-gradient-success">Sucursal Activa</span>
                                @elseif ($sucursal->estado == 0)
                                <span class="badge badge-sm bg-gradient-secondary">Sucursal Inactiva</span>
                                @endif
                            </td>
                            <td class="text-center text-dark">
                                <a href="{{ url('sucursales',[$sucursal]) }}" class="btn">
                                    <img src="./img/editar.png" alt="">
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ url('sucursales',[$sucursal]) }}" method="POST" class="formulario-eliminar" id="{{$sucursal->nombre}}">

                                    @method("DELETE")
                                    @csrf

                                    <button type="submit" class="btn text-center">
                                        <img src="./img/eliminar.png" alt="">
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="modalSucursales" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nueva Sucursal</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('sucursales')}}" method="POST">
                    @csrf
                    <h6 class="heading-small text-muted mb-4">Datos Generales</h6>
                    <div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="nombres">Nombre de la Sucursal</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Wolkswagen" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="apellidos">Dirección donde se localiza la Sucursal</label>
                                    <textarea type="text" id="direccion" name="ciudad" class="form-control" placeholder="Dirección" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="description">Estatus de la Sucursal</label><br />
                            <label class="radio-inline"><input type="radio" name="estado" value="1"> Sucursal Activa</label>
                            <label class="radio-inline"><input type="radio" name="estado" value="0" > Sucursal Inactiva</label>
                            @error('stestadoatus') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        </div>
                    </div>
                    <br>
                    <div class="">
                        <button type="button" id="btnCerrar" class="btn bg-dark" data-bs-dismiss="modal">
                            <img src="./img/cancelar.png" alt=""> <span>Volver</span>
                        </button>
                        <button class="btn btn-dark">
                            <img src="./img/guardar.png" alt=""><span>Guardar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('eliminado') == 'Eliminado Correctamente')
<script>
    Swal.fire(
        'Eliminado!',
        'Eliminado Correctamente',
        'success'
    )
</script>
@endif

@if (session('actualizado') == 'Actualizado Correctamente')
<script>
    Swal.fire(
        'Actualizado!',
        'Actualizado Correctamente',
        'success'
    )
</script>
@endif

@if (session('agregado') == 'Agregado Correctamente')
<script>
    Swal.fire(
        'Agregado!',
        'Agregado Correctamente',
        'success'
    )
</script>
@endif

<script>
    const forms = document.querySelectorAll(".formulario-eliminar")

    forms.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas Seguro de Eliminar esta Sucursal',
                text: "Si lo Eliminas no lo podras Recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Eliminar',
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