<x-app title="generar reportes">

    <form action="{{ route('reportes.index') }}" method="GET">
        @csrf
        <div class=" flex gap-4 flex-wrap justify-around">
            <div>
                <x-selects.input-select textLabel="sucursales" name="sucursal_id"
                    textOptionDefault="selecciona una sucursal" :sucursales="$sucursales" />
            </div>
            <div>
                <x-selects.input-select textLabel="puestos" name="puesto_id" textOptionDefault="selecciona un puesto"
                    :puestos="$puestos" />
            </div>
            <div>
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
                    <option selected>Choose a country</option>
                    <@foreach ($cursos as $curso)
                        <option value="{{ $curso->id_curso }}"
                            {{ old('curso_id') == $curso->id_curso ? 'selected' : '' }}>
                            {{ $curso->nombre }}
                        </option>
                        @endforeach
                </select>
            </div>
        </div>
        <x-input-submit text="Generar reporte" class="mt-3" />
    </form>


    <div class="mt-4 ">
      <p>Resultados ....</p>
    </div>
</x-app>
