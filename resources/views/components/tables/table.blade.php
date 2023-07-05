<form action="{{ route('calificaciones.store') }}" method="POST">
    @csrf
    <div class="flex justify-between items-center mb-3">
        <div>
            <div class="flex flex-wrap">
                <div class="flex items-center mr-4">
                    <input id="red-radio" type="checkbox" value="20" name="colored-radio" checked disabled
                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="red-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No aprovado</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="green-radio" type="checkbox" value="50" name="colored-radio" checked disabled
                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="green-radio"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">completado</label>
                </div>
                <div class="flex items-center mr-4">
                    <input checked id="purple-racheckboxdio" type="checkbox" value="60" name="colored-radio" checked disabled
                        class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="purple-radio"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">En progreso</label>
                </div>
            </div>
        </div>
        <x-input-submit text="Calificar" />
    </div>

    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
            {{-- $usuarios->currentPage(): Devuelve el número de página actual.
            $usuarios->perPage(): Devuelve la cantidad de resultados mostrados por página.
            $usuarios->total(): Devuelve el total de resultados obtenidos. --}}
            <p class="text-sm text-gray-700">
                Mostrando
                <span class="font-medium">{{ $empleados['links']['paginator']->currentPage() }}</span>
                a
                <span class="font-medium">{{ $empleados['links']['paginator']->perPage() }}</span>
                de
                <span class="font-medium">{{ $empleados['links']['paginator']->total() }}</span>
                resultados
            </p>
        </div>
        <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

                @if ($empleados['links']['paginator']->onFirstPage())
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
                    <a href="{{ $empleados['links']['paginator']->previousPageUrl() }}" aria-label="@lang('pagination.previous')"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- paginas --}}
                @if ($empleados['links']['paginator']->currentPage() != 1)
                    <a href="{{ $empleados['links']['paginator']->url(1) }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">1</a>
                @endif


                @foreach ($empleados['links']['paginator']->getUrlRange(max(1, $empleados['links']['paginator']->currentPage() - 2), min($empleados['links']['paginator']->lastPage(), $empleados['links']['paginator']->currentPage() + 2)) as $page => $url)
                    <a href="{{ $url }}"
                        class="{{ $empleados['links']['paginator']->currentPage() === $page ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' }}">{{ $page }}</a>
                @endforeach

                @if ($empleados['links']['paginator']->currentPage() != $empleados['links']['paginator']->lastPage())
                
                    <a href="{{ $empleados['links']['paginator']->url($empleados['links']['paginator']->lastPage())}}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{$empleados['links']['paginator']->lastPage()}}</a>
                @endif

                <!-- Enlace a la siguiente página -->
                @if ($empleados['links']['paginator']->hasMorePages())
                    <a href="{{ $empleados['links']['paginator']->nextPageUrl() }}" aria-label="@lang('pagination.next')"
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

    <table id="tabla1" class="uppercase min-w-full leading-normal my-2 border-collapse">
        <thead class="border-b  dark:border-neutral-500 uppercase">
            <tr
                class="px-5 border-b-2 border-gray-200 bg-primary text-left text-base font-semibold text-white uppercase tracking-wider">
                <th scope="col" class="px-6 py-2 border-r-2">Personal</th>
                <th scope="col" class="px-6 py-2 border-r-2">Puesto</th>
                <th scope="col" class="px-6 py-2 border-r-2">Trabajos</th>
                <th scope="col" class="w-full px-6 py-2">plan de formacion</th>
                <th><i class='bx bx-cog'></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados['usuarios'] as $empleado)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="w-1/12 min-h-full border-r-2">
                        <label class="w-full min-h-full cursor-pointer block overflow-hidden">
                            <input class="hidden peer" type="checkbox" name="empleado"
                                value="{{ $empleado->id_usuario }}" />
                            <div
                                class="flex items-center peer-checked:bg-input peer-checked:text-white h-full py-2 px-1 ">
                                <h2 class="uppercase text-sm">{{ $empleado->empleado }}</h2>
                            </div>
                        </label>
                    </td>

                    <td class="py-2 px-2.5 uppercase text-sm border-r-2">{{ $empleado->puesto ?? 'sin puesto' }}</td>
                    <td class="w-1/12 h-full  border-r-2">
                        <div class="flex flex-col justify-evenly flex-1 h-full ">
                            <?php
                            $keys = array_keys($empleado->trabajos);
                            ?>
                            @foreach ($keys as $trabajo)
                                <p
                                    class="uppercase text-sm flex-1 border-b-[1px] border-gray-200 border-collapse py-1 px-2.5 @if ($trabajo == $empleado->puesto && count($empleado->trabajos) > 1) hidden @endif">
                                    {{ $trabajo ?? 'sin trabajos' }}</p>
                            @endforeach
                        </div>
                    </td>
                    <td class="w-full h-full grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] m-0 p-0">
                            <x-tables.table-curses-tecnica :empleado="$empleado" :id="$empleado->id_usuario" :keys="$keys" />
                    </td>
                    <td>
                        <a href="{{route("matrices.show", $empleado->id_usuario)}}">
                            <i class='bx bx-show-alt' ></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</form>
