  @foreach ($cursos as $curso)
      <label
          class="cursor-pointer block w-52 h-auto rounded-lg  border-fuchsia-400 mb-4 overflow-hidden bg-white">
          <input class="hidden peer" type="checkbox" name="cursos[]" value="{{ $curso->id_curso }}" />

          <div class="relative peer-checked:bg-orange-200 h-full p-2">
              <h2 class="uppercase text-sm">{{ $curso->nombre }}</h2>
              <h3 class="text-gray-500 text-[12px]">{{ $curso->codigo }}</h3>
          </div>
      </label>
  @endforeach