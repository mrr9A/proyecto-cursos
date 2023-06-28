<form action="{{ route('calificaciones.store') }}" method="POST">
    @csrf
    <div class="flex justify-between items-center">
        <p>Para cambiar la calificacion del usuario solo seleccione los cursos a calificar como aprovado y a
            enviar<br>Si desea calificar los cursos del usuario por porgreso tiene que ir al detalle</p>

        <div>
            <div class="flex flex-wrap">
                <div class="flex items-center mr-4">
                    <input id="red-radio" type="radio" value="20" name="colored-radio"
                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="red-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Red</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="green-radio" type="radio" value="50" name="colored-radio"
                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="green-radio"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Green</label>
                </div>
                <div class="flex items-center mr-4">
                    <input checked id="purple-radio" type="radio" value="60" name="colored-radio"
                        class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="purple-radio"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Purple</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="teal-radio" type="radio" value="100" name="colored-radio"
                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="teal-radio"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">verde</label>
                </div>
            </div>

        </div>
        <x-input-submit text="Calificar" />
    </div>

    <div>
        {{ $empleados['links'] }}
    </div>

    <table id="tabla1" class="uppercase min-w-full leading-normal my-2 border-collapse">
        <thead class="border-b  dark:border-neutral-500 uppercase">
            <tr
                class="px-5 border-b-2 border-gray-200 bg-primary text-left text-base font-semibold text-white uppercase tracking-wider">
                <th scope="col" class="px-6 py-2 border-r-2">Personal</th>
                <th scope="col" class="px-6 py-2 border-r-2">Puesto</th>
                <th scope="col" class="px-6 py-2 border-r-2">Trabajos</th>
                <th scope="col" class="w-full px-6 py-2">plan de formacion</th>
                <th><i class='bx bx-cog'></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados['usuarios'] as $empleado)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="w-1/12 min-h-full border-r-2">
                        <label class="w-full min-h-full cursor-pointer block overflow-hidden">
                            <input class="hidden peer" type="checkbox" name="empleado"
                                value="{{ $empleado->id_usuario }}" />
                            <div
                                class="flex items-center peer-checked:bg-input peer-checked:text-white h-full py-2 px-2 ">
                                <h2 class="uppercase text-sm">{{ $empleado->empleado }}</h2>
                            </div>
                        </label>
                    </td>

                    <td class="py-2 px-2.5 uppercase text-sm border-r-2">{{ $empleado->puesto ?? 'sin puesto' }}</td>
                    <td class="w-1/12 h-full  border-r-2">
                        <div class="flex flex-col justify-evenly flex-1 h-full ">
                            <?php
                            $keys = array_keys($empleado->trabajos);
                            ?>
                            @foreach ($keys as $trabajo)
                                <p
                                    class="uppercase text-sm flex-1 border-b-[1px] border-gray-200 border-collapse py-2 px-2.5 @if ($trabajo == $empleado->puesto && count($empleado->trabajos) > 1) hidden @endif">
                                    {{ $trabajo ?? 'sin trabajos' }}</p>
                            @endforeach
                        </div>
                    </td>
                    <td class="w-full h-full  grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] m-0 p-0">
                        {{-- CAMPONENTE QUE RENDERIZA LOS CURSOS  --}}
                        {{-- @if (request()->q == 'tecnico') --}}
                            <x-tables.table-curses-tecnica :empleado="$empleado" :id="$empleado->id_usuario" :keys="$keys" />
                        {{-- @else --}}
                            {{-- <x-tables.table-curses :cursos="$empleado->trabajos[$keys[0]][0] ?? $empleados->trabajos" :id="$empleado->id_usuario" /> --}}
                        {{-- @endif --}}
                    </td>
                    <td>
                        <a href="{{route("matrices.show", $empleado->id_usuario)}}">
                            <i class='bx bx-show-alt' ></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</form>
