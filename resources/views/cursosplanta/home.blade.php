<x-app title="INICIO">
    <h2>Empleados por puesto</h2>
    <div style="witdh: 100px; height: 200px;">
        <canvas id="myChart"></canvas>
    </div>


    <div>
        <div class="flex justify-between">
            <h2 class="font-poppins font-medium text-subtitle" >PROGESO DE LOS EMPLEADOS</h2>
            <x-filtros.filtros />
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
                        {{-- <x-popover :id="$user->id_usuario" text="ver mas..." :data="$user->cursos" :empleado="$user->empleado" /> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>


 




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Rama 1', 'Rama 2', 'Rama 3', 'Rama 4'],
                datasets: [{
                    data: [30, 20, 15, 35],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'left'
                    },
                    title: {
                        display: true,
                        text: 'Total de empleados por cada puesto'
                    },
                    datalabels: {
                        color: '#ffffff', // Color del texto de los labels
                        font: {
                            size: 18,
                            weight: 'bold', // Estilo del texto de los labels (negrita)
                            family: 'Arial, sans-serif'

                        },
                        formatter: function(value, context) {
                            console.log({
                                value,
                                context
                            })
                            return value + '%'; // Formato de los labels (agrega un porcentaje)
                        }
                    },
                    layout: {
                        padding: {
                            left: 0, // Espacio a la izquierda
                            right: 0, // Espacio a la derecha
                            top: 0, // Espacio en la parte superior
                            bottom: 0 // Espacio en la parte inferior
                        }
                    }
                }
            }
        });
    </script>
    @vite('resources/js/grafica.js')
</x-app>
