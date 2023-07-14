<div>
    <!-- 95117724  NUMERO IMPORTANTE-->
    @if(!empty($successMessage))
    <div class="alert alert-success">
        {{ $successMessage }}
    </div>
    @endif

    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="text-white bg-primary hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 {{ $currentStep != 1 ? 'bg-secondary' : 'bg-dark' }}">1</a>
                <div class="text-1xl font-bold tracking-tight text-center text-dark-900 sm:text-1xl">
                    <span class="inline-block ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 2048 2048">
                            <path fill="currentColor" d="M1760 1590q66 33 119 81t90 107t58 128t21 142h-128q0-79-30-149t-82-122t-123-83t-149-30q-80 0-149 30t-122 82t-83 123t-30 149h-128q0-73 20-142t58-128t91-107t119-81q-75-54-117-135t-43-175q0-79 30-149t82-122t122-83t150-30q79 0 149 30t122 82t83 123t30 149q0 94-42 175t-118 135zm-224-54q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100q0 53 20 99t55 82t81 55t100 20zm-512 80q-32 37-58 77t-46 86q-53-55-128-85t-152-30H256V384H128v1408h787q-14 31-23 63t-15 65H0V256h256V128h384q88 0 169 27t151 81q69-54 150-81t170-27h384v128h256v640q-58-57-128-95V384h-128v369q-32-9-64-13t-64-4V256h-256q-70 0-136 24t-120 71v1265zm-128-13V351q-54-46-120-70t-136-25H384v1280h256q67 0 132 17t124 50z" />
                        </svg>
                    </span>
                    <P>Información del curso</P>
                </div>
            </div>
            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="text-white bg-primary hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 {{ $currentStep != 4 ? 'bg-secondary' : 'bg-dark' }}" disabled="disabled">2</a>
                <div class="text-1xl font-bold tracking-tight text-center text-dark-900 sm:text-1xl">
                    <span class="inline-block ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path stroke-dasharray="60" stroke-dashoffset="60" d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s" values="60;0" />
                                </path>
                                <path stroke-dasharray="14" stroke-dashoffset="14" d="M8 12L11 15L16 10">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="14;0" />
                                </path>
                            </g>
                        </svg>
                    </span>
                    <P>Conmfirmar datos</P>
                </div>
            </div>
        </div>
    </div>


    <div class="w-full p-4 border-gray-200 rounded-lg px-44 dark:bg-gray-800 dark:border-gray-700 {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <br>
        <div class="flex justify-between -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <div class="w-full px-3">
                    <h3 class="text-7xl font-bold tracking-tight text-gray-900 uppercase text-section-subtitle">Información general:</h3><br>
                    <div class="grid col-11 gap-x-8 gap-y-6 text-blue-600/100">
                        <label for="apellidoPaterno" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nombre del curso <span class="text-red-500">*</span></label>
                        <input type="text" rows="3" wire:model="nombre" class="uppercase shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" id="decription" require>
                        @error('nombre') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div class="grid col-11 gap-x-8 gap-y-8 text-blue-600/100">
                        <label for="title" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Codígo del curso <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="codigo" class="uppercase shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" id="nombre" require>
                        @error('codigo') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3 mt-16">
                <div class="col-11">
                    <label for="cover-photo" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Imagen del curso <span class="text-red-500">*</span></label>

                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25">
                        <div class="text-center">
                            <span class="inline-block ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24">
                                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                        <path fill="none" stroke-dasharray="66" stroke-dashoffset="66" stroke-width="2" d="M3 14V5H21V19H3V14">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="66;0" />
                                        </path>
                                        <path fill="currentColor" fill-opacity="0" stroke-dasharray="52" stroke-dashoffset="52" d="M3 16L7 13L10 15L16 10L21 14V19H3Z">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.8s" values="52;0" />
                                            <animate fill="freeze" attributeName="fill-opacity" begin="1s" dur="0.15s" values="0;0.3" />
                                        </path>
                                    </g>
                                    <circle cx="7.5" cy="9.5" r="1.5" fill="currentColor" fill-opacity="0">
                                        <animate fill="freeze" attributeName="fill-opacity" begin="1s" dur="0.4s" values="0;1" />
                                    </circle>
                                </svg>
                            </span>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600" enctype="multipart/form-data">
                                <label for="file-upload" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">

                                    <span class="text-bold">Selecciona una imagen</span>

                                    <input id="file-upload" wire:model="imagen" type="file" class="sr-only" accept="image/*" require>
                                </label>
                            </div><br>
                            @error('imagen') <span class="error text-red-600">{{ $message }}</span> @enderror
                            <p class="text-xs leading-5 text-gray-600">Formatos admitidos: PNG, JPG</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-5">
                <div class="form-group ">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la modalidad<span class="text-red-600">*</span></label>
                    <select id="countries" wire:model="modalidad_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Seleccione la modalidad</option>
                        @foreach ($modalidad as $modi)
                        <option value="{{$modi->id_modalidad}}">{{$modi->modalidad}}</option>
                        @endforeach
                        @error('modalidad_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </select>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-4">
                <div class="form-group">

                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione el tipo<span class="text-red-600">*</span></label>

                    <select id="countries" wire:model="tipo_curso_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Seleccione el tipo</option>
                        @foreach ($tipo as $tip)
                        <option value="{{$tip->id_tipo_curso}}">{{$tip->nombre}}</option>
                        @endforeach
                        @error('tipo_curso_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </select>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <div class="form-group">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la categoria<span class="text-red-600">*</span></label>
                    <select id="countries" wire:model="categoria_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Seleccione la categoria</option>
                        @foreach ($categoria as $category)
                        <option value="{{$category->id_categoria}}">{{$category->nombre}}</option>
                        @endforeach
                        @error('categoria_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </select>
                </div>
            </div>
        </div>
        <div class="px-4">
            <a class="text-white bg-primary hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{url('catalago')}}" type="button" require>
                <img src="./img/cancelar.png"><span>Volver</span>
            </a>
            <button class="text-white bg-primary hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" wire:click="firstStepSubmit" type="button" require>
                <img src="./img/siguiente-boton.png"><span>Continuar</span>
            </button>
        </div>
    </div>

    <div class="w-full p-4 border-gray-200 rounded-lg px-44 dark:bg-gray-800 dark:border-gray-700 {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        <br>
        <h3 class="text-7xl font-bold tracking-tight text-gray-900 uppercase text-section-subtitle">Confirar Datos:</h3><br>
        <div>
            <br>
            <table class="w-full  text-left text-gray-500 dark:text-gray-400">
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class=" font-bold px-6 py-4">Codigo del curso</td>
                    <td class=" font-bold px-6 py-4"><strong>{{$codigo}}</strong></td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class=" font-bold px-6 py-4">Nombre del curso</td>
                    <td class=" font-bold px-6 py-4"><strong>{{$nombre}}</strong></td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class=" font-bold px-6 py-4">Modalidad del curso</td>
                    @foreach ($modalidad as $modi)
                    @if($modi->id_modalidad == $modalidad_id)
                    <td class=" font-bold px-6 py-4"><strong>{{$modi->modalidad}}</strong></td>
                    @endif
                    @endforeach
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class=" font-bold px-6 py-4">Tipo de curso</td>
                    @foreach ($tipo as $tip)
                    @if($tip->id_tipo_curso == $tipo_curso_id)
                    <td class=" font-bold px-6 py-4"><strong>{{$tip->nombre}}</strong></td>
                    @endif
                    @endforeach
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class=" font-bold px-6 py-4">Categoria del curso</td>
                    @foreach ($categoria as $category)
                    @if($category->id_categoria == $categoria_id)
                    <td class=" font-bold px-6 py-4"><strong>{{$category->nombre}}</strong></td>
                    @endif
                    @endforeach
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class=" font-bold px-6 py-4">Estatus del curso:</td>
                    <td class=" font-bold px-6 py-4"><strong>{{$estado ? 'Activo' : 'Inactivo'}}</strong></td>
                </tr>
            </table>
        </div><br>
        <button class="text-white bg-primary hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button" wire:click="back(1)">
            <img src="./img/hacia-atras.png" alt=""><span>Retroceder</span>
        </button>
        <button class="text-white bg-primary hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" wire:click="submitForm" type="button">
            <img src="./img/guardar.png" alt=""><span>Guardar</span>
        </button>
    </div>
</div>


<script>
    const inputsTexts = $$("input[type='text']")
    inputsTexts.forEach(element => {
        element.addEventListener('keypress', (e) => {

            const charCode = e.which || e.keyCode;
            const char = String.fromCharCode(charCode);
            const pattern = /[a-zA-Z0-9\s\-+]/

            if (!pattern.test(char)) {
                e.preventDefault();
            }
        })

        element.addEventListener('input', function() {
            const maxLength = 45; // Define la longitud máxima permitida
            console.log('holas')
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength); // Limita la longitud del valor
            }
        });
    });
</script>