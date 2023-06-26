<x-app title="Usuarios">
    <div class="card mb-4">

        <div class="flex items-center justify-between ">
            <div>
                <h2 class="text-gray-600 font-semibold">Lista de usuarios</h2>
                <span class="text-xs">usuarios activos y inactivos</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex bg-gray-50 items-center p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                    <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id=""
                        placeholder="search...">
                </div>
                <div class="lg:ml-40 ml-10 space-x-8">
                    <a href="{{ route('usuarios.create') }}"
                        class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Agregar
                        usuario</a>
                </div>
            </div>
        </div>


        <div class="card-body">
            <table class="min-w-full leading-normal my-2">
                <thead class="border-b  dark:border-neutral-500 uppercase">
                    <tr
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
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
                        <tr class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-left">
                            <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">{{ $usuario->id_sumtotal }}</td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">{{ $usuario->nombre }}
                                {{ $usuario->segundo_nombre }} {{ $usuario->apellido_paterno }}
                                {{ $usuario->apellido_materno }}</td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">{{ $usuario->puestos->puesto }}</td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                <div
                                    class="w-4 h-4 rounded-full @if ($usuario->estado == 1) bg-success @else bg-gray-400 @endif">
                                </div>
                            </td>
                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm flex gap-2 justify-center">
                                <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}">
                                    <img src="/svg/edit.svg" />
                                </a>
                                <button data-modal-target="usuario-{{ $usuario->id_usuario }}"
                                    data-modal-toggle="usuario-{{ $usuario->id_usuario }}">
                                    <img src="/svg/delete.svg" />
                                </button>
                                <x-modals.alert-modal id="usuario-{{ $usuario->id_usuario }}" route="usuarios.destroy"
                                    :parametroDeRoute="$usuario->id_usuario" title="Esta seguro de eliminar al usuario"
                                    message="El usuario {{ $usuario->nombre }}
                                        {{ $usuario->segundo_nombre }} {{ $usuario->apellido_paterno }}
                                        {{ $usuario->apellido_materno }} sera eliminado" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
    </div>
</x-app>
