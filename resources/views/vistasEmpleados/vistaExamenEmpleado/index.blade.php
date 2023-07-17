<x-appEmpleado title="Calificación" route="home">
    <nav class="mx-4">
        @if($examen->cursos)
        <a href="{{url('cursosEmpleados',$examen->cursos)}}" class="text-base text-nav-hover font-bold"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                <path fill="currentColor" fill-rule="evenodd" d="m2.87 7.75l1.97 1.97a.75.75 0 1 1-1.06 1.06L.53 7.53L0 7l.53-.53l3.25-3.25a.75.75 0 0 1 1.06 1.06L2.87 6.25h9.88a3.25 3.25 0 0 1 0 6.5h-2a.75.75 0 0 1 0-1.5h2a1.75 1.75 0 1 0 0-3.5H2.87Z" clip-rule="evenodd" />
            </svg>REGRESAR AL CURSO</a>
        @else
        <a href="{{route('verContenido',[$examen->contenido_id])}}" class="text-base text-nav-hover font-bold"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                <path fill="currentColor" fill-rule="evenodd" d="m2.87 7.75l1.97 1.97a.75.75 0 1 1-1.06 1.06L.53 7.53L0 7l.53-.53l3.25-3.25a.75.75 0 0 1 1.06 1.06L2.87 6.25h9.88a3.25 3.25 0 0 1 0 6.5h-2a.75.75 0 0 1 0-1.5h2a1.75 1.75 0 1 0 0-3.5H2.87Z" clip-rule="evenodd" />
            </svg>REGRESAR AL CONTENIDO</a>
        @endif
    </nav><br>
    <div class="flex">
        <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white mx-12 text-title">Nombre del examen: <span class="text-input-buscador">{{$examen->nombre}}</span></h5>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white mx-12 text-subtitle">Duración del examen: <span class="text-input-buscador">{{$examen->duracion}} Minutos</span></h5>
            @if(Auth::user()->examen()->where('examen_id', $examen->id_examen)->exists())
            @foreach(Auth::user()->examen as $examm)
            @if($examm->id_examen == $examen->id_examen)
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white mx-12 text-subtitle">Intentos realizados: <span class="text-orange-700">Intento {{$examm->pivot->numero_intento}}</span><span class="text-red-400"> de</span> <span class="text-input-buscador">{{$intentos}}</span></h5>
            @endif
            @endforeach
            @else
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white mx-12 text-subtitle">
            Intentos para realizar el examén
                <span class="text-input-buscador">Primer Intento de {{$intentos}}</span>
            </h5>
            @endif


            <!-- Botón "Comenzar" para iniciar el examen -->
            <div class="items-center text-center"><br><br>
                <!-- botones de comenzar -->
                @if(Auth::user()->examen()->where('examen_id', $examen->id_examen)->exists())
                @foreach(Auth::user()->examen as $examm)
                @if($examm->id_examen == $examen->id_examen)
                @if($examm->pivot->numero_intento < 3) 
                @if($examm->pivot->calificacion >= 80)
                @if($examen->contenido_id)
                <a href="{{route('verContenido',$examen->contenido_id)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al contenido</a> <br>
                @else
                <a href="{{url('cursosEmpleados',$examen->curso_id)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al curso</a> <br>
                @endif
                    <div class="min-w-screen h-full min-h-screen   px-5 py-5 flex justify-center shadow-all">
                        <div class="h-4/5 w-1/2 py-10 px-5  bg-gray-100 md:px-10">
                            <div class="text-center mb-10">
                                <h1 class="font-bold text-3xl text-title text-gray-900">TU CALIFICACIÓN OBTENIDA ES DE: </h1><br>
                                <p class="mb-2 text-title font-bold tracking-tight text-gray-900 dark:text-white">{{$examm->pivot->calificacion}} %</p>
                            </div><br>
                        </div>
                    </div>
                    @elseif($examm->pivot->calificacion < 80) <button id="btnComenzar" class="button bg-primary text-white text-dark text-center capitalize py-2 px-2 rounded-lg tracking-widest font-bold  hover:bg-input-buscador w-96 cursor-pointer">
                        Comenzar
                        </button>
                        @endif
                        @elseif($examm->pivot->numero_intento >= 3)
                        @if($examen->contenido_id)
                        <a href="{{route('verContenido',$examen->contenido_id)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al Curso</a> <br>
                        <div class="min-w-screen h-full min-h-screen   px-5 py-5 flex justify-center shadow-all">
                            <div class="h-4/5 w-1/2 py-10 px-5  bg-gray-100 md:px-10">
                                <div class="text-center mb-10">
                                    <h1 class="font-bold text-3xl text-title text-gray-900">TU CALIFICACIÓN OBTENIDA ES DE: </h1><br>
                                    <p class="mb-2 text-title font-bold tracking-tight text-gray-900 dark:text-white">{{$examm->pivot->calificacion}} %</p>
                                </div><br>
                            </div>
                        </div>
                        @else
                        <a href="{{url('cursosEmpleados',$examen->curso_id)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al Curso</a> <br>
                        <div class="min-w-screen h-full min-h-screen   px-5 py-5 flex justify-center shadow-all">
                            <div class="h-4/5 w-1/2 py-10 px-5  bg-gray-100 md:px-10">
                                <div class="text-center mb-10">
                                    <h1 class="font-bold text-3xl text-title text-gray-900">TU CALIFICACIÓN OBTENIDA ES DE: </h1><br>
                                    <p class="mb-2 text-title font-bold tracking-tight text-gray-900 dark:text-white">{{$examm->pivot->calificacion}} %</p>
                                </div><br>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endif
                        @endforeach
                        @else
                        <button id="btnComenzar" class="button bg-primary text-white text-dark text-center capitalize py-2 px-2 rounded-lg tracking-widest font-bold  hover:bg-input-buscador w-96 cursor-pointer">
                            Comenzar
                        </button>
                        @endif
            </div><br>
            <div id="timer" class="justify-center hidden items-center gap-2 mb-2 text-2xl font-bold tracking-tight text-center text-completed dark:text-white mx-12 text-subtitle">
                <i class='bx bx-time-five bx-spin'></i> <span>Tiempo restante:</span> <span id="countdown" class="text-gray-600"></span>
            </div><br>
            <div id="preguntas" style="display: none;">
                <form action="{{route('validarExamenempleado',$examen->id_examen)}}" method="POST" id="form">
                    @csrf
                    @foreach ($examen->preguntas as $pregunt)
                    <div class="flex p-2 bg-white border border-gray-200 rounded-lg shadow mx-12">
                        <input type="number" hidden name="total_pregunta" value="{{$totalPreguntas}}">
                        <div class="text-primary font-semi-bold mx-5 flex flex-col">
                            <label for="pregunta{{ $pregunt->id_pregunta }}">{{ $pregunt->pregunta }}</label><br>
                            <div class="flex gap-4 flex-wrap">
                                @foreach($pregunt->opciones as $opcion)
                                <div class="mx-4">
                                    <input class="form-check-input" type="radio" name="pregunta{{ $pregunt->id_pregunta }}" id="pregunta{{ $pregunt->id_pregunta }}_opciones{{ $opcion->id_opciones }}" value="{{ $opcion->id_opciones }}">
                                    <label class="form-check-label" for="pregunta{{ $pregunt->id_pregunta }}_opciones{{ $opcion->id_opciones }}">{{ $opcion->opcion }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div><br>
                    @endforeach
                    <div class="items-center text-center">
                        <button id="btnTerminar" type="submit" class=" button bg-primary text-white text-dark text-center capitalize py-2 px-2 rounded-lg tracking-widest font-bold  hover:bg-input-buscador w-full cursor-pointer">
                            Terminar examen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-appEmpleado>

<!-- ULTIMA PRUEBA -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Obtén los elementos del temporizador, los botones y el contenedor de preguntas
    var timerElement = document.getElementById('timer');
    var countdownElement = document.getElementById('countdown');
    var btnComenzar = document.getElementById('btnComenzar');
    var btnTerminar = document.getElementById('btnTerminar');
    var preguntasElement = document.getElementById('preguntas');
    // Establece la duración del examen en segundos
    var examDuration = 60 * '{{$examen->duracion}}'; // Por ejemplo, 10 minutos
    // Variable para almacenar el temporizador
    var timer;

    // Manejador de evento para el clic en el botón "Comenzar"
    btnComenzar.addEventListener('click', function() {
        // Oculta el botón "Comenzar"
        btnComenzar.style.display = 'none';
        // Muestra el temporizador
        timerElement.style.display = 'flex';
        // Muestra las preguntas del examen
        preguntasElement.style.display = 'block';
        // Muestra el botón "Terminar"
        btnTerminar.style.display = 'block';
        // Inicia el temporizador
        startTimer();
    });

    // Manejador de evento para el clic en el botón "Terminar"
    btnTerminar.addEventListener('click', function(e) {
        e.preventDefault()
        // Detiene el temporizador
        stopTimer();
        // Muestra la alerta de confirmación con SweetAlert
        Swal.fire({
            title: 'Confirmación',
            text: "¿Estás seguro de que deseas terminar el examen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#121d52',
            cancelButtonColor: '#ba1198',
            confirmButtonText: 'Finalizar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                finalizarExamen();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swal.fire(
                    'Cancelado',
                    'Revise bien sus Respuestas antes de finalizar',
                    'error'
                )
                startTimer();
            }
        });
    });

    // Función para iniciar el temporizador
    function startTimer() {
        // Calcula los minutos y segundos restantes
        var minutes = Math.floor(examDuration / 60);
        var seconds = examDuration % 60;
        // Actualiza el texto del temporizador
        countdownElement.innerHTML = minutes + ' minutos ' + seconds + ' segundos';
        // Decrementa el tiempo restante cada segundo
        timer = setInterval(function() {
            examDuration--;
            // Verifica si el tiempo se ha agotado
            if (examDuration <= 0) {
                // Detiene el temporizador
                stopTimer();
                // Muestra la alerta de tiempo agotado con SweetAlert
                Swal.fire({
                    title: 'Tiempo agotado',
                    text: 'El tiempo para el examen ha terminado.',
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        finalizarExamen();
                    }
                });
            } else {
                // Calcula los minutos y segundos restantes
                minutes = Math.floor(examDuration / 60);
                seconds = examDuration % 60;

                // Actualiza el texto del temporizador
                countdownElement.innerHTML = minutes + ' minutos ' + seconds + ' segundos';
            }
        }, 1000); // Actualiza cada segundo
    }

    // Función para detener el temporizador
    function stopTimer() {
        clearInterval(timer);
    }

    // Función para finalizar el examen
    function finalizarExamen() {
        form.submit();
        // Aquí puedes escribir la lógica para finalizar el examen
        // Puedes enviar las respuestas al backend de Laravel para su validación y almacenamiento
        // Por ejemplo:
        // axios.post('/examenes/finalizar', { respuestas })
        // Una vez que se complete la solicitud, puedes redirigir al usuario a una página de resultados o hacer otras acciones necesarias
    }
</script>