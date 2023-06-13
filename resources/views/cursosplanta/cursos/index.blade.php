<x-app title="Cursos">
    <div class="">
        Opciones
        <div class=" flex items-center gap-2">
            <x-modal :modalidad="$modalidad" :tipo="$tipo" />
            <a href="{{route("cursos.puestos")}}"
                class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md">
                Asignar cursos
            </a>
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md"
                type="button">
                Crear modalidad
            </button>

            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="block text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-5 py-2.5 text-center hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md"
                type="button">
                Crear tipo curso
            </button>
        </div>
        <div>
            <div class="flex justify-between items-center mb-3">
                <h2>Lista de cursos</h2>
                <x-search.search-input />
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

    <script></script>

</x-app>

{{-- <form action="{{ route('cursos.index', ['puesto' => $puesto]) }}" method="get">
                <p>filtros</p>

                <legend>Puesto</legend>
                <select name="puesto_id" class="text-black" required>
                    <option value="">Selecciona un puesto</option>
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id_puesto }}">{{ $puesto->puesto }}</option>
                    @endforeach
                </select>

                <x-input-submit text="enviar" />
            </form> --}}
