<x-app title="Calificación">
    <div class="min-w-screen h-full min-h-screen   px-5 py-5 flex justify-center shadow-all">
            <div class="h-4/5 w-1/2 py-10 px-5  bg-gray-100 md:px-10">
                <div class="text-center mb-10">
                    <h1 class="font-bold text-3xl text-title text-gray-900">TU CALIFICACIÓN OBTENIDA ES DE: </h1><br>
                    <p class="mb-2 text-title font-bold tracking-tight text-gray-900 dark:text-white">{{$promedio}} %</p>
                </div><br>
                <div>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            @if($promedio >= 80 & $promedio < 89) <p class="mb-3 font-bold  text-subtitle text-nav-hover">Felicidades aprobo el examen con un buen promedio</p>
                            @elseif($promedio == 90 & $promedio < 100) <p class="mb-3  text-subtitle font-bold text-completed dark:text-gray-400">Felicidades aprobo el examen tuvo una Calificación destacada</p>
                            @elseif($promedio == 100)
                            <p class="mb-3 font-bold text-nav-hover dark:text-gray-400">Muchas felicidades aprobo el examen su calificación es exelente</p>
                            @elseif($promedio < 79) <p class="mb-3 mx-2 font-bold text-subtitle text-red-700 dark:text-gray-400">Lo siento no aprobo el examen la calificacion minima es de 80</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex mx-3">
                        <div class="w-full px-3 mb-5">
                            <button  class="block w-full max-w-xs mx-auto bg-btn-primary hover:bg-btn-primary-light focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Volver a intentarlo</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</x-app>