<x-app>
  <h1 class="text-lg">Crear plan de capacitacion</h1>
  <h2>Seleccion un puesto y asignale los cursos para cada puesto</h2>

  <form action="{{ route('planes.store') }}" method="POST" class="border-2 border-blue-200 m-4 p-2">
      @csrf
      <select name="puesto_id" id="puestos"
          class="py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
          <option value="" class="text-gray-400">Selecciona un puesto</option>
          @foreach ($puestos as $puesto)
              <option value="{{ $puesto->id_puesto }}">
                  {{ $puesto->puesto }}
              </option>
          @endforeach
      </select>

      <select name="trabajo_id" id="trabajos"
          class="hidden py-2 px-3 text-sm leading-tight text-gray-700 border-2 rounded shadow-md appearance-none focus:outline-none focus:shadow-outline focus:border-blue-400 cursor-pointer uppercase">
      </select>

      {{-- <div>
          <h2>Cursos asignados</h2>
          <div id="cursos-por-puesto" class="w-full flex flex-wrap gap-2">
          </div>
      </div> --}}

      <div>
          <h2>Secciona los cursos para el puesto seleccionado</h2>
          <div id="cursos" class="w-full flex flex-wrap gap-2">
              @if ($cursos == [])
                  Sin cursos, por favor crea cursos para continuar
                  <a href="{{ route('cursos.index') }}">crear cursos</a>
              @else
                  <x-checkbox.checkbox :cursos="$cursos" />
              @endif
          </div>
      </div>

      <x-input-submit text="crear" />
  </form>

  <script>
      const idSelect = document.getElementById('puestos')
      const trabajosSelector = document.getElementById("trabajos")
      idSelect.addEventListener('change', (event) => {
          let plan_id = event.target.value
          getJobsByPosition(plan_id);
          getCursos(plan_id)
      })

      function getJobsByPosition(id) {
          fetch(`${API_URL}/cursosplanta/puesto/${id}/trabajos`)
              .then(res => res.json())
              .then(data => {
                  let trabajos = '<option value="" class="text-gray-400">Selecciona un trabajo</option>'
                  if (data.length < 1) return;

                  trabajosSelector.classList.toggle('hidden');
                  data.forEach(trabajo => {
                      trabajos +=
                          `<option value="${trabajo.id_trabajo}">
                              ${trabajo.nombre}
                          </option>`
                  });
                  trabajosSelector.innerHTML = trabajos
              })
              .catch(err => console.log(err))
      }

      function getCursos(id) {
          return fetch(`${API_URL}/api/cursosxplanes/${id}`)
              .then(res => res.json())
              .then(data => {
                  console.log(data);
                  let cursosPorPlan = ""
                  let cursosDisponibles = ""
                  data.cursosPorPlan.forEach(curso => {
                      cursosPorPlan += `
                    <div class="cursor-pointer inline-block w-52 h-auto rounded-md shadow-[0_1px_5px_1px_rgba(150,50,200,0.4)] border-fuchsia-400 mb-4 overflow-hidden p-2">
                        <h2>${curso.curso}</h2>
                        <h3>${curso.codigo}</h3>
                    </div>
                `
                  });
                  data.cursosDisponible.forEach(curso => {
                      cursosDisponibles += `
                <label
                    class="cursor-pointer inline-block w-52 h-auto rounded-md shadow-[0_1px_5px_1px_rgba(150,50,200,0.4)] border-fuchsia-400 mb-4 overflow-hidden">
                    <input class="hidden peer" type="checkbox" name="cursos[]" value="${curso.id_curso}" />
                    <div class="peer-checked:bg-fuchsia-50 p-2">
                        <h2>${curso.curso}</h2>
                        <h3>${curso.codigo}</h3>
                    </div>
                </label>`
                  });

                  document.getElementById("cursos-por-puesto").innerHTML = cursosPorPlan;
                  document.getElementById("cursos").innerHTML = cursosDisponibles;
              })
              .catch(err => console.log(err));
      }
  </script>

</x-app>
