<x-app title="{{ $data->nombre }}">
    <div class="flex items-start gap-3">
        <div class="w-[75%]">
            <h2 class="text-subtitle -mt-5 italic">{{ $data->puesto }}</h2>
            <div class="bg-blue-100 py-2 px-4 rounded-md text-sm font-semi-bold">
                Puedes calificar los cursos del uno al 100, en caso de ser necesario, si quieres calificar los
                cursos al 100 te recomiendo ir a la pagina princial de matrices
            </div>
        </div>
        <div class="container-resumen bg-white py-2 px-4 w-[25%] rounded-sm border-1 shadow-all">
            <h3 class="font-semi-bold text-section-subtitle">Resumen</h3>
            <p class="font-regular">Total de cursos: <span>{{ $data->totalCursos }}</span></p>
            <p class="font-regular">Cursos pasados: <span>{{ $data->cursosPasados }}</span></p>
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
                                                    class="flex items-center justify-between gap-3  rounded-md overflow-hidden py-1 px-2 @if ($cursos->calificacion == '100') bg-green-300 @else bg-blue-50 @endif">
                                                    <p class="uppercase text-sm">
                                                        {{ $cursos->curso }}
                                                    </p>
                                                    <input type="number"
                                                        class="w-[80px] border-t-0 border-l-0 border-r-0 font-semi-bold @if ($cursos->calificacion == '100') bg-green-300 @else bg-blue-50 @endif"
                                                        name="cursos[{{ $cursos->id_curso }}]" {{-- value="{{ is_null($cursos->calificacion) ? 0 : $cursos->calificacion }}" --}}
                                                        value="{{ ($cursos->calificacion ?? '') != '' ? $cursos->calificacion : 0 }}"
                                                        min="0" max="100" />
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
