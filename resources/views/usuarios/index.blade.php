<x-app title="Usuarios">
    <div class="container-fluid pt-3">
        <div>
            <a href="{{ route('usuarios.create') }}" class="btn btn-dark">
                <img src="./img/agregar-usuario.png" alt=""><span>Agregar Usuario</span>
            </a>
        </div>
        <div class="card mb-4">
            <h2 class="font-semi-bold text-section-subtitle">Lista de usuarios</h2>
            <div class="card-body">
                <table class="min-w-full text-center  font-light">
                    <thead class="border-b  dark:border-neutral-500 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-2 w-1/12">ID SGP</th>
                            <th scope="col" class="px-6 py-2">ID SUMTOTAL</th>
                            <th scope="col" class="px-6 py-2">nombre</th>
                            <th scope="col" class="px-6 py-2">puesto</th>
                            <th scope="col" class="px-6 py-2">estado</th>
                            <th scope="col" class="px-6 py-2">opciones</th>
                        </tr>
                    </thead>
                    <tbody class="capitalize">
                        @foreach ($usuarios as $usuario)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                                <td class="whitespace-nowrap px-6 py-2">{{ $usuario->id_sumtotal }}</td>
                                <td class="whitespace-nowrap px-6 py-2">{{ $usuario->nombre }}
                                    {{ $usuario->segundo_nombre }} {{ $usuario->apellido_paterno }}
                                    {{ $usuario->apellido_materno }}</td>
                                <td class="whitespace-nowrap px-6 py-2">{{ $usuario->puestos->puesto }}</td>
                                <td class="whitespace-nowrap px-6 py-2">
                                    <div class="w-4 h-4 rounded-full @if($usuario->estado == 1) bg-success @else bg-gray-400 @endif"></div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-2 flex gap-2 justify-center">
                                    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}">
                                        <img src="/svg/edit.svg" />
                                    </a>
                                    <button data-modal-target="usuario-{{ $usuario->id_usuario }}"
                                        data-modal-toggle="usuario-{{ $usuario->id_usuario }}">
                                        <img src="/svg/delete.svg" />
                                    </button>
                                    <x-modals.alert-modal id="usuario-{{ $usuario->id_usuario }}" route="usuarios.destroy"  :parametroDeRoute="$usuario->id_usuario" title="Esta seguro de eliminar al usuario" message="El usuario {{ $usuario->nombre }}
                                        {{ $usuario->segundo_nombre }} {{ $usuario->apellido_paterno }}
                                        {{ $usuario->apellido_materno }} sera eliminado"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$usuarios->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app>
