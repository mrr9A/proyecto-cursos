<x-appEmpleado title="Calificación" route="home">
    <div class="min-w-screen h-full min-h-screen   px-5 py-5 flex justify-center shadow-all">
        <div class="h-4/5 w-1/2 py-10 px-5  bg-gray-100 md:px-10">
            <div class="text-center mb-10">
                <h1 class="font-bold text-3xl text-title text-gray-900">TU CALIFICACIÓN OBTENIDA ES DE: </h1><br>
                <p class="mb-2 text-title font-bold tracking-tight text-gray-900 dark:text-white">{{$promedio}} %</p>
            </div><br>
            <div>
                <div class="flex -mx-3">
                    <div class="w-full px-3 mb-5">
                        <!-- <label for="" class="text-xs font-bold px-1">Correo Electronico:</label> -->
                        @if($promedio >= 80 & $promedio < 89) <p class="mb-3 font-bold  text-subtitle text-nav-hover">Felicidades aprobo el examen con un buen promedio</p>
                            @elseif($promedio == 90 & $promedio < 100) <p class="mb-3  text-subtitle font-bold text-completed dark:text-gray-400">Felicidades aprobo el examen tuvo una calificación destacado</p>
                                @elseif($promedio == 100)
                                <p class="mb-3 font-bold text-nav-hover dark:text-gray-400">Muchas Felicidades Aprobo el Examen su Calificación es exelente</p>
                                @elseif($promedio < 79) <p class="mb-3 mx-2 font-bold text-subtitle text-red-700 dark:text-gray-400">Lo siento no aprobo el examen la calificacion minima es de 80</p>
                                    @endif
                    </div>
                </div>
                <div class="flex mx-3">
                    <div class="w-full px-3 mb-5">
                    @foreach(Auth::user()->examen as $examm)
                    @if($examm->id_examen == $id_examen)
                    @if($examm->pivot->numero_intento < 3) 
                    @if($promedio >= 80 )
                    @if($examenDI)
                    <a href="{{url('cursosEmpleados',$examenDI)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al Curso</a>
                    @else
                    <a href="{{route('verContenido',$examenID)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al Contenido</a>
                    @endif
                    @elseif($promedio < 79 )
                    <a href="{{route('verExamenempleado',$id_examen)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Volver a intentarlo</a>
                    @endif
                    @elseif($examm->pivot->numero_intento >= 3)
                    @if($examenDI)
                    <a href="{{url('cursosEmpleados',$examenDI)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al Curso</a>
                    @else
                    <a href="{{route('verContenido',$examenID)}}" class="block text-center w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Regresar al Contenido</a>
                    @endif
                    @endif
                    @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-appEmpleado>