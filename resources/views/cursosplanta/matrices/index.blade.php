<x-app title="matrices">
    <x-messages.alert-message
        text="Para calificar a un empleado seleccione el curso a calificar y click en el boton de calificar.Para indicar el procentaje que lleva por curso ir al detalle de cada usuario" />

    <form autocomplete="on" class="flex  w-auto items-center justify-between border-b-2 border-gray-200 mb-2 pb-2" action="{{ route('matrices.index') }}">
        <div class="">
            <p class="font-semi-bold underline text-text-input">Filtros</p>
            <div class="w-auto">
                <select name="sucursal_id" class="border-gray-300 capitalize rounded-md w-full">
                    <option value=" " class="inline-block capitalize">sucursales</option>
                    @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}" class="inline-block capitalize">
                            {{ $sucursal->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex items-center relative">
            <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input id="buscador" name="buscador" type="text"
                    placeholder="Buscar por nombre, sucursal"
                    class="block w-full py-2.5 pr-5 text-gray-700 bg-white border border-gray-300 rounded-lg md:w-80  placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
            <button type="submit"
                class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>
    </form>


    @if (count($data['usuarios']) > 0)
        <x-tables.table :empleados="$data" />
    @else
        <p class="text-title font-bold mt-6">Sin resultados...</p>
    @endif
</x-app>
