<form action="{{ route('calificaciones.store') }}" method="POST">
    @csrf
    <table id="tabla1" class="uppercase  mx-4 my-2 border-[2px] border-black">
        <thead class="bg-blue-800 text-white border-[1px] border-black">
            <tr>
                <th scope="col" class="w-2/12">Personal</th>
                <th scope="col" class="">Puesto</th>
                <th scope="col" class="w-full">plan de formacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr class="border-b-[2px] border-black">
                    <td
                        class="border-[1px]  text-black">
                        <label class="w-full h-full cursor-pointer block overflow-hidden">
                            <input class="hidden peer" type="checkbox" name="empleado" value="{{ $empleado->id_usuario }}" />

                            <div class="peer-checked:bg-input h-full py-2 px-2">
                                <h2 class="uppercase text-sm">{{ $empleado->empleado }}</h2>
                            </div>
                        </label>
                    </td>
                    <td class="border-r-[1px] border-black">{{ $empleado->puesto ?? 'sin puesto' }}</td>
                    <td class="w-full grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] m-0 p-0">
                        {{-- CAMPONENTE QUE RENDERIZA LOS CURSOS  --}}
                        <x-tables.table-curses :empleado="$empleado" :id="$empleado->id_usuario"/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-input-submit text="enviar" />
</form>
