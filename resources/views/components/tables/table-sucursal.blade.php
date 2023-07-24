<div class="grid grid-cols-[repeat(auto-fit,minmax(40%,1fr))] gap-2 mb-4 h-auto">
    <div>
        <h2 class="text-gray-300 font-semi-bold text-section-subtitle">Progreso mes anterior</h2>
        @foreach ($data as $sucursal => $datos)
            <div class="bg-white mb-3 rounded-md overflow-hidden h-56">
                <h2 class="bg-blue-800 text-white font-medium uppercase pl-2">{{ $sucursal }}</h2>
                <div class="grid-cols-[repeat(auto-fit,minmax(120px,1fr))] grid">
                    @foreach ($datos as $fecha => $fechas)
                        <div>
                            <h2 class="pl-2 font-semi-bold">{{ $fecha }}</h2>
                            <div class="">
                                <div class="grid grid-cols-3 gap-2 py-1 px-2 bg-blue-200 font-medium uppercase">
                                    <span>tipos</span>
                                    <span class="text-center">obj</span>
                                    <span class="text-center">real</span>
                                </div>
                                @foreach ($fechas as $dato)
                                    <div
                                        class="grid grid-cols-3 gap-2 py-1 px-2 bg-gray-100 hover:bg-gray-300 hover:cursor-pointer">
                                        <span>{{ $dato->tipo }}</span>
                                        <span class="text-center">{{ $dato->objetivo > 100 ? "100" :$dato->objetivo }} %</span>
                                        <span class="text-center">{{ $dato->real }} %</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div class="">
        <h2 class="text-gray-300 font-semi-bold text-section-subtitle">Progreso mes actual</h2>
        {{-- Progreso actual --}}
        @foreach ($reporteMesActual as $sucursal => $datos)
            <div class="bg-white mb-3 rounded-md overflow-hidden h-56">
                <h2 class="bg-blue-800  text-white font-medium uppercase pl-2">{{ $sucursal }}</h2>
                <div class="grid-cols-[repeat(auto-fit,minmax(120px,1fr))] grid">
                    @foreach ($datos as $fecha => $fechas)
                    <?php $fecha = date("Y/m/d") ?>
                        <div>
                            <h2 class="pl-2 font-semi-bold">{{ $fecha }}</h2>
                            <div class="">
                                <div class="flex gap-2 justify-between py-1 px-2 bg-blue-200 font-medium uppercase">
                                    <span>tipos</span>
                                    <span>progreso</span>
                                </div>
                                @foreach ($fechas as $dato)
                                    <div
                                        class="flex gap-2 justify-between py-1 px-2 bg-gray-100 hover:bg-gray-300 hover:cursor-pointer">
                                        <span>{{ $dato['nombre_curso'] }}</span>
                                        <span>{{ $dato['porcentaje_aprobado_promedio'] }} %</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
