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
                <a href="#step-1" type="button" class="btn btn-circle text-white {{ $currentStep != 1 ? 'bg-primary' : 'bg-dark' }}">1</a>
                <p><img src="./img/aprender-en-linea.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Información del Curso</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-circle text-white {{ $currentStep != 2 ? 'bg-secondary' : 'bg-dark' }}">2</a>
                <p><img src="./img/informacion-personal.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Configuración del Acceso del Curso</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle text-white {{ $currentStep != 3 ? 'bg-secondary' : 'bg-dark' }}" disabled="disabled">3</a>
                <p><img src="./img/salida-a-bolsa.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Modalidad</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="btn btn-circle text-white {{ $currentStep != 4 ? 'bg-secondary' : 'bg-dark' }}" disabled="disabled">4</a>
                <p><img src="./img/confirmar.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Conmfirmar Datos</p>
            </div>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Información General del Curso</h3><br>

                <div class="grid col-11 gap-x-8 gap-y-8">
                    <label for="title">Codígo del Curso <span class="text-danger">*</span></label>
                    <input type="text" wire:model="codigo" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-2200 sm:text-sm sm:leading-6" id="nombre" require>
                    @error('codigo') <span class="error">{{ $message }}</span> @enderror
                </div>
                <br>
                <div class="grid col-11 gap-x-8 gap-y-6">
                    <label for="apellidoPaterno">Nombre del Curso <span class="text-danger">*</span></label>
                    <input type="text" rows="3" wire:model="nombre" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="decription" require>
                    @error('nombre') <span class="error">{{ $message }}</span> @enderror
                </div>
                <br>
                <!-- <div class="form-group" enctype="multipart/form-data">
                    <label for="imagen">Imagen del Curso <span class="text-danger">*</span></label>
                    <input type="file" wire:model="imagen" class="form-control" accept="image/*" id="imagen" require>
                    @error('imagen') <span class="error">{{ $message }}</span> @enderror
                </div> -->

                <div class="col-11" >
                    <label for="cover-photo">Imagen del Curso <span class="text-danger">*</span></label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25">
                        <div class="text-center">
                            <img src="./img/imagen.png" class="avatar" alt="">
                            <div class="mt-4 flex text-sm leading-6 text-gray-600" enctype="multipart/form-data">
                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Seleccionar una Imagen</span>
                                    <input id="file-upload" wire:model="imagen" type="file" class="sr-only" accept="image/*" require>
                                    @error('imagen') <span class="error">{{ $message }}</span> @enderror
                                    @if ($imagen)
                                    <img src="{{ $imagen->temporaryUrl() }}" alt="avatar" width="100" height="100">@endif
                                </label>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">Formatos Admitidos: PNG, JPG</p>
                        </div>
                    </div>
                </div>


        <br>
        <a class="btn btn-primary nextBtn btn-lg bg-dark" href="{{url('catalago')}}" type="button" require>
            <img src="./img/cancelar.png" alt=""><span>Volver</span>
        </a>
        <button class="btn btn-primary nextBtn btn-lg bg-dark" wire:click="firstStepSubmit" type="button" require>
            <img src="./img/siguiente-boton.png" alt=""><span>Continuar</span>
        </button>
    </div>
</div>
</div>

<div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
    <div class="col-xs-12">
        <div class="col-md-12">

            <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Información General del Curso</h3>
            <br>
            <div class="grid col-10 gap-x-8 gap-y-6">
                <label for="fecha_inicio">Fecha de Inicio del Curso <span class="text-danger">*</span></label>
                <input type="date" rows="3" wire:model="fecha_inicio" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_inicio" require>
                @error('nombre') <span class="error">{{ $message }}</span> @enderror
            </div>
            <br>
            <div class="grid col-10 gap-x-8 gap-y-6">
                <label for="fecha_termino">Fecha de Termino del Curso <span class="text-danger">*</span></label>
                <input type="date" rows="3" wire:model="fecha_termino" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_termino" require>
                @error('nombre') <span class="error">{{ $message }}</span> @enderror
            </div>
            <br>
            <button class="btn btn-danger nextBtn btn-lg bg-dark" type="button" wire:click="back(1)">
                <img src="./img/hacia-atras.png" alt=""><span>Retroceder</span>
            </button>
            <button class="btn btn-primary nextBtn btn-lg bg-dark" type="button" wire:click="secondStepSubmit">
                <img src="./img/siguiente-boton.png" alt=""><span>Continuar</span>
            </button>
        </div>
    </div>
