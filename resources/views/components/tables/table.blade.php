{{-- <form action="{{ route('calificaciones.store') }}" method="POST"> --}}
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
            <?php $contador = 1;?>
            @foreach ($empleados as $empleado)
                <tr class="border-b-[2px] border-black">
                    <input type="hidden" name="usuario_id[]" value="{{ $empleado->id_usuario }}">
                    <td class="border-r-[2px] border-black">{{ $empleado->empleado }}</td>
                    <td class="border-r-[1px] border-black">{{ $empleado->puesto ?? 'sin puesto' }}</td>
                    <td class="w-full grid grid-cols-[repeat(auto-fit,minmax(120px,1fr))] m-0 p-0">
                        {{-- CAMPONENTE QUE RENDERIZA LOS CURSOS  --}}

                        <x-tables.table-curses :empleado="$empleado" />

                    </td>

                    <input type="hidden" name="id_.''.<?php echo $contador; ?>" value="{{$empleado->id_usuario}}">
                    <?php $contador = $contador + 1; ?>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <x-buttons.form-input />ds --}}
{{-- </form> --}}