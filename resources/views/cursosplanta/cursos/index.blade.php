<x-app title="Cursos">
    <div class="">
        Opciones
        <div class=" flex items-center gap-2">
            <x-modal :modalidad="$modalidad" :tipo="$tipos" title="Crear curso" textButton="Agregar curso" id="crear_curso"
                vistaContenidoModal="cursosplanta.cursos.create" />
            <x-modal title="Crear modalidad" textButton="Agregar modalidad" id="crear_modalidad"
                vistaContenidoModal="cursosplanta.modalidad.create" />
            <x-modal title="Crear tipo curso" textButton="Agregar tipo curso" id="crear_tipo_curso"
                vistaContenidoModal="cursosplanta.tipos.create" />

            <a href="{{ route('cursos.puestos') }}"
                class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
                Asignar cursos
            </a>

        </div>



        <div>
            <div class="contain-modalidad-tipo-curso">

                <div id="accordion-color" data-accordion="collapse"
                    data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                    <h2 id="accordion-color-heading-1">
                        <button type="button"
                            class="flex items-center justify-between  p-1 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                            data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                            aria-controls="accordion-color-body-1">
                            <span>What is Flowbite?</span>
                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of
                                interactive components built on top of Tailwind CSS including buttons, dropdowns,
                                modals, navbars, and more.</p>
                            <p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a
                                    href="/docs/getting-started/introduction/"
                                    class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start
                                developing websites even faster with components on top of Tailwind CSS.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <p class="font-bold">modalidades</p>
                    <div class="flex gap-2">
                        @foreach ($modalidad as $modalidad)
                            <span
                                class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $modalidad->modalidad }}</span>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="font-bold">Tipos de curso</p>
                    <div class="flex gap-2">
                        @foreach ($tipos as $tipo)
                            <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $tipo->nombre }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="text-subtitle font-semi-bold">Lista de cursos</h2>
                <div class="flex justify-between items-center my-3">
                    <x-filtros.filtros route="cursos.index" />
                    <x-search.search-input placeholder="nombre, codigo, tipo ..." route="cursos.index" />
                </div>
                <div class="bg-primary flex flex-wrap rounded-md p-5 gap-2 ">

                    @if (!is_null($cursos))
                        @foreach ($cursos as $curso)
                            <x-cards.card-cursos :curso="$curso" />
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app>
