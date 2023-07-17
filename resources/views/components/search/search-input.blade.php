<form autocomplete="on" class="flex flex-col w-auto" action={{ route($route, $id ?? null) }} id="form-search">
    <label for="simple-search" class="sr-only">Search</label>
    <div class="flex items-center relative">
        <div class="relative flex items-center mt-4 md:mt-0">
            <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </span>

            <input id="buscador" name="buscador" type="text"
                placeholder="{{ $placeholder ?? 'Identificador, puesto, nombre ...' }}"
                class="block w-full py-2.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80  placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 {{$classInput ?? "" }} ">
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
<!-- id="buscador" name="buscador" -->

<script>
    const buscador = $('#buscador')

    buscador.addEventListener('keypress', (e) => {
        const charCode = e.which || e.keyCode;
        const char = String.fromCharCode(charCode);
        const pattern = /[a-zA-Z0-9\s\-]/;

        if (!pattern.test(char)) {
            e.preventDefault();
        }
    })
    // const resultados = $('#resultados')

    // const debouncedGetInfo = debounce(getInfoByBuscador, 1000);

    /**Cuando el evento keyup se dispara, se invoca la función debouncedGetInfo en lugar de llamar directamente a getInfoByBuscador.
     *  Debido a la naturaleza de la función debounced, si se producen múltiples eventos keyup rápidamente, el temporizador se reinicia cada vez,
     *  y solo se ejecuta getInfoByBuscador después de que ha pasado el tiempo especificado desde la última llamada.
     */

    /**En resumen, el código actualizado utiliza la función debounce para asegurarse de que la función getInfoByBuscador se ejecute solo después 
     * de un período de tiempo específico desde la última llamada, evitando así múltiples solicitudes a la base de datos en un corto período de tiempo.
     * */
    // buscador.addEventListener('keyup', (e) => {
    //     debouncedGetInfo(e.target.value);
    // });

    /** La función debounced tiene un temporizador que se reinicia cada vez que se llama. Solo cuando ha pasado el tiempo especificado 
     * (en este caso, 3000 milisegundos) desde la última llamada a la función debounced, se ejecuta realmente la función getInfoByBuscador
     * */
    // function debounce(func, timeout = 1000) {
    //     let timer;
    //     return (...args) => {
    //         clearTimeout(timer);
    //         timer = setTimeout(() => {
    //             /** Una vez que se ha completado el tiempo de espera, se llama a la función original (func) utilizando el método apply.
    //              *  Esto garantiza que la función debounced tenga el mismo contexto (this) y reciba los mismos argumentos (args) que la función original.*/
    //             func.apply(this, args);
    //         }, timeout);
    //     };
    // }

    // function getInfoByBuscador(texto) {
    //     console.log(texto)
    //     fetch(`http://localhost:8000/api/buscador?buscar=${texto}`)
    //         .then(res => res.json())
    //         .then(data => {
    //             console.log(data)
    //             let list = ""
    //             let arr = Object.values(data["data"])
    //             arr.forEach(element => {
    //                 list += `
    //                 <li class="list">${element.empleado || element.nombre}</li>
    //                 `
    //             });

    //             if (resultados.classList.contains('hidden')) {
    //                 resultados.classList.remove('hidden');
    //                 resultados.classList.add('block');
    //             }
    //             resultados.innerHTML = `<ul>${list}</ul>`

    //             $$('.list').forEach(li => {
    //                 li.addEventListener('click', (e) => {
    //                     buscador.value = e.target.textContent
    //                     resultados.classList.remove('block')
    //                     resultados.classList.add('hidden')
    //                 })
    //             })


    //         })
    //         .catch(err => console.log(err))
    // }
</script>
