<div class="{{ $class ?? '' }} text-text-input relative">
    <label for="{{ $id ?? $nombre }}"
        class="block mb-2 font-semi-bold font-poppins text-gray-600 dark:text-white {{ $classLabel ?? '' }}">
        {{ $text }}
        @if ($required ?? '')
            <span>*</span>
        @endif
    </label>
    <input {{ $required ?? '' ? 'required' : '' }} type="{{ $type ?? 'text' }}" name="{{ $nombre }}"
        id="{{ $id ?? $nombre }}" type="text" placeholder="{{ $placeholder ?? '' }}"
        class="bg-gray-50 border-[2px] border-input text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white placeholder:uppercase {{ ($type ?? "") != 'password'  ? 'uppercase' : '' }} {{($type ?? "") == 'email' ? 'lowercase placeholder:lowercase' : ''}} "
        value="{{ old($nombre, $value ?? '') }}" min="1" />

    @error($mensaje ?? $nombre)
        <!-- variable mensaje disponible por laravel -->
        <small class="absolute -bottom-8 text-sm text-red-500 font-semibold italic">{{ $message }}</small>
    @enderror
</div>


