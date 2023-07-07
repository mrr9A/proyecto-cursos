<div class="text-text-input relative">
    <label for="puesto_id" class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">
        {{ $textLabel }}
        @if ($required ?? '')
            <span>*</span>
        @endif
    </label>
    <select {{ $required ?? '' ? 'required' : '' }} name="{{ $name }}" id="{{ $id ?? $name }}"
        class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
        <option value="" id="select_puesto" class="text-gray-400">{{ $textOptionDefault }}</option>
        @if ($puestos ?? '')
            @foreach ($puestos as $puesto)
                <option value="{{ $puesto->id_puesto }}" {{old ($name) == $puesto->id_puesto ? 'selected' : ''}} @if (($value->id_puesto ?? '') == $puesto->id_puesto) selected @endif>
                    {{ $puesto->puesto }}
                </option>
            @endforeach
        @endif
        @if ($sucursales ?? '')
            @foreach ($sucursales as $sucursal)
                <option value="{{ $sucursal->id_sucursal }}" {{old ($name) == $sucursal->id_sucursal ? 'selected' : ''}} @if (($value->id_sucursal ?? '') == $sucursal->id_sucursal) selected @endif>
                    {{ $sucursal->nombre }}</option>
            @endforeach
        @endif
        @if ($modalidades ?? '')
            @foreach ($modalidades as $modalidad)
                <option value="{{ $modalidad->id_modalidad }}">
                    {{ $modalidad->modalidad }}</option>
            @endforeach
        @endif
        @if ($tipos ?? '')
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo->id_tipo_curso }}">
                    {{ $tipo->nombre }}</option>
            @endforeach
        @endif

    </select>
    @error($mensaje ?? $name)
        <small class="absolute -bottom-4 text-sm text-red-500 font-semibold italic">{{ $message }}</small>
    @enderror
</div>
