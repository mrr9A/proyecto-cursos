@if (!is_null($empleado))

    <?php
    $keysCursos = array_keys($empleado->trabajos[$empleado->puesto][0]['cursos']->toArray());
    ?>

    {{-- =================== CURSOS BASICOS POR PUESTO ==============================  --}}
    @if (count($empleado->trabajos[$empleado->puesto][0]['cursos']) > 0)
        @foreach ($keysCursos as $tipo)
            <table id="{{ $tipo }}" class="w-auto overflow-x-auto h-full">
                <thead class="bg-blue-800 border-[1px]  text-white">
                    <tr>
                        <th class="w-full">{{ $tipo }}</th>
                    </tr>
                </thead>
                <tbody class=" border-[1px] ">
                    <tr
                        class="bg-white w-full h-full min-h-[100px] grid  grid-cols-[repeat(auto-fit,minmax(120px,1fr))]">
                        @foreach ($empleado->trabajos[$empleado->puesto][0]['cursos'][$tipo] as $curso)
                            <td
                                class="w-full h-full border-[1px]  text-black @if ($curso->calificacion == '100') bg-green-300 @endif @if($curso->calificacion > '0' && $curso->calificacion < '100') bg-yellow-200 @endif @if($curso->calificacion <= '0')  @endif">
                                <label class="w-full h-full cursor-pointer block overflow-hidden">
                                    <input class="hidden peer" type="checkbox" name="cursos[]"
                                        value="usuario_id:{{ $id }}-curso_id:{{ $curso->id_curso }}"
                                        @if ($curso->calificacion == '100') disabled @endif />

                                    <div class="peer-checked:bg-indigo-600 peer-checked:text-white h-full py-2 px-2">
                                        <h2 class="uppercase text-sm">{{ $curso->nombre_curso }}</h2>
                                    </div>
                                </label>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        @endforeach
    @else
        sin cursos
    @endif


    {{-- ==================== CURSOS AVANZADOS O EXPERTOR POR TRABAJOS ============================= --}}
    @if (count($empleado->trabajos) >= 2)
        <div class="flex flex-col">
            @foreach ($empleado->trabajos as $indice => $trabajos)
                @if ($indice == $empleado->puesto)
                    @continue
                @endif

                @foreach ($trabajos as $trabajo)
                    <?php
                    $keysCursos = array_keys($trabajo['cursos']->toArray());
                    $keysCursos = array_unique($keysCursos);
                    ?>

                    {{-- =============================== LO UNICO QUE TENGO QUE CAMBIAR PARA QUE QUEDE ES ESTO ==================================== --}}
                    @foreach ($keysCursos as $tipo)
                        <table id="{{ $tipo }}">
                            <thead>
                                <tr class="bg-blue-800 border-[1px] text-white">
                                    <th class="w-full">{{ $tipo }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white w-full h-full grid overflow-auto grid-cols-[repeat(auto-fit,minmax(120px,1fr))]">
                                    @foreach ($trabajo['cursos'][$tipo] as $curso)
                                        <td
                                            class="w-full h-full border-[1px]  text-black @if ($curso->calificacion == '100') bg-green-300 @endif @if($curso->calificacion > '0' && $curso->calificacion < '100') bg-yellow-300 @endif @if($curso->calificacion <= '0') bg-red-500 @endif ">
                                            <label class="w-full h-full cursor-pointer block overflow-hidden">
                                                <input class="hidden peer" type="checkbox" name="cursos[]"
                                                    value="usuario_id:{{ $id }}-curso_id:{{ $curso->id_curso }}"
                                                    @if ($curso->calificacion == '100') disabled @endif />

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

                    {{-- ===================== FIN DE LO QUE TENGO QUE CAMBIAR  ======================== --}}
                @endforeach
            @endforeach
    @endif
@else
    sin cursos
@endif
