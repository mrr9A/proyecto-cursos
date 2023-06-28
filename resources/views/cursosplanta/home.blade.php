<x-app title="INICIO">
    <div>
        <div class=" min-h-[80px]  mb-3 flex p-1 gap-8">
            <button id="btn-puestos"
                class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{ $allPuestos }}</span>
                    <span class="text-base font-regular">Puestos</span>
                </div>
                <i class='bx bx-briefcase'></i>
            </button>
            <div
                class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{ $allEmpleados }}</span>
                    <span class="text-base font-regular">Empleados activos</span>
                </div>
                <i class='bx bx-user'></i>
            </div>
            <div
                class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{ $allSucursales }}</span>
                    <span class="text-base font-regular">Sucursales</span>
                </div>
                <i class='bx bx-buildings'></i>
            </div>
        </div>
        <div>
            <div class="flex justify-between">
                <h2 class="font-poppins font-medium text-subtitle">PROGESO DE LOS EMPLEADOS</h2>
                <x-search.search-input placeholder="id, id sgp, id sumtotal, nombre, puesto..." route="home" />
            </div>
            @foreach ($data['links'] as $link)
                <a href="{{ $link['url'] }}" class="{{ $link['active'] ? 'active' : '' }}">{{ $link['label'] }}</a>
            @endforeach
            <table class="min-w-full leading-normal my-2">
                <thead class="border-b  dark:border-neutral-500 uppercase">
                    <tr
                        class="px-5 border-b-2 border-gray-200 bg-blue-200 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                        <th scope="col" class="px-6 py-2 w-1/12">ID SGP</th>
                        <th scope="col" class="px-6 py-2">ID SUMTOTAL</th>
                        <th scope="col" class="px-6 py-2">empleado</th>
                        <th scope="col" class="px-6 py-2">puesto</th>
                        <th scope="col" class="px-6 py-2">total de cursos</th>
                        <th scope="col" class="px-6 py-2">cursos pasados</th>
                        <th scope="col" class="px-6 py-2">cursos progreso</th>
                        <th scope="col" class="px-6 py-2">progreso</th>
                        <th scope="col" class="px-6 py-2">opciones</th>
                    </tr>
                </thead>
                <tbody class="capitalize">
                    @foreach ($data['data'] as $usuario)
                    {{-- @dump($usuario) --}}
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                            <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sumtotal }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->empleado }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->puesto }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->total }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->totalCursosPasados }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->cursosEnProgreso }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->promedioTotal }}</td>
                            <td class="py-3 px-6 text-left">
                                <div class="w-full flex justify-end mt-2">
                                    <a target="_blank" href="{{route('descargarPDF', $usuario->id_usuario)}}" 
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ver reporte</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div id="content_modal" class="hidden fixed bottom-0 top-0 right-0 left-0 bg-[#00000080] z-50">
        <div
            class="m-auto  w-[50%] h-[80%] bg-white rounded-md py-4 px-3 overflow-auto">
            <x-loader.loader />
        </div>
    </div>

    <script>
        const btnPuestos = $("#btn-puestos");
        const contentModal = $("#content_modal");

        contentModal.addEventListener('click', (event) => {
            if (event.target === contentModal) {
                contentModal.classList.add('hidden')
            }
        })

        btnPuestos.addEventListener('click', async (e) => {
            contentModal.classList.toggle('hidden')
            const data = await getData()
            contenidoTr = ""
            data.forEach(element => {
                contenidoTr += `<tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td> ${element.puesto}</td>
                                    <td class="py-3 px-6 text-center">${element.num_empleados}</td>
                                </tr>
                `
            });

            const contenido = `
            <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2  w-[50%] h-[80%] bg-white rounded-md py-4 px-3 overflow-auto">
                    <h2 class="text-section-subtitle font-bold">Puestos</h2>
                    <div>
                        <table class="min-w-full leading-normal my-2">
                            <thead class="border-b  dark:border-neutral-500 uppercase">
                                <tr class="px-5 border-b-2 border-gray-200 bg-blue-200 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                    <th class="px-6 py-2">Puesto</th>
                                    <th>numero de empleados</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${contenidoTr}
                            </tbody>
                        </table>
                    </div>
                </div>
            `

            contentModal.innerHTML = contenido
        })



        async function getData() {
            // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
            const respuestaRaw = await fetch("http://localhost:8000/api/cursosplanta/trabajadores/datos");
            // Decodificar como JSON
            const respuesta = await respuestaRaw.json();
            // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
            // Obtener una referencia al elemento canvas del DOM

            console.log(respuesta);
            return respuesta
        }
    </script>
</x-app>
