    <form action="{{ route('cursos.store') }}" method="POST" class="space-y-6">
        @method('POST')
        @csrf
        <x-input-text text="Nombre" nombre="nombre" placeholder="nombre" required />
        <x-input-text text="codigo" nombre="codigo" placeholder="codigo " />
        <x-input-text text="Fecha inicio" nombre="fecha_inicio" placeholder="fecha_inicio " />
        <x-input-text text="Fecha Termino" nombre="fecha_termino" placeholder="fecha_termino" />


        <select name="modalidad_id" id="modalidad_id"
            class="py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
            <option value="" id="select_puesto" class="text-gray-400">Selecciona la modalidad</option>
            @foreach ($modalidad as $modalidad)
                <option value="{{ $modalidad->id_modalidad }}">
                    {{ $modalidad->modalidad }}
                </option>
            @endforeach
        </select>

        <select name="tipo_id" id="tipo_id"
            class="py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
            <option value="" id="select_puesto" class="text-gray-400">Selecciona un tipo</option>
            @foreach ($tipo as $tipo)
                <option value="{{ $tipo->id_tipo_curso }}">
                    {{ $tipo->nombre }}
                </option>
            @endforeach
        </select>

        <x-input-submit text="crear" />
    </form>
