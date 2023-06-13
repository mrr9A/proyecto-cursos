@if (!is_null($empleado))
    <?php
    $keys = array_keys($empleado->cursos);
    ?>
    @foreach ($keys as $tipo)
        <table id="{{ $tipo }}" class="w-auto overflow-x-auto">
            <thead class="bg-blue-800 border-[1px] border-black text-white">
                <tr>
                    <th class="w-full">{{ $tipo }}</th>
                </tr>
            </thead>
            <tbody class="bg-white border-[1px] border-black">
                <tr class="w-full grid  overflow-auto grid-cols-[repeat(auto-fit,minmax(120px,1fr))] ">
                    {{-- @dump($cursos) --}}
                    @foreach ($empleado->cursos[$tipo] as $curso)
                        {{-- @if ($loop->iteration < $empleado->cursos[$tipo]->toArray()->count() - 1) --}}
                            <td
                                class="w-full h-full border-[1px]  text-black @if ($curso->calificacion == 'aprovado') bg-green-400 @endif ">
                                <label class="w-full h-full cursor-pointer block overflow-hidden">
                                    <input class="hidden peer" type="checkbox" name="cursos[]"
                                        value="usuario_id:{{$id}}-curso_id:{{ $curso->id_curso }}"
                                        @if ($curso->calificacion == 'aprovado') disabled @endif />

                                    <div class="peer-checked:bg-indigo-600 h-full py-2 px-2">
                                        <h2 class="uppercase text-sm">{{ $curso->nombre_curso }}</h2>
                                    </div>
                                </label>
                            </td>
                        {{-- @endif --}}
                    @endforeach

                </tr>
            </tbody>
        </table>
    @endforeach
@else
    sin cursos
@endif
