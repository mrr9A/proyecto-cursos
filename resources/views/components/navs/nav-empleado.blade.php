<div class="flex items-center md:order-2">
    <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex items-center font-medium justify-center px-4 py-2 text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512 512">
            <path fill="#012254" d="M64 144h226.75a48 48 0 0 0 90.5 0H448a16 16 0 0 0 0-32h-66.75a48 48 0 0 0-90.5 0H64a16 16 0 0 0 0 32Zm384 224h-66.75a48 48 0 0 0-90.5 0H64a16 16 0 0 0 0 32h226.75a48 48 0 0 0 90.5 0H448a16 16 0 0 0 0-32Zm0-128H221.25a48 48 0 0 0-90.5 0H64a16 16 0 0 0 0 32h66.75a48 48 0 0 0 90.5 0H448a16 16 0 0 0 0-32Z" />
        </svg>
        Perfil
    </button>
    <!-- Dropdown -->
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 cursor-text" id="language-dropdown-menu">
        <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white">@auth {{Auth::user()->nombre}} {{Auth::user()->segundo_nombre}} {{Auth::user()->apellido_paterno}} {{Auth::user()->apellido_materno}} @endauth </span>
            <span class="block text-sm  text-gray-700 lowercase dark:text-gray-400">@auth {{Auth::user()->email}} @endauth</span>
        </div>
        <ul class="py-2 font-medium" role="none">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        <div class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="#012254">
                                    <path fill-rule="evenodd" d="M16.125 12a.75.75 0 0 0-.75-.75H4.402l1.961-1.68a.75.75 0 1 0-.976-1.14l-3.5 3a.75.75 0 0 0 0 1.14l3.5 3a.75.75 0 1 0 .976-1.14l-1.96-1.68h10.972a.75.75 0 0 0 .75-.75Z" clip-rule="evenodd" />
                                    <path d="M9.375 8c0 .702 0 1.053.169 1.306a1 1 0 0 0 .275.275c.253.169.604.169 1.306.169h4.25a2.25 2.25 0 0 1 0 4.5h-4.25c-.702 0-1.053 0-1.306.168a1 1 0 0 0-.275.276c-.169.253-.169.604-.169 1.306c0 2.828 0 4.243.879 5.121c.878.879 2.292.879 5.12.879h1c2.83 0 4.243 0 5.122-.879c.879-.878.879-2.293.879-5.121V8c0-2.828 0-4.243-.879-5.121C20.617 2 19.203 2 16.375 2h-1c-2.829 0-4.243 0-5.121.879c-.879.878-.879 2.293-.879 5.121Z" />
                                </g>
                            </svg>
                            <span class="mx-3">Cerrar sesión </span>
                        </div>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<div class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
    <ul class="flex flex-col font-semi-bold  p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 mx-24 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
            <a href="{{route('inicioEmpleado')}}" class="{{ request()->routeIs('cursosEmpleados.*','verContenido','verExamenempleado','validarExamenempleado') ? 'hidden' : '' }} block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Inicio</a>
        </li>
    </ul>
    <div class="{{ request()->routeIs('cursosEmpleados.*','verContenido','verExamenempleado','validarExamenempleado') ? 'hidden' : '' }}">
    <x-search.search-empleado route={{$route}}/>
    </div>
</div>