<form class="flex items-center" action="{{ route('curs.show', $curso->id_curso) }}" method="GET" id="search-users">
    <label for="simple-search" class="sr-only">Buscar</label>
    <div class="relative w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
            </svg>
        </div>
        <input type="text" id="usuarios_agregar" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar usuario por nombre..." required>
    </div>
    <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
        <span class="sr-only">Buscar</span>
    </button>
</form>


<form class="space-y-6" action="{{url('curs')}}" method="POST">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div>
            <label for="fecha_termino" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha termino</label>
            <input type="date" id="fecha_termino" name="fecha_termino" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
    </div>
    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton" id="resultados_usuarios">
        <h3>Resultados de la búsqueda:</h3>
        <!-- aqui muestra los usuarios del buscador -->
        <br>
        @foreach($usuarios as $usuario)
        @if($usuario->rol == 1)
        <li class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
            <input hidden type="text" name="curso_id" value="{{$curso->id_curso}}">
            <input id="checkbox-item-11" type="checkbox" name="usuarios[]" value="{{$usuario->id_usuario}}" @foreach($curso->usuarioCurso as $user) {{{ $usuario->id_usuario == $user->id_usuario ? "disabled class=bg-green-500" : ""  }}} @endforeach class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" >
            <label for="checkbox-item-11" class="w-full ml-2 text-sm font-medium capitalize text-gray-900 rounded dark:text-gray-300">{{$usuario->apellido_paterno}} {{$usuario->apellido_materno}} {{$usuario->nombre}} {{$usuario->segundo_nombre}} </label>
        </li><br>
        @endif
        @endforeach

    </ul>
    <button class="flex  lg:px-28 p-3 text-sm font-medium text-blue-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
        <span>
            <svg class="w-5 h-5 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
            </svg>
        </span>
        Agregar usuarios
    </button>
</form>

<script>
    const searchUsersForm = $('#search-users')
    const inputS = $('#usuarios_agregar')
    const resultadosUsuarios = $('#resultados_usuarios')

    searchUsersForm.addEventListener('submit', (e)=>{
        e.preventDefault();
        console.log()
        getUsers(inputS.value)
    })
    

    function getUsers(texto){
        fetch(`${API_URL}/usuarios?search=${texto}&curso_id={{$curso->id_curso}}`)
        .then(res => res.json())
        .then(data => {
            console.log(data.data)
            let dataLi = ''
            data.data.forEach(element => {
                dataLi += `
                <li id="resultados_usuarios" class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
            <input hidden type="text" name="curso_id" value="{{$curso->id_curso}}">
            <div>
                <input id="checkbox-item-11" type="checkbox" name="usuarios[]" value="${element.id_usuario}"  ${ element.inscrito == 1 ? "disabled class=bg-green-500" : ""} class="w-4 h-4 text-blue-600 bg-gray-100 capitalize border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" >
                <label for="checkbox-item-11" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                    ${element.nombre + ' '  + ' ' + element.apellido_paterno + ' '}
                </label>
            </div>
        </li><br>
                `
            });

            resultadosUsuarios.innerHTML = dataLi 
        })
        .catch(e => console.log(e))
    }
</script>