<select name="puesto_id" id="puesto_id"
    class="py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
    <option value="" id="select_puesto" class="text-gray-400">Selecciona un puesto</option>
    @foreach ($puestos as $puesto)
        <option value="{{ $puesto->id_puesto }}">
            {{ $puesto->puesto }}
        </option>
    @endforeach
</select>
