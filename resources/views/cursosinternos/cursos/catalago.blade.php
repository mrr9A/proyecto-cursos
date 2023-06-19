<x-app>

<div>
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
        <a class="btn btn-dark" href="{{route('crearCurso')}}">
            <img src="./img/agregar-usuario.png" alt=""><span>Agregar Curso</span>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Cursos</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-striped">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-center text-xs text-dark font-weight-bolder opacity-7">Imagen</th>
                            <th class="text-uppercase text-secondary text-center text-xs text-dark font-weight-bolder opacity-7">Nombre Completo del Curso</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4 col-6">Codígo del Curso</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Fecha de Inicio</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Fecha de Termino</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Interno / Planta</th>
                            <th class="text-center text-uppercase text-center text-dark text-secondary text-xs font-weight-bolder opacity-7 col-3">Configuración</th>
                            <th class="text-center text-uppercase text-center text-dark text-secondary text-xs font-weight-bolder opacity-7 col-3">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($cursos as $curso)
                        <tr>
                            <td class="text-center">
                                <img src="{{$curso->imagen}}" width="100" height="100">
                            </td>
                            <td class="text-center text-dark col-3">{{$curso->nombre}}</td>
                            <td class="text-center text-dark textarea">{{$curso->codigo}}</td>
                            <td class="text-center text-dark">{{$curso->fecha_inicio}}</td>
                            <td class="text-center text-dark">{{$curso->fecha_termino}}</td>
                            <td class="text-center text-dark">
                                @if ($curso->interno_planta == 1)
                                <span class="badge badge-sm bg-gradient-secondary">Planta</span>
                                @elseif($curso->interno_planta == 0)
                                <span class="badge badge-sm bg-gradient-dark">Interno</span>
                                @endif
                            </td>
                            <td class="text-center text-dark">
                                <a href="{{url('cursos',[$curso])}}" class="btn">
                                    <img src="./img/mechanical.png" alt="">
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ url('cursos',[$curso]) }}" method="POST" class="formulario-eliminar" id="{{$curso->nombre}}">

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
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        {{$cursos->links()}}
                    </div>
                </div>
            </div>
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
        'Agregado Correctamente!',
        'Terminalo de Configurar en el apartado de configuraciones de los Cursos!!!!',
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
                title: 'Estas Seguro de Eliminar este Curso',
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