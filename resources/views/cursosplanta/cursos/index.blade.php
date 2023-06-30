<x-app title="Cursos">
    <div class="">
        Opciones
        <div class=" flex items-center gap-2">
            <a href="{{route('cursos.create')}}" class="flex items-center gap-2 text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-2 py-1.5  hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md'">
                <i class='bx bxs-plus-circle'></i>
                Crear Cursos
            </a>
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
                <div class="bg-primary grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] p-2 gap-2 rounded-md ">

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
