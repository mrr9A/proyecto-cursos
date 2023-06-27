<x-app title="INICIO">
    <div>
        <div class=" min-h-[80px]  mb-3 flex p-1 gap-8">
            <div class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{$allPuestos}}</span>
                    <span class="text-base font-regular">Puestos</span>
                </div>
                <i class='bx bx-briefcase'></i>
            </div>
            <div class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{$allEmpleados}}</span>
                    <span class="text-base font-regular">Empleados activos</span>
                </div>
                <i class='bx bx-user'></i>
            </div>
            <div class="min-w-[250px] bg-primary-light text-white shadow-all shadow-primary-light rounded-md overflow-hidden py-2 px-2 flex gap-2 items-center justify-around hover:bg-[#3D52D595]  cursor-pointer">
                <div class="data flex flex-col items-center">
                    <span class="text-title font-semi-bold">{{$allSucursales}}</span>
                    <span class="text-base font-regular">Sucursales</span>
                </div>
                <i class='bx bx-buildings'></i>
            </div>
        </div>
        {{-- <div class="w-5/12 overflow-auto">
            <canvas id="myChart" class=""></canvas>
        </div> --}}

        {{-- 1 => {#1535 ▼
            +"id_usuario": 1
            +"id_sgp": 4012579
            +"id_sumtotal": 7145719
            +"empleado": "Julian Addison Kihn "
            +"puesto": "consultor de experiencia"
            +"total": 3
            +"totalCursosPasados": 1
            +"cursos": array:3 [▼
              0 => array:4 [▼
                "tipo" => "basico"
                "objetivo" => 1
                "real" => 0
                "progeso" => "0.00"
              ]
              1 => array:4 [▶]
              2 => array:4 [▶]
            ]
            +"promedioTotal": "33.33" --}}
        <div>
            <div class="flex justify-between">
                <h2 class="font-poppins font-medium text-subtitle">PROGESO DE LOS EMPLEADOS</h2>
                <x-search.search-input placeholder="id, id sgp, id sumtotal, nombre, puesto..." route="home" />
            </div>
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
                        <th scope="col" class="px-6 py-2">progreso</th>
                        <th scope="col" class="px-6 py-2">opciones</th>
                    </tr>
                </thead>
                <tbody class="capitalize">
                    @foreach ($data as $usuario)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sgp }}</td>
                            <td class="whitespace-nowrap px-6 py-2 w-1/12 ">{{ $usuario->id_sumtotal }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->empleado }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->puesto }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->total }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->totalCursosPasados }}</td>
                            <td class="py-3 px-6 text-left">{{ $usuario->promedioTotal }}</td>
                            <td class="py-3 px-6 text-left">
                                <x-popover :id="$usuario->id_usuario" text="ver mas..." :data="$usuario->cursos" :empleado="$usuario->empleado" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
