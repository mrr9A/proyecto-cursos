<x-app title="matrices">
    <x-messages.alert-message
        text="Para calificar a un empleado seleccione el curso a calificar y click en el boton de calificar.Para indicar el procentaje que lleva por curso ir al detalle de cada usuario" />
    <div class="flex justify-end my-2 items-center">
        <form action="{{ route('matrices.index') }}">
            <div class="flex overflow-hidden rounded-md">
                <div class="bg-red-200 w-auto">
                    <select name="sucursal_id" class="border-gray-300 capitalize rounded-md w-full">
                        <option value=" " class="inline-block capitalize">sucursales</option>
                        @foreach ($sucursales as $sucursal)
                            <option value="{{ $sucursal->id_sucursal }}" class="inline-block capitalize">{{ $sucursal->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative w-full">
                    <input type="search" id="search-dropdown" name="buscador"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="buscar por nombre, puesto">
                    <button type="submit"
                        class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>
    </div>


    @if (count($data['usuarios']) > 0)
        <x-tables.table :empleados="$data" />
    @else
        <p class="text-title font-bold mt-6">Sin resultados...</p>
    @endif
</x-app>
