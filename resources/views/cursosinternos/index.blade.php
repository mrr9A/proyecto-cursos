<x-app>
    <div class="flex justify-between">
        <div class="mx-10 justify-end ">
            <x-search.search-input route="avances.index" placeholder="Buscar por Nombre..."></x-search.search-input>
        </div>
    </div>
    <br>
    <table class="w-full  text-gray-500 dark:text-gray-400">
        <thead class=" text-th-table-text uppercase bg-th-table dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Empleado
                </th>
                <th scope="col" class="px-6 py-3">
                    T. Cursos
                </th>
                <th scope="col" class="px-6 py-3">
                    aprobados
                </th>
                <th scope="col" class="px-6 py-3">
                    reprobados
                </th>
                <th scope="col" class="px-6 py-3">
                    Pendiente por iniciar
                </th>
                <th scope="col" class="px-6 py-3">
                    En curso
                </th>
                <th scope="col" class="px-6 py-3">
                    Progreso total
                </th>
                <th scope="col" class="px-6 py-3">
                    Ver detalles
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datosUsuarios as $usuario)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-800 text-center">
                <td class="py-4 font-bold text-start px-3 uppercase">
                    {{$usuario['nombre']}}
                    {{$usuario['nombreS']}}
                    {{$usuario['nombreAP']}}
                    {{$usuario['nombreAM']}}
                </td>
                <td class=" font-bold uppercase">
                    {{count($usuario['cursos'])}}
                </td>
                <td class=" font-bold uppercase">
                    {{$usuario['aprobado']}}
                </td>
                <td class=" font-bold uppercase">
                    {{$usuario['reprobados']}}
                </td>
                <td class=" font-bold uppercase">
                    {{$usuario['pendientes']}}
                </td>
                <td class=" font-bold uppercase">
                    {{$usuario['encurso']}}
                </td>
                <td class=" font-bold uppercase">
                    {{$usuario['progresoTotal']}}%
                </td>
                <td class=" text-center ">
                    <a href="{{url('Reporteavances', $usuario['id'])}}" type="button" target="_blank" class="hover:bg-btn-primary-light focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg   dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M19 21h-6a3 3 0 0 0-3 3v2h2v-2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2h2v-2a3 3 0 0 0-3-3zm-3-1a4 4 0 1 0-4-4a4 4 0 0 0 4 4zm0-6a2 2 0 1 1-2 2a2 2 0 0 1 2-2z" />
                            <path fill="currentColor" d="M25 5h-3V4a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v1H7a2 2 0 0 0-2 2v21a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2ZM12 4h8v4h-8Zm13 24H7V7h3v3h12V7h3Z" />
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app>