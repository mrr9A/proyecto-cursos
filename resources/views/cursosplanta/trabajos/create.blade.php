<x-layouts.app>
  <form method="POST" action="{{ route('trabajos.store') }}">
      @csrf
      <input name="nombre" id="nombre" type="text" placeholder="trabajo.." />
      <select name="puesto_id"
          class="py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
          <option value="" class="text-gray-400">Selecciona un puesto</option>
          @foreach ($puestos as $puesto)
              <option value="{{ $puesto->id_puesto }}">
                  {{ $puesto->puesto }}
              </option>
          @endforeach
      </select>
      <x-buttons.form-input />
  </form>

  <ul>
    @foreach ($puestos as $puesto)
        <h2>Puesto {{$puesto->puesto}}</h2>
        @foreach ($puesto->trabajos as $trabajo )
          <li>{{$trabajo->nombre}}</li>
        @endforeach
    @endforeach
  </ul>
</x-layouts-app>
