<form method="POST" id="crear_puesto" action="{{ route('puestos.edit', $puesto) }}"
        class="w-[60%]  flex flex-wrap flex-col gap-4 p-2 ">
        @csrf

        <div class="flex gap-3 items-center">
            <x-input-text placeholder="Ej. jefe de taller" nombre="puesto" text="Puesto" />

            <div class="flex flex-col font-poppins gap-21 text-text-input">
                <label class="mb-2 font-semi-bold">Seleccionar plan de informacion</label>
                <select name="plan_id"
                    class="py-1.5 px-2 leading-tight text-gray-700 border-2 rounded-lg border-input cursor-pointer uppercase">
                    <option value="" class="text-gray-400">plan de formacion</option>
                    @foreach ($planesFormacion as $plan)
                        <option value="{{ $plan->id_plan_formacion }}">
                            {{ $plan->tema }} {{ $plan->area }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <span class="flex items-center gap-2">
            ¿Desea asignar trbajos para este puesto?
            <button id="add_trabajo" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path fill="currentColor"
                        d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20a10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16a8 8 0 0 0 0 16z" />
                </svg>
            </button>
        </span>


        <div id="trabajos" class="flex flex-wrap gap-3 items-center">
        </div>

        <x-input-submit text="aceptar" />
    </form>