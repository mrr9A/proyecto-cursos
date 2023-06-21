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
                <a href="#step-1" type="button" class="btn btn-circle text-white {{ $currentStep != 1 ? 'bg-secondary' : 'bg-dark' }}">1</a>
                <p><img src="./img/informacion.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Información Personal</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-circle text-white {{ $currentStep != 2 ? 'bg-secondary' : 'bg-dark' }}">2</a>
                <p><img src="./img/informacion-personal.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Datos de Ingreso</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle text-white {{ $currentStep != 3 ? 'bg-secondary' : 'bg-dark' }}" disabled="disabled">3</a>
                <p><img src="./img/salida-a-bolsa.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Información Empresarial</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle text-white {{ $currentStep != 4 ? 'bg-secondary' : 'bg-dark' }}" disabled="disabled">4</a>
                <p><img src="./img/confirmar.png" class="avatar" alt=""></p>
                <p class="text-1xl font-bold tracking-tight text-dark-900 sm:text-1xl">Conmfirmar Datos</p>
            </div>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Datos Personales</h3>
                <br>
                <div class="form-group">
                    <label for="nombre" class="block text-sm font-semibold leading-6 text-gray-900">Primer Nombre <span class="text-danger">*</span></label>
                    <input type="text" wire:model="nombre" class="form-control" id="taskTitle" require>
                    @error('nombre') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="segundo_nombre" class="block text-sm font-semibold leading-6 text-gray-900">Segundo Nombre <span class="text-secondary text-sm ">opcional</span></label>
                    <input type="text" wire:model="segundo_nombre" class="form-control" id="segundo_nombre">
                    @error('segundo_nombre') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="apellido_paterno" class="block text-sm font-semibold leading-6 text-gray-900">Apellido Paterno <span class="text-danger">*</span></label>
                    <input type="text" wire:model="apellido_paterno" class="form-control" id="apellido_paterno" require>
                    @error('apellido_paterno') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="apellido_materno" class="block text-sm font-semibold leading-6 text-gray-900">Apellido Materno <span class="text-secondary text-sm">opcional</span></label>
                    <input type="text" wire:model="apellido_materno" class="form-control" id="apellido_materno">
                    @error('apellido_materno') <span class="error">{{ $message }}</span> @enderror
                </div>

                <a class="btn btn-primary nextBtn btn-lg bg-dark" href="{{url('usuarios')}}" type="button" require>
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
                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Datos de Autenticación</h3>

                <div class="form-group">
                    <label for="email">Correo <span class="text-danger">*</span></label><br />
                    <input type="email" wire:model="email" class="form-control" require>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" wire:model="password" class="form-control" id="productAmount" require>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>

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
                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Información Empresarial</h3>

                <div class="form-group">
                    <label for="id_sgp">ID SGP <span class="text-danger">*</span></label><br />
                    <input type="number" wire:model="id_sgp" class="form-control" require>
                    @error('id_sgp') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="id_sumtotal">ID SUM TOTAL <span class="text-danger">*</span></label><br />
                    <input type="number" wire:model="id_sumtotal" class="form-control" require>
                    @error('id_sumtotal') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="input-number">Fecha de alta en PLanta</label>
                        <input type="date" id="fecha_alta_planta" wire:model="fecha_alta_planta" class="form-control" placeholder="Fecha de alta">
                        @error('fecha_alta_planta') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="input-number">Fecha de Ingreso al Puesto</label>
                        <input type="date" id="fecha_ingreso_puesto" wire:model="fecha_ingreso_puesto" class="form-control" placeholder="Fecha de Ingreso">
                        @error('fecha_ingreso_puesto') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="estado">Estatus del Usuario <span class="text-danger">*</span></label><br />
                    <label class="radio-inline"><input type="radio" wire:model="estado" value="1" {{{ $estado == '1' ? "checked" : "" }}}> Activo</label>
                    <label class="radio-inline"><input type="radio" wire:model="estado" value="0" {{{ $estado == '0' ? "checked" : "" }}}> Inactivo</label>
                    @error('estado') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="rol_id">Permiso a Asignar al Usuario <span class="text-danger">*</span></label><br />
                    <select class="form-select form-select" value="rol" id="rol" wire:model="rol" aria-label=".form-select-sm example" required>
                        <option selected>Selecciona el Permiso a Otorgar</option>
                        <option value="0" {{{ $rol == '0' ? "checked" : "" }}}>Administrador</option>
                        <option value="1" {{{ $rol == '1' ? "checked" : "" }}}>Empleado</option>
                    </select>
                    @error('rol') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="sucursal_id">Sucursal en la que labora <span class="text-danger">*</span></label><br />
                    <select class="form-select form-select" id="sucursal_id" wire:model="sucursal_id" aria-label=".form-select-sm example" required>
                        <option selected>Selecciona la Sucursal donde Labora</option>
                        @foreach ($sucursal as $sucursa)
                        <option value="{{$sucursa->id_sucursal}}">{{$sucursa->nombre}}</option>
                        @endforeach
                    </select>
                    @error('sucursal_id') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="puesto_id">Puesto Laboral <span class="text-danger">*</span></label><br />
                    <select class="form-select form-select" name="puesto_id" id="puesto_id" wire:model="puesto_id" wire:change="updateData" aria-label=".form-select-sm example" required>
                        <option selected id="select_puesto">Selecciona su Puesto de trabajo</option>
                        @foreach ($puesto as $puest)
                        <option value="{{$puest->id_puesto}}">{{$puest->puesto}}</option>
                        @endforeach
                    </select>
                    @error('puesto_id') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div id="trabajos">
                    @foreach($trabajos as $trabajo)
                        {{$trabajo->nombre}}
                        @dump($trabajo)
                        <!-- <label
                        class="cursor-pointer block w-52 h-auto rounded-lg shadow-[0_1px_5px_1px_rgba(150,50,200,0.4)] bg-gray-400 border-fuchsia-400 mb-4 overflow-hidden">
                        <input class="hidden peer" type="checkbox" ${puesto_id === trabajo.nombre ? "checked disabled" : ""}   name="trabajos[]"  wire:model="trabajos.${trabajo.id_trabajo}" value="${trabajo.id_trabajo}" />
                        ${puesto === trabajo.nombre ? `<input type="hidden" name="trabajos[]" value="${trabajo.id_trabajo}" />` : ""}
                        <div class="relative peer-checked:bg-blue-100 h-full p-2">
                            <h2 class="uppercase text-sm text-black">${trabajo.nombre}</h2>
                        </div>
                    </label> -->
                    @endforeach

                </div>





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
                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Confirmar Datos</h3>
                <br>
                <table class="table">
                    <tr>
                        <td>Primer Nombre</td>
                        <td><strong>{{$nombre}}</strong></td>
                    </tr>
                    <tr>
                        <td>Segundo Nombre</td>
                        <td><strong>{{$segundo_nombre}}</strong></td>
                    </tr>
                    <tr>
                        <td>Apellido Paterno</td>
                        <td><strong>{{$apellido_paterno}}</strong></td>
                    </tr>
                    <tr>
                        <td>Apellido Materno</td>
                        <td><strong>{{$apellido_materno}}</strong></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><strong>{{$email}}</strong></td>
                    </tr>
                    <tr>
                        <td>Contraseña</td>
                        <td><strong><input type="password" disabled value="{{$password}}"></strong></td>
                    </tr>
                    <tr>
                        <td>Permiso Asignado</td>
                        @if ($rol == 0)
                        <td><strong>Administrador</strong></td>
                        @elseif ($rol == 1)
                        <td><strong>Empleado</strong></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Sucursal Seleccionada</td>
                        @foreach ($sucursal as $sucursa)
                        @if ($sucursa->id_sucursal == $sucursal_id)
                        <td><strong>{{$sucursa->nombre}}</strong></td>
                        @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td>Puesto Seleccionado</td>
                        @foreach ($puesto as $puest)
                        @if ($puest->id_puesto == $puesto_id)
                        <td><strong>{{$puest->puesto}}</strong></td>
                        @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td>Estatus del Usuario:</td>
                        <td><strong>{{$estado ? 'Activo' : 'Inactivo'}}</strong></td>
                    </tr>
                    <tr>
                        <td>Fecha de Ingreso a la Planta</td>
                        <td>{{$fecha_alta_planta}}</td>
                    </tr>
                    <tr>
                        <td>Fecha de Ingreso al Puesto</td>
                        <td>{{$fecha_ingreso_puesto}}</td>
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


