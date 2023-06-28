<form autocomplete="off" class="flex flex-col w-[400px] mx-12" action={{ route($route) }}>
    <label for="simple-search" class="sr-only">Search</label>
    <div class="flex items-center w-[400px] relative">
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white dark:text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="buscador" name="buscador"
                class="bg-input-buscador border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="{{ $placeholder ?? 'Identificador, puesto, nombre ...' }}" required>
        </div>
        <button type="submit"
            class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="sr-only">Search</span>
        </button>
        <div id="resultados" class="absolute bg-white shadow-md z-20 p-3 top-10 w-[400px] h-[350px hidden"></div>
    </div>

</form>

<script>
    const buscador = $('#buscador')
    const resultados = $('#resultados')

    const debouncedGetInfo = debounce(getInfoByBuscador, 1000);

    /**Cuando el evento keyup se dispara, se invoca la función debouncedGetInfo en lugar de llamar directamente a getInfoByBuscador.
     *  Debido a la naturaleza de la función debounced, si se producen múltiples eventos keyup rápidamente, el temporizador se reinicia cada vez,
     *  y solo se ejecuta getInfoByBuscador después de que ha pasado el tiempo especificado desde la última llamada.
     */

    /**En resumen, el código actualizado utiliza la función debounce para asegurarse de que la función getInfoByBuscador se ejecute solo después 
     * de un período de tiempo específico desde la última llamada, evitando así múltiples solicitudes a la base de datos en un corto período de tiempo.
     * */
    buscador.addEventListener('keyup', (e) => {
        debouncedGetInfo(e.target.value);
    });

    /** La función debounced tiene un temporizador que se reinicia cada vez que se llama. Solo cuando ha pasado el tiempo especificado 
     * (en este caso, 3000 milisegundos) desde la última llamada a la función debounced, se ejecuta realmente la función getInfoByBuscador
     * */
    function debounce(func, timeout = 1000) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                /** Una vez que se ha completado el tiempo de espera, se llama a la función original (func) utilizando el método apply.
                 *  Esto garantiza que la función debounced tenga el mismo contexto (this) y reciba los mismos argumentos (args) que la función original.*/
                func.apply(this, args);
            }, timeout);
        };
    }

    function getInfoByBuscador(texto) {
        console.log(texto)
        fetch(`http://localhost:8000/api/buscador?buscar=${texto}`)
            .then(res => res.json())
            .then(data => {
                console.log(data)
                let list = ""
                let arr = Object.values(data)
                arr.forEach(element => {
                    list += `
                    <li class="list">${element.empleado || element.nombre}</li>
                    `
                });

                if (resultados.classList.contains('hidden')) {
                    resultados.classList.remove('hidden');
                    resultados.classList.add('block');
                }
                resultados.innerHTML = `<ul>${list}</ul>`

                $$('.list').forEach(li => {
                    li.addEventListener('click', (e) => {
                        buscador.value = e.target.textContent
                        resultados.classList.remove('block')
                        resultados.classList.add('hidden')
                    })
                })


            })
            .catch(err => console.log(err))
    }
</script>
