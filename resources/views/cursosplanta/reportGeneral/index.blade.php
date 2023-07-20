<x-app>
  @dump($data)
{{-- 
    @foreach ($progresoCursosSucursal as $sucursal)
        <?php
        $keysCursos = array_keys($sucursal['progresos']);
        ?>
        <div class="flex gap-2">
            <h2 class="max-w-[100px] w-[100px]">{{ $sucursal['sucursal'] }}</h2>
            @foreach ($keysCursos as $key)
                <div class="w-[200px]">
                    <h2 class="bg-blue-200 px-2 py-1 ">{{ $key }}</h2>
                    @if (count($sucursal['progresos'][$key]) > 0)
                        @foreach ($sucursal['progresos'][$key] as $k => $progreso)
                            <div class="flex flex-col gap-2 ">
                                <p>{{ $k }}</p>
                                <p>{{ $progreso }}</p>
                            </div>
                        @endforeach
                    @else
                    Sin registros anteriores
                    @endif
                </div>
            @endforeach
        </div> --}}
    {{-- @endforeach --}}
</x-app>
