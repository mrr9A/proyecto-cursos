<div class="text-text-input">
    <label for="puesto_id" class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">
        {{ $textLabel }}
        @if ($required ?? '')
            <span>*</span>
        @endif
    </label>
    <select name="{{ $name }}" id="{{ $name ?? $id }}"
        class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
        <option value="" id="select_puesto" class="text-gray-400">{{ $textOptionDefault }}</option>
        @if ($puestos ?? '')
            @foreach ($puestos as $puesto)
                <option value="{{ $puesto->id_puesto }}" @if(($value->id_puesto ?? "") == $puesto->id_puesto) selected @endif >
                    {{ $puesto->puesto }}
                </option>
            @endforeach
        @endif
        @if ($sucursales ?? '')
            @foreach ($sucursales as $sucursal)
                <option value="{{ $sucursal->id_sucursal }}" @if(($value->id_sucursal ?? "") == $sucursal->id_sucursal) selected @endif >{{ $sucursal->nombre }}</option>
            @endforeach
        @endif

    </select>
    @error($name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
