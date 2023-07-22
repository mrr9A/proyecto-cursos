<div class="flex items-start gap-4 my-4">
    @foreach ($data as $sucursal => $datos)
        <div class="w-full overflow-x-auto h-full">
            <h2 class="bg-blue-800 border-[1px]  text-white">{{ $sucursal }}</h2>
            <div class="grid-cols-[repeat(auto-fit,minmax(120px,1fr))] grid">
                @foreach ($datos as $fecha => $fechas)
                    <div>
                        <h2>{{ $fecha }}</h2>
                        <div class="">
                            <div class="flex gap-2 justify-between py-1 px-2 bg-blue-200">
                                <span>tipo</span>
                                <span>obj</span>
                                <span>real</span>
                            </div>
                            @foreach ($fechas as $dato)
                                <div class="flex gap-2 justify-between py-1 px-2 bg-gray-200">
                                    <span>{{ $dato->tipo }}</span>
                                    <span>{{ $dato->objetivo }}</span>
                                    <span>{{ $dato->real }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
