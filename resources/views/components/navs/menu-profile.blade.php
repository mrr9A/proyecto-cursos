<div class="w-9 h-9 bg-primary rounded-full overflow-hidden">
    {{-- put your image here --}}
    <img src="https://randomuser.me/api/portraits/lego/5.jpg" alt="image-profile" class="w-full h-full object-cover block" />
</div>
<ul>
    <li>
        <a>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                    <circle cx="8" cy="2.5" r=".75" />
                    <circle cx="8" cy="8" r=".75" />
                    <circle cx="8" cy="13.5" r=".75" />
                </g>
            </svg>
        </a>
    </li>
</ul>

<!-- Dropdown menu -->
<div id="dropdownInformation" class="z-10 hidden text-white bg-primary divide-y divide-gray-100 rounded-lg shadow-lg w-52 dark:bg-gray-700 dark:divide-gray-600">
    <div class="mr-2 px-4 py-3 text-sm  dark:text-white">
        <h2>{{Auth()->user()->nombre}} {{Auth()->user()->segundo_nombre}} {{Auth()->user()->apellido_paterno}} {{Auth()->user()->apellido_materno}}</h2>
        <p style="" class="first-letter font-medium truncate">{{Auth()->user()->email}}</p>
    </div>
    <div class="py-2 w-full">
        <form action="{{ route('logout') }}" method="POST" class="min-w-full">
            @csrf
            <button type="submit" class="block w-full px-4 py-2 text-sm  hover:bg-gray-600 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Cerrar sesión</button>
        </form>
    </div>
</div>