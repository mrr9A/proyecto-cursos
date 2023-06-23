<x-app title="Sucursales">
    <div class="">
        <div class="flex items-center justify-between mb-4 mt-6">

            <p class="font-regular text-base">Lista de todas las sucursales agregadas</p>
            <x-modal title="Crear sucursal" textButton="Agregar Sucursal" id="crear_sucursal"
                vistaContenidoModal="sucursales.create" />
        </div>
        <div class="my-5">
            <table class="min-w-full">
                <thead class="border-b uppercase bg-blue-200 text-left">
                    <tr>
                        <th class="px-6 py-2">Sucursal</th>
                        <th class="px-6 py-2">Dirección</th>
                        <th class="px-6 py-2">Estatus</th>
                        <th class="px-6 py-2 text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody class="uppercase">
                    @foreach ($sucursales as $sucursal)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-2 flex items-center gap-2"> <i
                                    class='bx bx-buildings'></i>{{ $sucursal->nombre }}</td>
                            <td class="whitespace-nowrap px-6 py-2 ">{{ $sucursal->ciudad }}</td>
                            <td class="whitespace-nowrap px-6 py-2 ">
                                @if ($sucursal->estado == 1)
                                    <span class="inline-block w-4 h-4 bg-green-400 rounded-full"></span>
                                @elseif ($sucursal->estado == 0)
                                    <span class="inline-block w-4 h-4 bg-gray-400 rounded-full"></span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-2 py-2 ">
                                <div class="flex items-center gap-4 justify-center">
                                    <x-modal icon="bx bx-edit" title="Editar sucursal"
                                        id="editar_sucursal{{ $sucursal->id_sucursal }}" :sucursale="$sucursal"
                                        vistaContenidoModal="sucursales.edit"
                                        class="bg-white text-blue-600  hover:bg-blue-100 hover:rounded-md hover:text-blue-400" />
                                    {{-- <a href="{{ route('sucursales.edit', $sucursal) }}"
                                        class="text-blue-600 hover:bg-blue-100 hover:rounded-md hover:text-blue-400">
                                        <i class='bx bx-edit '></i>
                                    </a> --}}
                                    <form action="{{ url('sucursales', [$sucursal]) }}" method="POST"
                                        class="formulario-eliminar" id="{{ $sucursal->nombre }}">

                                        @method('DELETE')
                                        @csrf

                                        <button type="submit"
                                            class="btn text-center text-red-600 hover:bg-red-100 hover:rounded-md hover:text-red-400">
                                            <i class='bx bx-trash '></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('eliminado') == 'Eliminado correctamente')
    <script>
        Swal.fire(
            'Eliminado!',
            'Eliminado correctamente',
            'success'
        )
    </script>
@endif

@if (session('actualizado') == 'Actualizado correctamente')
    <script>
        Swal.fire(
            'Actualizado!',
            'Actualizado correctamente',
            'success'
        )
    </script>
@endif

@if (session('agregado') == 'Agregado correctamente')
    <script>
        Swal.fire(
            'Agregado!',
            'Agregado correctamente',
            'success'
        )
    </script>
@endif

<script>
    const forms = document.querySelectorAll(".formulario-eliminar")

    forms.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas seguro de eliminar esta sucursal',
                text: "Si lo eliminas no lo podras recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado Correctamente',
                        'error'
                    )
                }
            })
        });
    })

    const formActualizar = document.querySelectorAll(".formulario-actualizar")

    formActualizar.forEach(form => {
        form.addEventListener("submit", (e) => {
            console.log('Hola');
            e.preventDefault();

            swal.fire({
                title: 'Estas Seguro de Actualizar esta Sucursal',
                text: "Se actualizarán los Datos Seleccionados",
                icon: 'dark',
                showCancelButton: true,
                confirmButtonColor: '#3e5f8a',
                cancelButtonColor: '#252850',
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Cancelado',
                        'Cancelado Correctamente',
                        'error'
                    )
                }
            })
        });
    })
</script>
