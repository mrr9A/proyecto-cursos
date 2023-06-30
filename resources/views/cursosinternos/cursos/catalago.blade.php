<x-app title="Catalago de Cursos:">
    <div>
        <x-search.search-input route="curs.index" placeholder="Buscar por Categoria, Nombre, Codigo"></x-search.search-input>

        <div class="p-12">
            <a type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{route('crearCurso')}}">
                <img src="./img/agregar-usuario.png" alt=""><span>Agregar Curso</span>
            </a><br>
            <div class="block max-w p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="text-subtitle font-bold">
                    Cursos
                </div><br>
                <div class="card-body px-0 pt-0 pb-2">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Imagen
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre Completo del Curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Codígo del Curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Categoria del curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fecha de Inicio
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fecha de Termino
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
                                    <td class="inline-block ">
                                        <img src="{{$curso->imagen}}" width="50" height="50">
                                    </td>
                                    <td class="py-4 font-bold">
                                        {{$curso->nombre}}
                                    </td>
                                    <td class=" font-bold">
                                        {{$curso->codigo}}
                                    </td>
                                    <td class=" font-bold">
                                        {{$curso->categoria[0]->nombre}}
                                    </td>
                                    <td class=" font-bold">
                                        <!-- {{$curso->fecha_inicio}} -->
                                        {{$curso->fecha_inicio ?? '' ?  date('Y-m-d', strtotime($curso->fecha_inicio ?? '')) : '' }}
                                    </td>
                                    <td class=" font-bold">
                                        <!-- {{$curso->fecha_termino}} -->
                                        {{$curso->fecha_termino ?? '' ?  date('Y-m-d', strtotime($curso->fecha_termino ?? '')) : '' }}
                                    </td>
                                    <td class=" text-center ">
                                        <a href="{{url('curs',[$curso])}}" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg   dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
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