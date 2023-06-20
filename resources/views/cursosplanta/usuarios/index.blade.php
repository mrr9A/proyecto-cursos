<x-app>
  <!-- <div>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-4 shadow-none border-radius-xl loopple-navbar-empty" id="navbarTop">
    <div class="navbar-add" data-toggle="modal" data-target="#navbarModal">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid pt-3">
    <div>
    <a href="{{route('usuarios.create')}}" class="btn btn-dark">
            <img src="./img/agregar-usuario.png" alt=""><span>Agregar Usuario</span>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Usuarios</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-striped table-responsive">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-center text-xs text-dark font-weight-bolder opacity-7">Avatar</th>
                            <th class="text-uppercase text-secondary text-center text-xs text-dark font-weight-bolder opacity-7">Nombre Completo / Correo</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Rol en la Empresa</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Sucursal</th>
                            <th class="text-uppercase text-secondary text-center text-dark text-xs font-weight-bolder opacity-7 ps-4">Puesto</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Estatus</th>
                            <th class="text-center text-uppercase text-center text-dark text-secondary text-xs font-weight-bolder opacity-7">Editar</th>
                            <th class="text-center text-uppercase text-center text-dark text-secondary text-xs font-weight-bolder opacity-7">Eliminar / Desactivar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="text-center">
                                <img src="./img/perfil.png" class="avatar">
                            </td>
                            <td class="text-center text-dark">{{$usuario->nombre}} {{$usuario->segundo_nombre}} {{$usuario->apellido_paterno}} {{$usuario->apellido_materno}}
                                <p class="text-x text-secondary mb-0">{{$usuario->email}}</p>
                            </td>
                            <td class="text-center text-dark">
                                @if ($usuario->rol == 0)
                                <span>Administrador</span>
                                @elseif ($usuario->rol == 1)
                                <span>Empleado</span>
                                @endif
                            </td>
                            <td class="text-center text-dark">
                            </td>
                            <td class="text-center text-dark">{{$usuario->puestos->puesto}}</td>
                            <td class="text-center text-dark">
                                @if ($usuario->estado == 1)
                                <span class="badge badge-sm bg-gradient-success">Activo</span>
                                @else
                                <span class="badge badge-sm bg-gradient-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center text-dark">
                                <a href="{{ url('usuarios',[$usuario]) }}" class="btn">
                                    <img src="./img/editar.png" alt="">
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ url('usuarios',[$usuario]) }}" method="POST" class="formulario-eliminar" id="{{$usuario->nombre}}">

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
                        {{$usuarios->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div> -->

  <!-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="text-uppercase text-secondary text-center text-xs text-dark font-weight-bolder opacity-7">
            Avatar
          </th>
          <th scope="col" class="px-6 py-3">
            <div class="flex items-center">
              Nombre Completo / Correo
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                  <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                </svg></a>
            </div>
          </th>
          <th scope="col" class="px-6 py-3">
            <div class="flex items-center">
              Rol en la Empresa
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                  <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                </svg></a>
            </div>
          </th>
          <th scope="col" class="px-6 py-3">
            <div class="flex items-center">
              Sucursal
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                  <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                </svg></a>
            </div>
          </th>
          <th scope="col" class="px-6 py-3">
            <div class="flex items-center">
              Puesto
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                  <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                </svg></a>
            </div>
          </th>
          <th scope="col" class="px-6 py-3">
            <div class="flex items-center">
              Puesto
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                  <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                </svg></a>
            </div>
          </th>
          <th scope="col" class="px-6 py-3">
            <div class="flex items-center">
              Opciones
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                  <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                </svg></a>
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $usuario)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
          <td class="px-6 py-4 text-right">
            <img src="./img/perfil.png" class="avatar">
          </td>
          <td class="px-6 py-4 text-right">
          <p class="text-x text-secondary mb-0">{{$usuario->email}}</p>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div> -->



          <div>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-4 shadow-none border-radius-xl loopple-navbar-empty" id="navbarTop">
    <div class="navbar-add" data-toggle="modal" data-target="#navbarModal">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid pt-3">
    <div>
    <a href="{{route('usuarios.create')}}" class="btn btn-dark">
            <img src="./img/agregar-usuario.png" alt=""><span>Agregar Usuario</span>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Usuarios</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                
  <table class="min-w-full text-center text-sm font-light">
          <thead class="border-b  dark:border-neutral-500">
            <tr>
              <th scope="col" class="px-6 py-2">#</th>
              <th scope="col" class="px-6 py-2">First</th>
              <th scope="col" class="px-6 py-2">Last</th>
              <th scope="col" class="px-6 py-2">Handle</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b dark:border-neutral-500">
              <td class="whitespace-nowrap px-6 py-2 ">1</td>
              <td class="whitespace-nowrap px-6 py-2">Mark</td>
              <td class="whitespace-nowrap px-6 py-2">Otto</td>
              <td class="whitespace-nowrap px-6 py-2">@mdo</td>
            </tr>
            <tr class="border-b dark:border-neutral-500">
              <td class="whitespace-nowrap px-6 py-2 ">2</td>
              <td class="whitespace-nowrap px-6 py-2 ">Jacob</td>
              <td class="whitespace-nowrap px-6 py-2">Thornton</td>
              <td class="whitespace-nowrap px-6 py-2">@fat</td>
            </tr>
            <tr class="border-b dark:border-neutral-500">
              <td class="whitespace-nowrap px-6 py-2 ">3</td>
              <td colspan="2" class="whitespace-nowrap px-6 py-2">
                Larry the Bird
              </td>
              <td class="whitespace-nowrap px-6 py-2">@twitter</td>
            </tr>
          </tbody>
        </table>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        {{$usuarios->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app>