<div class="form-group">
    <label for="estado" class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white text-base">
        {{ $textLabel }}
        @if ($required ?? '')
            <span>*</span>
        @endif
    </label>
    <select
        class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        value="rol" id="{{$name ?? $id}}"name="{{$name}}" required>
        <option class="text-gray-400">{{ $textOptionDefault }}</option>

        @foreach ($opciones as $opcion)
            <option value="{{$opcion->value}}" >{{$opcion->text}}</option>
        @endforeach
    </select>
    @error('estado')
        <span class="error">{{ $message }}</span>
    @enderror
</div>
