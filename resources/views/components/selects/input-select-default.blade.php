<div class="form-group  text-text-input relative">
    <label for="{{ $name }}"
        class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">
        {{ $textLabel }}
        @if ($required ?? '')
            <span>*</span>
        @endif
    </label>
    <select {{ $required ?? '' ? 'required' : '' }}
        class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        value="rol" id="{{ $name ?? $id }}"name="{{ $name }}" required>
        <option value="" class="text-gray-400" disabled>{{ $textOptionDefault }}</option>


        @foreach ($opciones as $opcion)
            <option value="{{ $opcion->value }}" {{old ($name) == $opcion->value ? 'selected' : ''}}  @if (($value ?? '') == $opcion->value) selected @endif>{{ $opcion->text }}
            </option>
            {{-- @if (($value->id_sucursal ?? '') == $sucursal->id_sucursal) selected @endif --}}
            {{-- value="{{$value}}" {{old ('type') == $value ? 'selected' : ''}} --}}
        @endforeach
    </select>
    @error($name)
        <small class="absolute -bottom-4 text-sm text-red-500 font-semibold italic">{{ $message }}</small>
    @enderror
</div>
