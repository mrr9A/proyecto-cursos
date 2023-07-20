<x-app title="CATÁLOGO de Cursos:">
    <div>
        <div class="flex justify-between">
            <div class="mx-9">
                <a type="button" class="text-white bg-btn-primary hover:bg-btn-primary-light focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{route('crearCurso')}}">
                    <img src="./img/elearning.png" alt=""><span>Agregar curso</span>
                </a>
                <a type="button" class="text-white bg-btn-primary hover:bg-btn-primary-light focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{ url('avances') }}">
                    <img src="./img/usuario.png" alt="">
                    <span>Usuarios internos</span>
                </a>
                <a type="button" class="text-white bg-btn-primary hover:bg-btn-primary-light focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{ route('reportesinternos.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M453.547 273.449H372.12v-40.714h81.427v40.714zm0 23.264H372.12v40.714h81.427v-40.714zm0-191.934H372.12v40.713h81.427V104.78zm0 63.978H372.12v40.713h81.427v-40.713zm0 191.934H372.12v40.714h81.427V360.69zm56.242 80.264c-2.326 12.098-16.867 12.388-26.58 12.796H302.326v52.345h-36.119L0 459.566V52.492L267.778 5.904h34.548v46.355h174.66c9.83.407 20.648-.291 29.197 5.583c5.991 8.608 5.41 19.543 5.817 29.43l-.233 302.791c-.29 16.925 1.57 34.2-1.978 50.892zm-296.51-91.256c-16.052-32.57-32.395-64.909-48.39-97.48c15.82-31.698 31.408-63.512 46.937-95.327c-13.203.64-26.406 1.454-39.55 2.385c-9.83 23.904-21.288 47.169-28.965 71.888c-7.154-23.323-16.634-45.774-25.3-68.515c-12.796.698-25.592 1.454-38.387 2.21c13.493 29.78 27.86 59.15 40.946 89.104c-15.413 29.081-29.837 58.57-44.785 87.825c12.737.523 25.475 1.047 38.212 1.221c9.074-23.148 20.357-45.424 28.267-69.038c7.096 25.359 19.135 48.798 29.023 73.051c14.017.99 27.976 1.862 41.993 2.676zM484.26 79.882H302.326v24.897h46.53v40.713h-46.53v23.265h46.53v40.713h-46.53v23.265h46.53v40.714h-46.53v23.264h46.53v40.714h-46.53v23.264h46.53v40.714h-46.53v26.897H484.26V79.882z" />
                    </svg>
                    <span>Reportes</span>
                </a>
            </div>
            <div class="mx-10">
                <x-search.search-input route="curs.index" placeholder="Buscar por Categoria, Nombre, Código"></x-search.search-input>
            </div>
        </div>

        <div class="p-2">
            <div class="block max-w p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="text-subtitle font-bold">
                    Cursos
                </div><br>
                <div class="card-body px-0 pt-0 pb-2">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-th-table-text uppercase bg-th-table dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Imagen
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre completo del curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    CÓDIGO del Curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Categoría del curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cantidad de usuarios inscritos
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Configuración
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $curso)
                                @if($curso->interno_planta == 1 and $curso->estado == 1)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-800 text-center">
                                    <td class="inline-block mt-2">
                                        <img src="{{$curso->imagen}}" width="50" height="50">
                                    </td>
                                    <td class="py-4 font-bold uppercase">
                                        {{$curso->nombre}}
                                    </td>
                                    <td class=" font-bold uppercase">
                                        {{$curso->codigo}}
                                    </td>
                                    <td class=" font-bold uppercase">
                                        {{$curso->categoria[0]->nombre}}
                                    </td>
                                    <td class=" font-bold uppercase">
                                        {{$curso->usuarioCurso->count()}} Usuarios incritos
                                    </td>
                                    <td class=" text-center ">
                                        <a href="{{url('curs',[$curso])}}" type="button" class="text-white bg-btn-primary hover:bg-btn-primary-light focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg   dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="32" viewBox="0 0 512 560">
                                                <path fill="currentColor" d="m184.785 471.562l76.992-115.487l-76.992-115.487h57.743l76.993 115.487l-76.993 115.487h-57.743zm76.992 0l76.992-115.487l-76.992-115.487h57.744l153.982 230.974h-57.744l-48.118-72.178l-48.12 72.178h-57.744zm186.063-67.366L422.178 365.7l89.822-.003v38.498h-64.16zm-38.495-57.744l-25.665-38.495l128.32-.002v38.497H409.345zM169.028 176.54c50.881-29.318 112.082-6.227 135.345 41.445h65.802a154.223 154.223 0 0 0-13.278-33.034l35.475-62.993L357.014 86.6l-62.4 35.654a161.966 161.966 0 0 0-31.679-13.54l-18.869-68.275h-50.09l-18.337 66.874c-11.728 3.226-23.355 7.903-34.692 14.143L81.52 88.072L46.161 123.43l32.976 58.956c-6.21 11.113-10.972 22.86-14.3 34.948L0 236.378v50.09l65.185 17.707a156.965 156.965 0 0 0 14.572 34.737l-32.122 60.013l35.357 35.358l59.415-34.709c8.687 4.668 29.805 12.987 48.128 18.3l41.032-61.799C130.288 370.491 75.488 230.436 169.028 176.54z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table><br>
                        {{-- PAGINACION --}}
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                {{-- $cursos->currentPage(): Devuelve el número de página actual.
                    $cursos->perPage(): Devuelve la cantidad de resultados mostrados por página.
                    $cursos->total(): Devuelve el total de resultados obtenidos. --}}
                                <p class="text-sm text-gray-700">
                                    Mostrando
                                    <span class="font-medium">{{ $cursos->currentPage() }}</span>
                                    a
                                    <span class="font-medium">{{ $cursos->perPage() }}</span>
                                    de
                                    <span class="font-medium">{{ $cursos->total() }}</span>
                                    resultados
                                </p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

                                    @if ($cursos->onFirstPage())
                                    <a href="#" aria-label="@lang('pagination.previous')" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @else
                                    <a href="{{ $cursos->previousPageUrl() }}" aria-label="@lang('pagination.previous')" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @endif

                                    {{-- paginas --}}
                                    <!-- @if ($cursos->currentPage() != 1)
                                    <a href="{{ $cursos->url(1) }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">1</a>
                                    @endif -->


                                    @foreach ($cursos->getUrlRange(max(1, $cursos->currentPage() - 2), min($cursos->lastPage(), $cursos->currentPage() + 2)) as $page => $url)
                                    <a href="{{ $url }}" class="{{ $cursos->currentPage() === $page ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }}">{{ $page }}</a>
                                    @endforeach

                                    <!-- @if ($cursos->currentPage() != $cursos->lastPage())
                                    <a href="{{ $cursos->url($cursos->lastPage())}}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{$cursos->lastPage()}}</a>
                                    @endif -->

                                    <!-- Enlace a la siguiente página -->
                                    @if ($cursos->hasMorePages())
                                    <a href="{{ $cursos->nextPageUrl() }}" aria-label="@lang('pagination.next')" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @else
                                    <div aria-hidden="true" aria-label="@lang('pagination.next')" aria-disabled="true" aria-label="@lang('pagination.next')" class="disabled relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
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