<!-- 
<script>
    const puestoSelecter = document.getElementById('puesto_id');
    const trabajosSelector = document.getElementById("trabajos")
    let puesto = "";
    document.addEventListener('livewire:load', function () {
        puestoSelecter.addEventListener('change', (e) => {
            let id = e.target.value
            puesto = puestoSelecter.options[id].text
            document.getElementById("select_puesto").setAttribute("disabled", true);
            getJobsByPosition(id)
        })
    })

    function getJobsByPosition(id) {
        // let loading = true;
        trabajosSelector.innerHTML = `
        <div role="status" class="flex flex-col items-center">
            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
        `
        fetch(`http://localhost:8000/api/cursosplanta/puesto/${id}/trabajos`)
            .then(res => res.json())
            .then(data => {
                let trabajos = ""
                let msg = "<p>Selecciona los trabajos para el usuario</p>"
                if (data.length < 1) {
                    trabajos = "sin trabajos para el puesto, solo seleccion el puesto del usuario"
                    trabajosSelector.innerHTML = trabajos
                    return;
                }
                console.log(data)
                data.forEach(trabajo => {
                    trabajos +=
                        `<label
                        class="cursor-pointer block w-52 h-auto rounded-lg shadow-[0_1px_5px_1px_rgba(150,50,200,0.4)] bg-gray-400 border-fuchsia-400 mb-4 overflow-hidden">
                        <input class="hidden peer" type="checkbox" ${puesto === trabajo.nombre ? "checked disabled" : ""}   name="trabajos[]"  wire:model="trabajos.${trabajo.id_trabajo}" value="${trabajo.id_trabajo}" />
                        ${puesto === trabajo.nombre ? `<input type="hidden" name="trabajos[]" value="${trabajo.id_trabajo}" />` : ""}
                        <div class="relative peer-checked:bg-blue-100 h-full p-2">
                            <h2 class="uppercase text-sm text-black">${trabajo.nombre}</h2>
                        </div>
                    </label>`
                });
                trabajosSelector.innerHTML = msg + trabajos
            })
            .catch(err => {
                console.log(err)
            })
    }
</script> -->