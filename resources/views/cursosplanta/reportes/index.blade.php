<x-app title="generar reportes">

    <form action="{{ route('reportes.index') }}" method="GET">
        @method('GET')
        <div class=" flex gap-4 flex-wrap items-end">
            <div>
                <x-selects.input-select textLabel="sucursales" name="sucursal_id"
                    textOptionDefault="selecciona una sucursal" :sucursales="$sucursales" />
            </div>
            <div>
                <x-selects.input-select textLabel="puestos" name="puesto_id" textOptionDefault="selecciona un puesto"
                    :puestos="$puestos" />
            </div>

            <x-input-submit text="Filtrar" class="max-h-[40px]" />
        </div>
    </form>

@if(count($data) > 0)
    <div class="mt-4 ">

        <div class="flex justify-end">
            <a href="{{ route('reportes.index', array_merge(request()->query(), ['export' => 1])) }}"
                class="inline-block bg-blue-800 py-1.5 px-2 text-white font-bold rounded-md self-end">
                Exportar datos a Excel
            </a>
        </div>
        

        <table class="min-w-full leading-normal my-2">
            <thead class="border-b  dark:border-neutral-500 uppercase">
                <tr
                    class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    <th scope="col" class="px-6 py-2 w-1/12">ID SGP</th>
                    <th scope="col" class="px-6 py-2">ID SUMTOTAL</th>
                    <th scope="col" class="px-6 py-2 ">SUCURSAL</th>
                    <th scope="col" class="px-6 py-2">EMPLEADO</th>
                    <th scope="col" class="px-6 py-2">PUESTO</th>
                    <th scope="col" class="px-6 py-2">TRABAJO</th>
                    <th scope="col" class="px-6 py-2">CURSO</th>
                    <th scope="col" class="px-6 py-2">PROGRESO</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($data as $usuario)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                        <td class="py-3 px-6 text-left">{{ $usuario->id_sumtotal }}</td>
                        <td class="py-3 px-6 text-left capitalize">{{ $usuario->sucursal }}</td>
                        <td class="py-3 px-6 text-left">{{ $usuario->empleado }}</td>
                        <td class="py-3 px-6 text-left">{{ $usuario->puesto }}</td>
                        <td class="py-3 px-6 text-left">{{ $usuario->trabajo }}</td>
                        <td class="py-3 px-6 text-left">{{ $usuario->curso }}</td>
                        <td class="py-3 px-6 text-left">{{ $usuario->valor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    Sin resultados
    @endif
</x-app>


            {{-- <div>
                <label for="countries"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">trabajos</label>
                <select id="trabajo_id" name="trabajo_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">selecciona un trabajo</option>
                    <@foreach ($trabajos as $trabajo)
                        <option value="{{ $trabajo->id_trabajo }}"
                            {{ old('trabajo_id') == $trabajo->id_trabajo ? 'selected' : '' }}>
                            {{ $trabajo->nombre }}
                        </option>
                        @endforeach
                </select>
            </div>
            <div>
                <label for="countries"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cursos</label>
                <select id="curso_id" name="curso_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Selecciona un curso</option>
                    <@foreach ($cursos as $curso)
                        <option value="{{ $curso->id_curso }}"
                            {{ old('curso_id') == $curso->id_curso ? 'selected' : '' }}>
                            {{ $curso->nombre }}
                        </option>
                        @endforeach
                </select>
            </div> --}}