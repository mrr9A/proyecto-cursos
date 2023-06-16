<form action="{{ route('calificaciones.store') }}" method="POST">
    @csrf
    <table id="tabla1" class="uppercase h-full  mx-4 my-2 border-[2px] border-black">
        <thead class="bg-blue-800 text-white border-[1px] border-black">
            <tr class="border-b-[2px] border-black">
                <th scope="col" class="w-1/12 border-[2px] border-black">Personal</th>
                <th scope="col" class="border-[2px] border-black">Puesto</th>
                <th scope="col" class="border-[1px] border-black">Trabajos</th>
                <th scope="col" class="w-full border-[2px] border-black">plan de formacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr class="border-b-[2px] border-black">
                    <td class="w-1/12 h-full border-[2px] border-black text-black">
                        <label class="w-full h-full cursor-pointer block overflow-hidden">
                            <input class="hidden peer" type="checkbox" name="empleado"
                                value="{{ $empleado->id_usuario }}" />
                            <div
                                class="flex items-center peer-checked:bg-input peer-checked:text-white h-full py-2 px-2 ">
                                <h2 class="uppercase text-sm ">{{ $empleado->empleado }}</h2>
                            </div>
                        </label>
                    </td>

                    <td class="py-2 px-2.5">{{ $empleado->puesto ?? 'sin puesto' }}</td>
                    <td class="w-1/12 h-full border-r-[1px] border-l-[2px] border-black">
                        <div class="flex flex-col justify-evenly flex-1 h-full">
                            <?php
                            $keys = array_keys($empleado->trabajos);
                            ?>
                            @foreach ($keys as $trabajo)
                                <p class="flex-1 border-b-[1px] border-black border-collapse py-2 px-2.5">
                                    {{ $trabajo ?? 'sin trabajos' }}</p>
                            @endforeach
                        </div>
                    </td>
                    {{-- bg-white w-full h-full grid grid-cols-[repeat(auto-fit,minmax(120px,1fr)) --}}
                    <td class="w-full h-full  grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] m-0 p-0">
                        {{-- CAMPONENTE QUE RENDERIZA LOS CURSOS  --}}
                        @if (request()->has('q') == 'tecnico')
                            <x-tables.table-curses-tecnica :empleado="$empleado" :id="$empleado->id_usuario" :keys="$keys" />
                        @else
                            <x-tables.table-curses :cursos="$empleado->trabajos[$keys[0]][0]" :id="$empleado->id_usuario" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-input-submit text="enviar" />
</form>
