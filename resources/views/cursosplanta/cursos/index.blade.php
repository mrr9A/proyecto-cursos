<x-app title="Cursos">
    <div class="-mt-2 mb-2">
        <p>Opciones</p>
        <div class=" flex items-center gap-2">
            <a href="{{ route('cursos.create') }}"
                class="border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-2 py-1.5  hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md'">
                Crear cursos
            </a>
            <a href="{{ route('cursos.puestos') }}"
                class="border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-1.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
                Asignar cursos
            </a>
        </div>
    </div>
    <div>
        <div class="contain-modalidad-tipo-curso flex flex-wrap gap-6 justify-between">
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">modalidades</p>
                    <x-modal title="Crear modalidad" textButton="" id="crear_modalidad"
                        vistaContenidoModal="cursosplanta.modalidad.create"
                        class="text-blue-800 hover:text-blue-700 " />
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($modalidad as $modalidad)
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $modalidad->modalidad }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">Tipos de curso</p>
                    <x-modal title="Crear tipo curso" textButton="" id="crear_tipo_curso"
                        vistaContenidoModal="cursosplanta.tipos.create" class="text-blue-800 hover:text-blue-700" />
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tipos as $tipo)
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $tipo->nombre }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="text-subtitle font-semi-bold">Lista de cursos</h2>
            <div class="flex justify-between items-center mb-3 -mt-3">
                <span class="text-gray-700 text-sm">puede buscar cursos por tipo, nombre, codigo, modalidad</span>
                <x-search.search-input placeholder="nombre, codigo, tipo ..." route="cursos.index" />
            </div>
            <div class="bg-primary grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] p-2 gap-2 rounded-md ">

                @if (!is_null($cursos))
                    @foreach ($cursos as $curso)
                        <x-cards.card-cursos :curso="$curso" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app>
