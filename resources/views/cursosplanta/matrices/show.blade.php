<x-app title="{{ $data->nombre }}">
    <div class="flex items-start gap-3">
        <div class="w-[75%] mt-2">
            <h2 class="text-subtitle -mt-5 italic">{{ $data->puesto }}</h2>
            <div class="bg-blue-100 py-2 px-4 rounded-md text-sm font-semi-bold">
                Puedes calificar los cursos del 1 al 100 en caso de ser necesario. Si quieres calificar los
                cursos al como aprobados y el progreso al 100% te recomiendo ir a la pagina princial de matrices
            </div>

            <div>
                <div class="flex flex-wrap">
                    <div class="flex items-center mr-4">
                        <input id="red-radio" type="checkbox" value="20" name="colored-radio" checked disabled
                            class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="red-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No
                            aprobado</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input id="green-radio" type="checkbox" value="50" name="colored-radio" checked disabled
                            class="w-4 h-4 text-green-300 bg-gray-100 border-gray-300 focus:ring-green-300 dark:focus:ring-green-300 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="green-radio"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">completado</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input checked id="purple-racheckboxdio" type="checkbox" value="60" name="colored-radio"
                            checked disabled
                            class="w-4 h-4 text-yellow-300 bg-gray-100 border-gray-300 focus:ring-yellow-300 dark:focus:ring-yellow-300 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="purple-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">En
                            progreso</label>
                    </div>
                </div>
            </div>



        </div>
        <div class="container-resumen bg-white py-2 px-4 w-[25%] rounded-sm border-1 shadow-all">
            <h3 class="font-semi-bold text-section-subtitle">Resumen</h3>
            <p class="font-regular">Total de cursos: <span>{{ $data->totalCursos }}</span></p>
            <p class="font-regular">Cursos aprobados: <span>{{ $data->cursosPasados }}</span></p>
            <p class="font-regular">Progreso: <span>{{ $data->progreso }} %</span></p>
        </div>
    </div>

    <form class="mb-6 mt-2" method="POST" action="{{ route('calificaciones.update', $data->id_usuario) }}">
        @csrf
        @method('PATCH')

        <div class="">
            <div class="shadow-all min-h-[67%] h-auto px-4 py-4 rounded-md bg-white">
                <div class="flex items-center justify-between">
                    <h2 class="text-section-subtitle font-semi-bold">Cursos</h3>
                        <x-input-submit text="calificar" />
                </div>
                @foreach ($data->trabajos as $trabajo)
                    <?php
                    $keys = array_keys($trabajo['cursos']->toArray());
                    ?>
                    <div>
                        <div>
                            <h3 class="text-base font-semi-bold text-gray-700">trabajo: {{ $trabajo['trabajo'] }}
                            </h3>
                        </div>
                        <div class="flex gap-4">
                            @if (count($keys) > 0)
                                @foreach ($keys as $key)
                                    <div class="">
                                        <p class="font-bold uppercase">{{ $key }}</p>
                                        <div class="grid gap-3">
                                            @foreach ($trabajo['cursos'][$key] as $cursos)
                                                <div
                                                    class="flex items-center justify-between gap-3  rounded-md overflow-hidden py-1 px-2 @if ($cursos->estado == 0) bg-red-300 @endif @if ($cursos->calificacion == '100' && $cursos->estado == 1) bg-green-300 @else bg-blue-50 @endif @if ($cursos->calificacion > '0' && $cursos->calificacion <= '100' && $cursos->estado == 2) bg-yellow-300 @else bg-blue-50 @endif ">
                                                    <p class="uppercase text-sm">
                                                        {{ $cursos->curso }}
                                                    </p>
                                                    <div class="flex items-end gap-1">
                                                        <input type="number"
                                                            class="w-[65px] border-t-0 border-x-0 border-b-2 font-semi-bold  @if ($cursos->estado == 0) bg-red-300 @endif @if ($cursos->calificacion == '100' && $cursos->estado == 1) bg-green-300 @else bg-blue-50 @endif @if ($cursos->calificacion > '0' && $cursos->calificacion <= '100' && $cursos->estado == 2) bg-yellow-300 @else bg-blue-50 @endif "
                                                            name="cursos[{{ $cursos->id_curso }}]" {{-- value="{{ is_null($cursos->calificacion) ? 0 : $cursos->calificacion }}" --}}
                                                            value="{{ ($cursos->calificacion ?? '') != '' ? $cursos->calificacion : 0 }}"
                                                            min="0" max="100" />


                                                        <select name="estado[{{ $cursos->id_curso }}]"
                                                            class="text-sm border-b-2 border-x-0 border-t-0 py-2 bg-blue-50 s @if ($cursos->estado == 0) bg-red-300 @endif @if ($cursos->calificacion == '100' && $cursos->estado == 1) bg-green-300 @else bg-blue-50 @endif @if ($cursos->calificacion > '0' && $cursos->calificacion <= '100' && $cursos->estado == 2) bg-yellow-300 @else bg-blue-50 @endif ">
                                                            @foreach ($opciones as $key => $opcion)
                                                                <option value="{{ $key }}"
                                                                    @if ($cursos->estado == $key) selected @endif>
                                                                    {{ $opcion }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-title">Sin cursos asignados</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
</x-app>