</div>

<div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Modalidad de Cursos</h3>
            <br>
            <div class="form-group ">
                <label for="description">Clasificación de Cursos</label><br />
                @foreach ($modalidad as $modi)
                <label class="radio-inline"><input type="radio" wire:model="modalidad_id" value="{{$modi->id_modalidad}}">{{$modi->modalidad}}</label>
                <!-- <label class="radio-inline"><input type="radio" wire:model="modalidad_id" value="0">Curso Interno</label> -->
                @error('modalidad_id') <span class="error">{{ $message }}</span> @enderror
                @endforeach
            </div>

            <div class="form-group">
                <label for="description">Clasificación de Cursos</label><br />
                @foreach ($tipo as $tip)
                <label class="radio-inline"><input type="radio" wire:model="tipo_curso_id" value="{{$tip->id_tipo_curso}}">{{$tip->nombre}}</label>
                <!-- <label class="radio-inline"><input type="radio" wire:model="modalidad_id" value="0">Curso Interno</label> -->
                @error('tipo_curso_id') <span class="error">{{ $message }}</span> @enderror
                @endforeach
            </div>
            <br>
            <button class="btn btn-danger nextBtn btn-lg bg-dark" type="button" wire:click="back(2)">
                <img src="./img/hacia-atras.png" alt=""><span>Retroceder</span>
            </button>
            <button class="btn btn-primary nextBtn btn-lg bg-dark" type="button" wire:click="threeStepSubmit">
                <img src="./img/siguiente-boton.png" alt=""><span>Continuar</span>
            </button>
        </div>
    </div>
</div>

<div class="row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Confirar Datos</h3>
            <br>
            <table class="table">
                <tr>
                    <td>Codigo del Curso</td>
                    <td><strong>{{$codigo}}</strong></td>
                </tr>
                <tr>
                    <td>Nombre del Curso</td>
                    <td><strong>{{$nombre}}</strong></td>
                </tr>
                <tr>
                    <td>Fecha de Inicio del Curso</td>
                    <td><strong>{{$fecha_inicio}}</strong></td>
                </tr>
                <tr>
                    <td>Fecha de Termino del Curso</td>
                    <td><strong>{{$fecha_termino}}</strong></td>
                </tr>
                <tr>
                    <td>Modalidad del Curso</td>
                    @foreach ($modalidad as $modi)
                    @if($modi->id_modalidad == $modalidad_id)
                    <td><strong>{{$modi->modalidad}}</strong></td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td>Tipo de Curso</td>
                    @foreach ($tipo as $tip)
                    @if($tip->id_tipo_curso == $tipo_curso_id)
                    <td><strong>{{$tip->nombre}}</strong></td>
                    @endif
                    @endforeach
                </tr>
                <tr>
                    <td>Estatus del Curso:</td>
                    <td><strong>{{$estado ? 'Activo' : 'Inactivo'}}</strong></td>
                </tr>
                <tr>
                        <td>Imagen del Curso:</td>
                        <!-- <td><img src="{{$imagen}}" alt="avatar" width="100" height="100"></td> -->
                        <td>
                            @if ($imagen)
                            <img src="{{ $imagen->temporaryUrl() }}" alt="avatar" width="125" height="125">
                            @endif
                        </td>
                    </tr>
            </table>

            <button class="btn btn-danger nextBtn btn-lg bg-dark" type="button" wire:click="back(3)">
                <img src="./img/hacia-atras.png" alt=""><span>Retroceder</span>
            </button>
            <button class="btn btn-success btn-lg bg-dark" wire:click="submitForm" type="button">
                <img src="./img/guardar.png" alt=""><span>Guardar</span>
            </button>
        </div>
    </div>
</div>
</div>