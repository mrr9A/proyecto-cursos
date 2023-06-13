<div class="relative w-[400px]">
    <form class="flex items-center">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="simple-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Identificador, puesto, nombre ..." required>
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
    </form>


    <button id="dropdownButton"
        class="text-blue-600 border-black font-medium rounded-lg text-sm py-2 text-center inline-flex items-center"
        type="button">Filtros <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg></button>

    <!-- Dropdown menu -->
    <div id="dropdownMenu"
        class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow-md dark:bg-gray-700 dark:divide-gray-600">
        <div class="p-3">
            <form class="w-full flex flex-wrap gap-2">
                <select name="puesto_id" id="puesto_id" class="py-2 text-sm  border-b-[1px] border-b-black focus:outline-none border-transparent focus:border-transparent rounded-md uppercase">

                    <option value="" id="select_puesto" class="text-gray-400">puestos</option>
                    <option value="1">
                        Consultor de experiencia
                    </option>
                </select>


                <select name="puesto_id" id="puesto_id"
                    class="py-2 text-sm  border-b-[1px] border-b-black focus:outline-none border-transparent focus:border-transparent rounded-md uppercase">
                    <option value="" id="select_puesto" class="text-gray-400">sucursales</option>
                    <option value="1">
                        plaza valle
                    </option>
                </select>

                <div class="py-2">
                    <x-input-submit text="aceptar" class="cursor-pointer text-white capitalize bg-primary hover:bg-primary-light" />
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    const dropMenu = document.getElementById('dropdownMenu');
    // set the element that trigger the dropdown menu on click
    const dropButton = document.getElementById('dropdownButton');

    dropButton.addEventListener('click', (e) => {

        if (dropMenu.classList.contains('hidden')) {
            dropMenu.classList.remove('hidden');
            dropMenu.classList.add('block');
        } else {
          dropMenu.classList.remove('block');
          dropMenu.classList.add('hidden');
        }
    })
</script>
