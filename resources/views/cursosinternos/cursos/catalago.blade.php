<x-app title="Catalago de Cursos:">
    <div>
        <x-search.search-input route="curs.index"></x-search.search-input>
        <div class="p-12">
            <a type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{route('crearCurso')}}">
                <img src="./img/agregar-usuario.png" alt=""><span>Agregar Curso</span>
            </a><br>
            <div class="block max-w p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="text-subtitle font-bold">
                    Cursos
                </div><br>
                <div class="card-body px-0 pt-0 pb-2">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Imagen
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre Completo del Curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Codígo del Curso
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fecha de Inicio
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fecha de Termino
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Configuración
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $curso)
                                @if($curso->interno_planta == 1)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-800 text-center">
                                    <td class="inline-block ">
                                        <img src="{{$curso->imagen}}" width="50" height="50">
                                    </td>
                                    <td class="py-4 font-bold">
                                        {{$curso->nombre}}
                                    </td>
                                    <td class=" font-bold">
                                        {{$curso->codigo}}
                                    </td>
                                    <td class=" font-bold">
                                        {{$curso->fecha_inicio}}
                                    </td>
                                    <td class=" font-bold">
                                        {{$curso->fecha_termino}}
                                    </td>
                                    <td class=" text-center ">
                                        <a href="{{url('curs',[$curso])}}" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg   dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="32" viewBox="0 0 512 560">
                                                <path fill="currentColor" d="m184.785 471.562l76.992-115.487l-76.992-115.487h57.743l76.993 115.487l-76.993 115.487h-57.743zm76.992 0l76.992-115.487l-76.992-115.487h57.744l153.982 230.974h-57.744l-48.118-72.178l-48.12 72.178h-57.744zm186.063-67.366L422.178 365.7l89.822-.003v38.498h-64.16zm-38.495-57.744l-25.665-38.495l128.32-.002v38.497H409.345zM169.028 176.54c50.881-29.318 112.082-6.227 135.345 41.445h65.802a154.223 154.223 0 0 0-13.278-33.034l35.475-62.993L357.014 86.6l-62.4 35.654a161.966 161.966 0 0 0-31.679-13.54l-18.869-68.275h-50.09l-18.337 66.874c-11.728 3.226-23.355 7.903-34.692 14.143L81.52 88.072L46.161 123.43l32.976 58.956c-6.21 11.113-10.972 22.86-14.3 34.948L0 236.378v50.09l65.185 17.707a156.965 156.965 0 0 0 14.572 34.737l-32.122 60.013l35.357 35.358l59.415-34.709c8.687 4.668 29.805 12.987 48.128 18.3l41.032-61.799C130.288 370.491 75.488 230.436 169.028 176.54z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('eliminado') == 'Eliminado Correctamente')
<script>
    Swal.fire(
        'Eliminado!',
        'Eliminado Correctamente',
        'success'
    )
</script>
@endif

@if (session('actualizado') == 'Actualizado Correctamente')
<script>
    Swal.fire(
        'Actualizado!',
        'Actualizado Correctamente',
        'success'
    )
</script>
@endif

@if (session('agregado') == 'Agregado Correctamente')
<script>
    Swal.fire(
        'Agregado Correctamente!',
        'Terminalo de Configurar en el apartado de configuraciones de los Cursos!!!!',
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
                title: 'Estas Seguro de Eliminar este Curso',
                text: "Si lo Eliminas no lo podras Recuperar",
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
</script>