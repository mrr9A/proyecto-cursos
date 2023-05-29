<x-layouts.app>

  <h2> Crear puesto</h2>
  <form method="POST" action="{{ route('puesto.store') }}">
    @csrf
    <input name="puesto" id="puesto" type="text" placeholder="puesto.." />
    <select name="plan_id"
        class="py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
        <option value="" class="text-gray-400">Selecciona un plan de formacion</option>
        @foreach ($planesFormacion as $plan)
            <option value="{{ $plan->id_plan_formacion }}">
                {{ $plan->tema }} {{ $plan->area}}
            </option>
        @endforeach
    </select>

    <x-buttons.form-input />
</form>


<ul>
  @foreach ($puestos as $plan)
      <h2>Plan de formacion {{$plan->tema}} {{$plan->area}}</h2>
      @foreach ($plan->puestos as $puesto )
        <li>{{$puesto->puesto}}</li>
      @endforeach
  @endforeach
</ul>

</x-layouts-app>
