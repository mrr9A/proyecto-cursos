<div class="flex flex-col w-full items-end">
    <button data-popover-target="popover-{{ $id }}-profile" type="button"
        class="w-28 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ $text }}
    </button>
</div>
<div data-popover id="popover-{{ $id }}-profile" role="tooltip"
    class=" absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
    <div class="p-3 overflow-x-auto">
        <div class="overflow-x-auto">
            <table class="shadow-md rounded-md border-gray-700 max-w-full overflow-hidden">
                <legend class="text-black font-semibold">Progreso de cursos</legend>
                <thead class="bg-blue-200 capitalize font-bold text-sm">
                    <tr class="border-[1px] ">
                        <td>tipo</td>
                        <td class="px-1 py-1">real</td>
                        <td class="px-1 py-1">objetivo</td>
                        <td class="px-1 py-1">progreso</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-[1px] @if ($item['progeso'] == 100) bg-green-400 @endif ">
                            <td class="capitalize px-1 py-1">{{ $item['tipo'] }}</td>
                            <td class="text-center">{{ $item['objetivo'] }}</td>
                            <td class="text-center">{{ $item['real'] }}</td>
                            <td class="text-center">{{ $item['progeso'] }} %</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full flex justify-end mt-2">
            <a target="_blank" href="{{route('descargarPDF', $id)}}" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ver reporte</a>
        </div>
    </div>
    <div data-popper-arrow></div>
</div>
