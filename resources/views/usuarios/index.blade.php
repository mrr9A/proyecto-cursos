<x-app title="Usuarios">
    <div class="card mb-4 -mt-3">

        <div class="flex items-center justify-between ">
            <div>
                <h2 class="text-gray-600 font-semibold">Lista de usuarios</h2>
                <span class="text-xs">usuarios activos y inactivos</span>
            </div>
            <div class="flex items-center justify-between">
                <x-search.search-input route="usuarios.index" />
                <div class="lg:ml-40 ml-10 space-x-8">
                    <a href="{{ route('usuarios.create') }}"
                        class="bg-btn-primary px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer hover:bg-btn-primary-light">Agregar
                        usuario</a>
                </div>
            </div>
        </div>



        <div class="card-body">
            <table class="min-w-full leading-normal my-2">
                <thead class="border-b  dark:border-neutral-500 uppercase">
                    <tr
                        class="px-5 py-3 border-b-2 border-gray-200 bg-th-table text-left text-xs font-semibold text-th-table-text uppercase tracking-wider">
                        <th scope="col" class="px-6 py-2 w-1/12">ID SGP</th>
                        <th scope="col" class="px-6 py-2">ID SUMTOTAL</th>
                        <th scope="col" class="px-6 py-2">nombre</th>
                        <th scope="col" class="px-6 py-2">puesto</th>
                        <th scope="col" class="px-6 py-2">rol</th>
                        <th scope="col" class="px-6 py-2">estado</th>
                        <th scope="col" class="px-6 py-2">opciones</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if (count($usuarios) < 1)
                        <tr class="text-title font-bold mt-6">
                            <td colspan="4">Sin resultados...</td>
                        </tr>
                    @endif
                    @foreach ($usuarios as $usuario)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->id_sumtotal }}</td>
                            <td class="py-3 px-6 text-left capitalize">{{ $usuario->nombre }}
                                {{ $usuario->segundo_nombre }} {{ $usuario->apellido_paterno }}
                                {{ $usuario->apellido_materno }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->puestos->puesto }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->rol == 1 ? 'Empleado' : 'Administrador' }}</td>
                            <td class="py-3 px-6 text-left w-1/12">
                                <div
                                    class="w-4 h-4 rounded-full @if ($usuario->estado == 1) bg-success @else bg-gray-400 @endif">
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left flex gap-2 justify-center">
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
            {{-- PAGINACION --}}
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    {{-- $usuarios->currentPage(): Devuelve el número de página actual.
                    $usuarios->perPage(): Devuelve la cantidad de resultados mostrados por página.
                    $usuarios->total(): Devuelve el total de resultados obtenidos. --}}
                    <p class="text-sm text-gray-700">
                        Mostrando
                        <span class="font-medium">{{ $usuarios->currentPage() }}</span>
                        a
                        <span class="font-medium">{{ $usuarios->perPage() }}</span>
                        de
                        <span class="font-medium">{{ $usuarios->total() }}</span>
                        resultados
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

                        @if ($usuarios->onFirstPage())
                            <a href="#" aria-label="@lang('pagination.previous')"
                                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ $usuarios->previousPageUrl() }}" aria-label="@lang('pagination.previous')"
                                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif

                        {{-- Páginas --}}
                        @foreach ($usuarios->getUrlRange(max(1, $usuarios->currentPage() - 2), min($usuarios->lastPage(), $usuarios->currentPage() + 2)) as $page => $url)
                            {{-- Mostrar solo la página más cercana al margen --}}
                            @if ($page == 1 || $page == $usuarios->lastPage() || abs($page - $usuarios->currentPage()) <= 2)
                                <a href="{{ $url }}"
                                    class="{{ $usuarios->currentPage() === $page ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }}">{{ $page }}</a>
                            @endif
                        @endforeach


                        @if ($usuarios->currentPage() != $usuarios->lastPage())
                            {{-- Mostrar siempre la última página --}}
                            <a href="{{ $usuarios->url($usuarios->lastPage()) }}"
                                class="{{ $usuarios->currentPage() === $usuarios->lastPage() ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }}">{{ $cursos->lastPage() }}</a>
                        @endif

                        <!-- Enlace a la siguiente página -->
                        @if ($usuarios->hasMorePages())
                            <a href="{{ $usuarios->nextPageUrl() }}" aria-label="@lang('pagination.next')"
                                class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <div aria-hidden="true" aria-label="@lang('pagination.next')" aria-disabled="true"
                                aria-label="@lang('pagination.next')"
                                class="disabled relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif

                    </nav>
                </div>
            </div>
            {{-- FIN DE LA PAGINACION --}}
        </div>

    </div>
    </div>
</x-app>
