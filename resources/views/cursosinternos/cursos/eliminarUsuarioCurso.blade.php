<form class="flex items-center" action="{{ route('curs.show', $curso->id_curso) }}" method="GET">
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
            </svg>
        </div>
        <input hidden type="text" name="curso_id1" value="{{$curso->id_curso}}">
        <input type="text" id="simple-search" name="buscar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar Usuario por nombre..." required>
    </div>
    <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
        <span class="sr-only">Search</span>
    </button>
</form>


<form class="space-y-6" action="{{url('curs',$usuarios)}}" method="POST">
    @method("DELETE")
    @csrf
    @if ($resultados1)
        <h3>Resultados de la búsqueda:</h3>
        @foreach ($resultados1 as $resultado)
        <li class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
            <input hidden type="text" name="curso_id" value="{{$curso->id_curso}}">
            <div>
                <input id="checkbox-item-11" type="checkbox" name="usuarios[]" value="{{$resultado->id_usuario}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" >

                <label for="checkbox-item-11" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$resultado->apellido_paterno}} {{$resultado->apellido_materno}} {{$resultado->nombre}} {{$resultado->segundo_nombre}} </label>
            </div>
        </li><br>
        @endforeach
        @else
    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
        @foreach($curso->usuarioCurso as $userCurso)
        <li class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

            <input hidden type="text" name="curso_id" value="{{$curso->id_curso}}">
            <div>
                <input id="checkbox-item-11" type="checkbox" name="usuarios[]" value="{{$userCurso->id_usuario}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                <label for="checkbox-item-11" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$userCurso->apellido_paterno}} {{$userCurso->apellido_materno}} {{$userCurso->nombre}} {{$userCurso->segundo_nombre}} </label>
            </div>
        </li><br>
        @endforeach
        @endif
    </ul>
    <button class="flex  lg:px-28 p-3 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
        <span>
            <svg class="w-5 h-5 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
            </svg>
        </span>
        Eliminar Usuarios
    </button>
</form>