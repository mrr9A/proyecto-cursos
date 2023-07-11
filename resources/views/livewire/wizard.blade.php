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
                <a href="#step-1" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 {{ $currentStep != 1 ? 'bg-secondary' : 'bg-dark' }}">1</a>
                <div class="text-1xl font-bold tracking-tight text-center text-dark-900 sm:text-1xl">
                    <span class="inline-block ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 2048 2048">
                            <path fill="currentColor" d="M1760 1590q66 33 119 81t90 107t58 128t21 142h-128q0-79-30-149t-82-122t-123-83t-149-30q-80 0-149 30t-122 82t-83 123t-30 149h-128q0-73 20-142t58-128t91-107t119-81q-75-54-117-135t-43-175q0-79 30-149t82-122t122-83t150-30q79 0 149 30t122 82t83 123t30 149q0 94-42 175t-118 135zm-224-54q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100q0 53 20 99t55 82t81 55t100 20zm-512 80q-32 37-58 77t-46 86q-53-55-128-85t-152-30H256V384H128v1408h787q-14 31-23 63t-15 65H0V256h256V128h384q88 0 169 27t151 81q69-54 150-81t170-27h384v128h256v640q-58-57-128-95V384h-128v369q-32-9-64-13t-64-4V256h-256q-70 0-136 24t-120 71v1265zm-128-13V351q-54-46-120-70t-136-25H384v1280h256q67 0 132 17t124 50z" />
                        </svg>
                    </span>
                    <P>Información del Curso</P>
                </div>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 {{ $currentStep != 2 ? 'bg-secondary' : 'bg-dark' }}" disabled="disabled">2</a>
                <div class="text-1xl font-bold tracking-tight text-center text-dark-900 sm:text-1xl">
                    <span class="inline-block ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 48 48">
                            <mask id="ipTNewComputer0">
                                <g fill="none" stroke="#fff" stroke-linejoin="round" stroke-width="4">
                                    <rect width="36" height="28" x="6" y="6" fill="#555" rx="3" />
                                    <path stroke-linecap="round" d="M14 42h20m-10-8v8" />
                                </g>
                            </mask>
                            <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTNewComputer0)" />
                        </svg>
                    </span>
                    <P>Modalidad</P>
                </div>
            </div>
            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 {{ $currentStep != 4 ? 'bg-secondary' : 'bg-dark' }}" disabled="disabled">4</a>
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
                    <P>Conmfirmar Datos</P>
                </div>
            </div>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <h3 class="text-7xl font-bold tracking-tight text-gray-900 sm:text-4xl">Información General del Curso</h3><br>
                <div class="grid col-11 gap-x-8 gap-y-6 text-blue-600/100">
                    <label for="apellidoPaterno">Nombre del Curso <span class="text-red-500">*</span></label>
                    <input type="text" rows="3"  wire:model="nombre" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" id="decription" require>
                    @error('nombre') <span class="error text-red-600">{{ $message }}</span> @enderror
                </div>
                <br>
                <div class="grid col-11 gap-x-8 gap-y-8 text-blue-600/100">
                    <label for="title">Codígo del Curso <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="codigo" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" id="nombre" require>
                    @error('codigo') <span class="error text-red-600">{{ $message }}</span> @enderror
                </div>
                <br>
                <div class="col-11 text-blue-600/100">
                    <label for="cover-photo">Imagen del Curso <span class="text-red-500">*</span></label>
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
                                    <span class="text-bold">Seleccionar una Imagen</span>
                                    <input id="file-upload" wire:model="imagen" type="file" class="sr-only" accept="image/*" require>
                                </label>
                            </div><br>
                            @error('imagen') <span class="error text-red-600">{{ $message }}</span> @enderror
                            <p class="text-xs leading-5 text-gray-600">Formatos Admitidos: PNG, JPG</p>
                        </div>
                    </div>
                </div>


                <br>
                <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{url('catalago')}}" type="button" require>
                    <img src="./img/cancelar.png"><span>Volver</span>
                </a>
                <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" wire:click="firstStepSubmit" type="button" require>
                    <img src="./img/siguiente-boton.png"><span>Continuar</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">

                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Información General del Curso</h3>
                <br>
                <div class="form-group ">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la Modalidad del Curso <span class="text-red-600">*</span></label>
                    <select id="countries" wire:model="modalidad_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Seleccione la Modalidad</option>
                        @foreach ($modalidad as $modi)
                        <option value="{{$modi->id_modalidad}}">{{$modi->modalidad}}</option>
                        @endforeach
                        @error('modalidad_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </select>
                </div>
                <br>
                <div class="form-group">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione el Tipo del Curso <span class="text-red-600">*</span></label>
                    <select id="countries" wire:model="tipo_curso_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Seleccione el Tipo</option>
                        @foreach ($tipo as $tip)
                        <option value="{{$tip->id_tipo_curso}}">{{$tip->nombre}}</option>
                        @endforeach
                        @error('tipo_curso_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </select>
                </div>
                <br>
                <div class="form-group">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la Categoria del Curso <span class="text-red-600">*</span></label>
                    <select id="countries" wire:model="categoria_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Seleccione la Categoria</option>
                        @foreach ($categoria as $category)
                        <option value="{{$category->id_categoria}}">{{$category->nombre}}</option>
                        @endforeach
                        @error('categoria_id') <span class="error text-red-600">{{ $message }}</span> @enderror
                    </select>
                </div>
                <br>
                <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button" wire:click="back(1)">
                    <img src="./img/hacia-atras.png" alt=""><span>Retroceder</span>
                </button>
                <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button" wire:click="secondStepSubmit">
                    <img src="./img/siguiente-boton.png" alt=""><span>Continuar</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Confirar Datos</h3>
                <br>
                <table class="w-full text-gray-500 dark:text-gray-400">
                    <tr>
                        <td class=" font-bold">Codigo del Curso</td>
                        <td class=" font-bold"><strong>{{$codigo}}</strong></td>
                    </tr>
                    <tr>
                        <td class=" font-bold">Nombre del Curso</td>
                        <td class=" font-bold"><strong>{{$nombre}}</strong></td>
                    </tr>
                    <tr>
                        <td class=" font-bold">Modalidad del Curso</td>
                        @foreach ($modalidad as $modi)
                        @if($modi->id_modalidad == $modalidad_id)
                        <td class=" font-bold"><strong>{{$modi->modalidad}}</strong></td>
                        @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td class=" font-bold">Tipo de Curso</td>
                        @foreach ($tipo as $tip)
                        @if($tip->id_tipo_curso == $tipo_curso_id)
                        <td class=" font-bold"><strong>{{$tip->nombre}}</strong></td>
                        @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td class=" font-bold">Categoria del Curso</td>
                        @foreach ($categoria as $category)
                        @if($category->id_categoria == $categoria_id)
                        <td class=" font-bold"><strong>{{$category->nombre}}</strong></td>
                        @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td class=" font-bold">Estatus del Curso:</td>
                        <td class=" font-bold"><strong>{{$estado ? 'Activo' : 'Inactivo'}}</strong></td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-800">
                        <td class=" font-bold">Imagen del Curso:</td>
                        <!-- <td><img src="{{$imagen}}" alt="avatar" width="100" height="100"></td> -->
                        <td>
                            @if ($imagen)
                            <img src="{{ $imagen}}" alt="avatar" width="125" height="125">
                            @endif
                        </td>
                    </tr>
                </table>

                <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button" wire:click="back(3)">
                    <img src="./img/hacia-atras.png" alt=""><span>Retroceder</span>
                </button>
                <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" wire:click="submitForm" type="button">
                    <img src="./img/guardar.png" alt=""><span>Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>