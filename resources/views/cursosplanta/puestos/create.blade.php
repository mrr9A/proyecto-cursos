<x-layouts.app>
  <form method="POST" action="{{ route('usuarios.store') }}">
      @csrf
      <input name="puesto" id="puesto" type="text" placeholder="puesto.." />
      <select name="puesto_id"
          class="py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
          <option value="" class="text-gray-400">Selecciona un plan de formacion</option>
          @foreach ($planesFormacion as $plan)
              <option value="{{ $plan->id_puesto }}">
                  {{ $plan->plan }}
              </option>
          @endforeach
      </select>

      <x-buttons.form-input />
  </form>
</x-layouts-app>
