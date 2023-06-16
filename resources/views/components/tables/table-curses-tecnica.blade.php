@if (!is_null($empleado))

    {{-- <?php
    $keysCursos = array_keys($empleado->cursos);
    if ($keysCursos[count($keysCursos) - 1] == 'iniciales') {
        $keysCursos = array_reverse($keysCursos);
    }
    ?> --}}

    {{-- =================== CURSOS BASICOS POR PUESTO ==============================  --}}
    {{-- @foreach ($keysCursos as $tipo)
        <table id="{{ $tipo }}" class="w-auto overflow-x-auto h-full">
            <thead class="bg-blue-800 border-[1px] border-black text-white">
                <tr>
                    <th class="w-full">{{ $tipo }}</th>
                </tr>
            </thead>
            <tbody class=" border-[1px] border-black">
                <tr class="bg-white w-full  grid overflow-auto grid-cols-[repeat(auto-fit,minmax(120px,1fr))]">
                    @foreach ($empleado->cursos[$tipo] as $curso)
                        <td
                            class="w-full  border-[1px]  text-black @if ($curso->calificacion == 'aprovado') bg-green-400 @endif ">
                            <label class="w-full h-full cursor-pointer block overflow-hidden">
                                <input class="hidden peer" type="checkbox" name="cursos[]"
                                    value="usuario_id:{{ $id }}-curso_id:{{ $curso->id_curso }}"
                                    @if ($curso->calificacion == 'aprovado') disabled @endif />

                                <div class="peer-checked:bg-indigo-600 peer-checked:text-white h-full py-2 px-2">
                                    <h2 class="uppercase text-sm">{{ $curso->nombre_curso }}</h2>
                                </div>
                            </label>
                        </td>
                    @endforeach

                </tr>
            </tbody>
        </table>
    @endforeach --}}
    {{-- ==================== CURSOS AVANZADOS O EXPERTOR POR TRABAJOS ============================= --}}

    <div class="flex flex-col">
        @foreach ($empleado->trabajos as $trabajos)
            <?php
            $keysCursos = array_keys($trabajos[0]['cursos']->toArray());
            $keysCursos = array_unique($keysCursos);
            ?>
            @foreach ($keysCursos as $tipo)
                <table id="{{ $tipo }}" class="w-auto overflow-x-auto h-full">
                    <thead class="bg-blue-800 border-[1px] border-black text-white">
                        <tr>
                            <th class="w-full">{{ $tipo }}</th>
                        </tr>
                    </thead>
                    <tbody class="h-full border-[1px] border-black">
                        <tr
                            class="bg-white w-full h-full grid overflow-auto grid-cols-[repeat(auto-fit,minmax(120px,1fr))]">
                            @foreach ($trabajos[0]['cursos'][$tipo] as $curso)
                                <td
                                    class="w-full h-full border-[1px]  text-black @if ($curso->calificacion == 'aprovado') bg-green-400 @endif ">
                                    <label class="w-full h-full cursor-pointer block overflow-hidden">
                                        <input class="hidden peer" type="checkbox" name="cursos[]"
                                            value="usuario_id:{{ $id }}-curso_id:{{ $curso->id_curso }}"
                                            @if ($curso->calificacion == 'aprovado') disabled @endif />

                                        <div
                                            class="peer-checked:bg-indigo-600 peer-checked:text-white h-full py-2 px-2">
                                            <h2 class="uppercase text-sm">{{ $curso->nombre_curso }}</h2>
                                        </div>
                                    </label>
                                </td>
                            @endforeach

                        </tr>
                    </tbody>
                </table>
            @endforeach
        @endforeach
    </div>
@else
    sin cursos
@endif
