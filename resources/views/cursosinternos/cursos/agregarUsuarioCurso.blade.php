<form class="space-y-6" action="{{url('curs')}}" method="POST">
                    @csrf
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
                        @foreach($usuarios as $usuario)
                        <li class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                            <input hidden type="text" name="curso_id" value="{{$curso->id_curso}}">
                            <div>
                                <input id="checkbox-item-11" type="checkbox" name="usuarios[]" value="{{$usuario->id_usuario}}" @foreach($curso->usuarioCurso as $user) {{{ $usuario->id_usuario == $user->id_usuario ? "disabled class=bg-green-500" : ""  }}} @endforeach class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                                <label for="checkbox-item-11" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{$usuario->apellido_paterno}} {{$usuario->apellido_materno}} {{$usuario->nombre}} {{$usuario->segundo_nombre}} </label>
                            </div>
                        </li><br>
                        @endforeach
                    </ul>
                    <button class="flex  lg:px-28 p-3 text-sm font-medium text-blue-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
                        <span>
                            <svg class="w-5 h-5 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
                            </svg>
                        </span>
                        Agregar Usuarios
                    </button>
                </form>