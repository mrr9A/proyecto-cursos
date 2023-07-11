<x-app title="generar reportes por Cursos">

    <form action="{{ route('reportesinternos.index') }}" method="GET">
        @method('GET')
        <div class=" flex gap-4 flex-wrap items-end">
            <div class="form-group">
                <label for="curso_id">Seleccionar Curso:</label>
                <select name="curso_id" id="curso_id" class="form-control">
                    <option value="">Seleccione un curso</option>
                    @foreach($cursos as $curso)
                    @if($curso->interno_planta == 1)
                    <option value="{{ $curso->id_curso }}">{{ $curso->nombre }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <x-input-submit text="Filtrar" class="max-h-[40px]" />
        </div>
    </form>
    @if(count($calificacionesCursos) > 0)

    <div class="mt-4 ">

        <div class="flex justify-end">
            <a href="{{ route('reportesinternos.index', array_merge(request()->query(), ['export' => 1])) }}" class="inline-block bg-blue-800 py-1.5 px-2 text-white font-bold rounded-md self-end">
                Exportar datos a Excel
            </a>
        </div>


        <table class="min-w-full leading-normal my-2">
            <thead class="border-b  dark:border-neutral-500 uppercase">
                <tr class="px-5 py-3 border-b-2 border-gray-200 bg-blue-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    <th scope="col" class="px-6 py-2 w-1/12">Codigo</th>
                    <th scope="col" class="px-6 py-2">Nombre del Curso</th>
                    <th scope="col" class="px-6 py-2 ">Nombre del Usuario</th>
                    <th scope="col" class="px-6 py-2 text-center">Estatús del Curso</th>
                    <th scope="col" class="px-6 py-2 text-center">Calificación</th>
                    <th scope="col" class="px-6 py-2 text-center">Progreso</th>
                </tr>
            </thead>
            <tbody class="">
            @foreach ($calificacionesCursos as $usuario)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario['cursoC']}}</td>
                        <td class="py-3 px-6 text-left">{{ $usuario['cursoN']}}</td>
                        <td class="py-3 px-6 text-left capitalize">{{ $usuario['usuarioN']}} {{ $usuario['usuarioSN']}} {{ $usuario['usuarioAP']}} {{ $usuario['usuarioAM']}}</td>
                        <td class="py-3 px-6 text-center">{{ $usuario['estado']}}</td>
                        <td class="py-3 px-6 text-center">{{ $usuario['calificacion']}}</td>
                        <td class="py-3 px-6 text-center">{{ $usuario['progreso']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    Sin resultados
    @endif

</x-app>