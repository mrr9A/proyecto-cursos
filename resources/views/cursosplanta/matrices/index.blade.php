<x-app title="matrices">
  {{-- @dump(request()->q)
  @dump(request()->puestos) --}}
    <h2 class="">Filtros</h2>
    <div class="flex justify-between my-2 items-center">
        <form action="{{ route('matrices.index') }}" class="flex gap-3">
            <select name="q">
                <option value="ventas">ventas</option>
                <option value="tecnico">tecnico</option>
            </select>
            <select name="puestos">
                @foreach ($puestos as $puesto )
                <option value="{{$puesto->id_puesto}}">{{$puesto->puesto}}</option>
                @endforeach
            </select>
            <button type="submit" class="flex px-1.5 py-1 bg-blue-700 rounded-sm items-center text-white hover:bg-blue-800">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M14 12v7.88c.04.3-.06.62-.29.83a.996.996 0 0 1-1.41 0l-2.01-2.01a.989.989 0 0 1-.29-.83V12h-.03L4.21 4.62a1 1 0 0 1 .17-1.4c.19-.14.4-.22.62-.22h14c.22 0 .43.08.62.22a1 1 0 0 1 .17 1.4L14.03 12H14Z" />
            </svg>
            <span>filtrar</span>
            </button>
        </form>

        <x-search.search-input route="matrices.index"/>
    </div>

    
    <x-tables.table :empleados="$data"/>
</x-app>
