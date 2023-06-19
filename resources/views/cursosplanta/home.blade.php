<x-app title="INICIO">
    <div>
        <div class="w-4/12">
            <canvas id="myChart" class=""></canvas>
        </div>

        <div>
            <div class="flex justify-between">
                <h2 class="font-poppins font-medium text-subtitle">PROGESO DE LOS EMPLEADOS</h2>
                <x-search.search-input placeholder="nombre, codigo, tipo ..."  route="home"/>
            </div>

            <div class="w-full flex flex-wrap gap-2 m-3">
                @foreach ($data as $user)
                    <div class="relative cursor-pointer bg-primary-light text-white p-4 rounded-lg shadow-md w-[250px]">
                        <div class="h-full flex flex-col justify-between gap-2">
                            <div>
                                <h2 class="font-medium capitalize">{{ $user->empleado }}</h2>
                                <div class="flex flex-1 gap-4 mt-2 text-sm font-light">
                                    <p>{{ $user->total }} cursos</p>
                                    <p>{{ $user->promedioTotal }}% completado</p>
                                </div>
                            </div>
                            {{-- POP OVER PARA LOS USUARIOS --}}
                            <x-popover :id="$user->id_usuario" text="ver mas..." :data="$user->cursos" :empleado="$user->empleado" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    @vite('resources/js/grafica.js')
</x-app>
