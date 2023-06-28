<x-app title="{{ $data->nombre }}">
    <h2 class="text-subtitle -mt-5 italic">{{ $data->puesto }}</h2>
    <form class="mb-6" method="POST" action="{{route('calificaciones.update', $data->id_usuario)}}">
      @csrf
      @method('PATCH')
        <div class="container-resumen">
            <h3>Resumen</h3>
            <span>Total de cursos: <span>{{ $data->totalCursos }}</span></span>
            <span>Cursos pasados: <span>{{ $data->cursosPasados }}</span></span>
            <span>Progreso: <span>{{ $data->progreso }} %</span></span>
        </div>
        <div class="">
            <div class="flex justify-between mt-4">
                <div>
                    Puedes calificar los cursos del uno al 100, en caso de ser necesario, si quieres calificar los
                    cursos al 100 te recomiendo ir a la pagina princial de matrices
                </div>
                <x-input-submit text="calificar" />
            </div>
            <h2 class="text-section-subtitle font-semi-bold">Cursos</h3>
                <div>
                    @foreach ($data->trabajos as $trabajo)
                        <?php
                        $keys = array_keys($trabajo['cursos']->toArray());
                        ?>
                        <div>
                            <div>
                                <h3 class="font-regular text-base">trabajo: {{ $trabajo['trabajo'] }}</h3>
                            </div>
                            <div>
                                @foreach ($keys as $key)
                                    <div class="grid grid-cols-2">
                                        <p class="font-bold uppercase">{{ $key }}</p>
                                    </div>
                                    <div class="grid grid-cols-6 gap-2 items-center">
                                        @foreach ($trabajo['cursos'][$key] as $cursos)
                                            <p
                                                class="@if ($cursos->calificacion == '100') aprovado @else reprovado @endif uppercase text-sm">
                                                {{ $cursos->curso }}
                                            </p>
                                            <input type="number" class="w-[80px]" name="cursos[{{$cursos->id_curso}}]"
                                                {{-- value="{{ is_null($cursos->calificacion) ? 0 : $cursos->calificacion }}" --}}
                                                value="{{$cursos->calificacion ?? ''}}"
                                                min="0" max="100" />
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </form>
</x-app>
