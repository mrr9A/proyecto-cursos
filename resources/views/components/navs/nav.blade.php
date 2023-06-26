<nav class="sidebar close bg-nav max-w-[260px] h-[100vh] relative">
    <ul class="nav-links">
        <li class="nav-item">
            <button class="" id="menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <g fill="none">
                        <path
                            d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z" />
                        <path fill="currentColor"
                            d="M20 17.5a1.5 1.5 0 0 1 .144 2.993L20 20.5H4a1.5 1.5 0 0 1-.144-2.993L4 17.5h16Zm0-7a1.5 1.5 0 0 1 0 3H4a1.5 1.5 0 0 1 0-3h16Zm0-7a1.5 1.5 0 0 1 0 3H4a1.5 1.5 0 1 1 0-3h16Z" />
                    </g>
                </svg>
                <span class="hidden">Menu</span>
            </button>
        </li>
        <li class="nav-item">
            <a href="/" class="{{ request()->routeIs('home') ? 'item-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M12.707 2.293a1 1 0 0 0-1.414 0l-7 7l-2 2a1 1 0 1 0 1.414 1.414L4 12.414V19a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-6.586l.293.293a1 1 0 0 0 1.414-1.414l-9-9Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="hidden">Inicio</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('usuarios.index') }}" class="{{ request()->routeIs('usuarios.*') ? 'item-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 520 520"
                    preserveAspectRatio="xMaxYMax meet">
                    <circle cx="152" cy="184" r="72" fill="currentColor" />
                    <path fill="currentColor"
                        d="M234 296c-28.16-14.3-59.24-20-82-20c-44.58 0-136 27.34-136 82v42h150v-16.07c0-19 8-38.05 22-53.93c11.17-12.68 26.81-24.45 46-34Z" />
                    <path fill="currentColor"
                        d="M340 288c-52.07 0-156 32.16-156 96v48h312v-48c0-63.84-103.93-96-156-96Z" />
                    <circle cx="340" cy="168" r="88" fill="currentColor" />
                </svg>
                <span class="hidden">Usuarios</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('puestos.index') }}" class="{{ request()->routeIs('puestos.*') ? 'item-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4 21q-.825 0-1.413-.588T2 19V8q0-.825.588-1.413T4 6h4V4q0-.825.588-1.413T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.588 1.413T20 21H4Zm6-15h4V4h-4v2Z" />
                </svg>
                <span class="hidden">Puestos</span>
            </a>
        </li>

        <li class="nav-item">
            <div class="flex items-center justify-between  {{ request()->routeIs('cursos.*') ? 'item-active' : '' }}">
                <a href="{{ route('cursos.index') }}"
                    class="{{ request()->routeIs('cursos.*') ? 'item-active' : '' }} flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 66 66">
                        <path fill="currentColor"
                            d="m57.063 20.218l1.029-1.698s.906-1.502.906-3.519c0-4.886-4.662-4.757-4.662-4.757L44.179 7.479L38.638 2l-7.291 1.985l-2.391-.651l-1.817 1.797l-10.497 2.858s-4.04-.111-4.04 4.123c0 1.748.786 3.05.786 3.05l1.351 2.23l-1.187 1.172l-5.86 1.596s-4.662-.129-4.662 4.757a7.56 7.56 0 0 0 .779 3.281L2 29.987l.949.376c.021.051.029.108.07.149c1.835 1.839 1.684 4.309 1.422 5.643l-1.109 1.111l8.401 4.039L23.271 60.35c1.849 2.906 5.774 1.088 5.774 1.088l29.649-14.256l-1.109-1.111c-.262-1.334-.413-3.804 1.422-5.644c.041-.041.049-.098.07-.148l.949-.377l-5.513-5.45l6.33-3.043l-.961-.963c-.227-1.156-.358-3.297 1.233-4.891c.035-.036.041-.084.06-.129l.825-.327l-4.937-4.881m-5.685-8.835l-1.25 1.978l-3.234-3.198l4.484 1.22M39.176 7.144l4.643 4.963l-16.789 6.067l-3.965-6.156l16.111-4.874M15.744 19.052l11.457 18.911l-21.827-8.658l10.37-10.253m-4.775 2.067l-1.345 1.33l-.538-.825l1.883-.505m-4.247 1.034l1.252 1.927l-2.713 2.682a5.586 5.586 0 0 1-.331-1.845c0-1.826.906-2.521 1.792-2.764M5.154 37.026l.015-.058l25.147 11.007l-24.95-11.894c.023-.135.041-.284.06-.434l19.533 8.18l-19.465-9.116a7.723 7.723 0 0 0-.086-1.245l18.079 7.445L5.165 32.4a6.048 6.048 0 0 0-.47-1.137l24.883 10.625l.566.934c1.167 1.834 3.284 1.495 4.351 1.177c1.475.728 4.119 2.412 3.442 4.893c-.357 1.312-1.142 1.948-2.399 1.948c-1.273 0-2.544-.666-2.557-.675L5.154 37.026M30.2 50.185l-1.966.814l-1.67-2.563l3.636 1.749m-7.614 5.381l-7.729-12.759l7.682 3.693l3.633 5.592c-1.465.626-3.102 2.055-3.586 3.474m34.033-12.184a7.731 7.731 0 0 0-.086 1.245l-19.465 9.116l19.533-8.18c.019.149.036.299.06.434l-24.95 11.895l25.147-11.007a.982.982 0 0 1 .015.058L29.046 60.08c-.013.009-1.282.675-2.557.675c-1.258 0-2.042-.637-2.399-1.948c-.918-3.367 4.302-5.276 4.38-5.305l4.575-1.952c.491.209 3.994 1.584 5.711-1.115l1.083-1.786l17.494-7.47a6.12 6.12 0 0 0-.471 1.137L38.54 50.827l18.079-7.445m.034-4.161l-14.825 6.144l4.114-6.791l6.767-3.253l3.944 3.9m2.393-11.107a6.9 6.9 0 0 0-.075 1.079l-16.868 7.9l16.928-7.089c.017.129.031.26.052.376L37.459 40.688l21.794-9.539a.46.46 0 0 1 .013.05L35.149 42.586c-.011.007-1.112.585-2.216.585c-1.091 0-1.77-.553-2.079-1.689c-.796-2.918 3.728-4.572 3.796-4.597l25.014-10.68a5.268 5.268 0 0 0-.407.986l-15.88 7.376l15.669-6.453" />
                    </svg>
                    <span class="hidden">Cursos</span>
                </a>
                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 1024 1024">
                    <path fill="#fff"
                        d="M104.704 338.752a64 64 0 0 1 90.496 0l316.8 316.8l316.8-316.8a64 64 0 0 1 90.496 90.496L557.248 791.296a64 64 0 0 1-90.496 0L104.704 429.248a64 64 0 0 1 0-90.496z" />
                </svg>
            </div>
            <ul class="sub-menu">
                <li><a href="{{ route('cursos.index') }}"
                        class="{{ request()->routeIs('cursos.*') ? 'item-active' : '' }}">Cursos planta</a></li>
                <li><a href="{{ route('curs.index') }}"
                        class="{{ request()->routeIs('curs.*') ? 'item-active' : '' }}">Cursos internos</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('matrices.index') }}"
                class="{{ request()->routeIs('matrices.*') ? 'item-active' : '' }}  ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M21.17 3.25q.33 0 .59.25q.24.24.24.58v15.84q0 .34-.24.58q-.26.25-.59.25H7.83q-.33 0-.59-.25q-.24-.24-.24-.58V17H2.83q-.33 0-.59-.24Q2 16.5 2 16.17V7.83q0-.33.24-.59Q2.5 7 2.83 7H7V4.08q0-.34.24-.58q.26-.25.59-.25M7 13.06l1.18 2.22h1.79L8 12.06l1.93-3.17H8.22L7.13 10.9l-.04.06l-.03.07q-.26-.53-.56-1.07q-.25-.53-.53-1.07H4.16l1.89 3.19L4 15.28h1.78m8.1 4.22V17H8.25v2.5m5.63-3.75v-3.12H12v3.12m1.88-4.37V8.25H12v3.13M13.88 7V4.5H8.25V7m12.5 12.5V17h-5.62v2.5m5.62-3.75v-3.12h-5.62v3.12m5.62-4.37V8.25h-5.62v3.13M20.75 7V4.5h-5.62V7Z" />
                </svg>
                <span class="hidden">Matrices</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('sucursales.index') }}"
                class="{{ request()->routeIs('sucursales.*') ? 'item-active' : '' }}  ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                    <path fill="#fff"
                        d="M14 15V4h-3V1H2v14H0v1h7v-3h2v3h7v-1h-2zm-8-4H4V9h2v2zm0-3H4V6h2v2zm0-3H4V3h2v2zm3 6H7V9h2v2zm0-3H7V6h2v2zm0-3H7V3h2v2zm4 6h-2V9h2v2zm0-3h-2V6h2v2z" />
                </svg>
                <span class="hidden">Sucursales</span>
            </a>
        </li>
    </ul>
</nav>

<script>
    let arrow = document.querySelectorAll(".arrow");

    arrow.forEach(element => {
        element.addEventListener('click', (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        })
    })

    const $ = selector => document.querySelector(selector);
    const $$ = selector => document.querySelectorAll(selector);

    const menuButton = $('#menu-button')
    const allSpanItems = $$("span.hidden")
    const contentMenu = $("ul")
    const sidebar = $(".sidebar")
    let open = false;

    menuButton.addEventListener('click', () => {
        allSpanItems.forEach(element => {
            element.classList.toggle('hidden')
        });

        sidebar.classList.toggle('close')
        arrow.forEach(element => {
            element.classList.toggle('arrow')
        })

        contentMenu.classList.toggle('size')
    })
</script>
