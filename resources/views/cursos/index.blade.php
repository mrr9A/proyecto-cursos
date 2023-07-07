<x-app title="Cursos">
    <div class="h-full">
        <div class="contain-modalidad-tipo-curso flex flex-wrap gap-6 justify-between">
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">modalidades</p>
                    <x-modal title="Crear modalidad" textButton="" id="crear_modalidad"
                        vistaContenidoModal="cursosplanta.modalidad.create" class="text-blue-800 hover:text-blue-700 " />
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($modalidad as $modalidad)
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $modalidad->modalidad }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-bold">Tipos de curso</p>
                    <x-modal title="Crear tipo curso" textButton="" id="crear_tipo_curso"
                        vistaContenidoModal="cursosplanta.tipos.create" class="text-blue-800 hover:text-blue-700" />
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tipos as $tipo)
                        <span class="text-gray-600 bg-gray-100 rounded-md py-1 px-2">{{ $tipo->nombre }}</span>
                    @endforeach
                </div>
            </div>
        </div>



        <div class="flex justify-center gap-10 w-full h-2/3 mt-5">
            <a href="{{ route('cursos.index') }}"
                class="flex flex-col justify-center w-[400px] p-4  mt-4 bg-primary rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 hover:bg-primary-light">
                <h5 class="mb-4 text-title font-medium text-white dark:text-gray-400">Cursos planta</h5>
                <div class="text-gray-200 ">
                    <h6 class="text-3xl font-semibold">description</h6>
                    <p class="text-sm italic font-normal text-gray-300 dark:text-gray-400">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque itaque molestiae voluptate consectetur amet veritatis quia facilis repellat, repudiandae omnis quod numquam ipsum modi sequi necessitatibus facere, quidem voluptatibus ea?
                    </p>
                </div>
            </a>

            <a href="{{ route('curs.index') }}"
                class="flex flex-col justify-center w-[400px] p-4  mt-4 bg-primary rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 hover:bg-primary-light">
                <h5 class="mb-4 text-title font-medium text-white dark:text-gray-400">Cursos internos</h5>
                <div class="flex items-baseline text-gray-900 ">
                    <span class="text-3xl font-semibold">$</span>
                    <span class="text-5xl font-extrabold tracking-tight">49</span>
                    <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">/month</span>
                </div>
                <button type="button"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose
                    plan</button>
            </a>
        </div>
    </div>

</x-app>
