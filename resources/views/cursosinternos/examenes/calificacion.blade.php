<x-app>
    <div class="items-center">
        <div class="max-w-xs bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg w-96" src="https://agustinosleon.com/wp-content/uploads/2021/12/000-publicacion-calificaciones-primera-evaluacion.jpg" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">TU CALIFICACIÓN OBTENIDA ES DE: </h5>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$promedio}} %</h5>
                </a>
                @if($promedio >= 80 & $promedio < 89)
                <p class="mb-3 font-bold text-nav-hover">Felicidades Aprobo el Examen con un buen promedio</p>
                @elseif($promedio == 90 & $promedio < 100)
                <p class="mb-3 font-bold text-completed dark:text-gray-400">Felicidades Aprobo el Examen tuvo una Calificación destacado</p>
                @elseif($promedio == 100)
                <p class="mb-3 font-bold text-nav-hover dark:text-gray-400">Muchas Felicidades Aprobo el Examen su Calificación es exelente</p>
                @elseif($promedio < 79)
                <p class="mb-3 font-bold text-red-700 dark:text-gray-400">Lo siento no Aprobo el Examen la Calificacion Minima es de 80</p>
                @endif
                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Volver a Intentarlo
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app>