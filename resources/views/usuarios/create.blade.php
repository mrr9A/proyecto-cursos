<x-app title="{{ is_null($usuario ?? null) ? 'Crear Usuario' : 'Actualizar Usuario' }}">
    <div class="container w-full ">
        <form id="multi-step-form" method="POST" action="{{ route('usuarios.store') }}"
            class="min-w-[100%]  mt-6 grid grid-cols-2 gap-8">
            @csrf

            <div class="step active rounded-md" data-step="1">
                <h3
                    class="text-3xl font-bold tracking-tight text-gray-900 text-section-subtitle text-center bg-gray-100">
                    Datos Personales</h3>
                <div class=" grid grid-cols-2 gap-6 border border-gray-200 shadow-sm rounded-md px-3 py-2 pb-6">
                    <x-input-text type="text" nombre="nombre" text="Nombre" placeholder="nombre" required
                        classLabel="text-base" :value="$usuario->nombre ?? ''" />
                    <x-input-text type="text" nombre="segundo_nombre" text="Segundo Nombre"
                        placeholder="segundo nombre" classLabel="text-base" :value="$usuario->segundo_nombre ?? ''" />
                    <x-input-text type="text" nombre="apellido_paterno" text="Apellido paterno"
                        placeholder="apellido paterno" required classLabel="text-base" :value="$usuario->apellido_paterno ?? ''" />
                    <x-input-text type="text" nombre="apellido_materno" text="Apellido materno"
                        placeholder="apellido materno" classLabel="text-base" :value="$usuario->apellido_materno ?? ''" />
                </div>
            </div>

            <div class="step" data-step="2">
                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center bg-gray-100">Datos de
                    Autenticación
                </h3>
                <div class="grid grid-cols-1 gap-6 border border-gray-200 shadow-sm rounded-md px-3 py-2 pb-6">
                    <x-input-text type="email" nombre="email" text="Correo electronico"
                        placeholder="user@grupobonn.com" required classLabel="text-base" :value="$usuario->email ?? ''" />
                    <x-input-text type="password" nombre="password" text="contraseña" placeholder="123456" required
                        classLabel="text-base" />
                </div>
            </div>

            <div class="step col-span-2" data-step="3">
                <h3 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center bg-gray-100 px-3">
                    Información Empresarial
                </h3>
                <div class="grid grid-cols-4 gap-6 border border-gray-200 shadow-sm rounded-md px-3 py-2">
                    <x-input-text type="number" nombre="id_sgp" text="ID SGP" placeholder="1351" required
                        classLabel="text-base" :value="$usuario->id_sgp ?? ''" />
                    <x-input-text type="number" nombre="id_sumtotal" text="ID SUMTOTAL" placeholder="1351" required
                        classLabel="text-base" :value="$usuario->id_sumtotal ?? ''" />
                    <x-input-text type="date" nombre="fecha_alta_planta" text="Fecha de alta en planta" required
                        classLabel="text-base" value="{{$usuario->fecha_alta_planta ?? '' ? date('Y-m-d', strtotime($usuario->fecha_alta_planta ?? '')) : '' }}" />
                    <x-input-text type="date" nombre="fecha_ingreso_puesto" text="Fecha de ingreso al puesto"
                        required classLabel="text-base" value="{{$usuario->fecha_ingreso_puesto ?? '' ?  date('Y-m-d', strtotime($usuario->fecha_ingreso_puesto ?? '')) : '' }}" />
                    {{-- SELECTS --}}
                    <?php
                    $estado = [(object) ['value' => 0, 'text' => 'inactivo'], (object) ['value' => 1, 'text' => 'activo']];
                    $permisos = [(object) ['value' => 0, 'text' => 'administrado'], (object) ['value' => 1, 'text' => 'empleado']];
                    ?>
                    <x-selects.input-select-default textLabel="estado del usuario" name="estado"
                        textOptionDefault="estado del usuario" :opciones="$estado" required />
                    <x-selects.input-select-default textLabel="permisos" name="rol"
                        textOptionDefault="permiso del usuario" :opciones="$permisos" required />
                    <x-selects.input-select textLabel="Sucursales" name="sucursal_id"
                        textOptionDefault="selecciona una sucursal" :sucursales="$sucursal" required :value="$usuario->sucursales[0] ?? ''" />
                    <x-selects.input-select textLabel="Puestos" name="puesto_id"
                        textOptionDefault="selecciona un puesto" :puestos="$puestos" required :value="$usuario->puestos ?? ''" />

                    <div id="trabajos" class="col-span-4"></div>
                </div>
            </div>
            <div class="col-span-2">
                <x-input-submit text="Enviar" class="w-full" />
            </div>
        </form>
    </div>

    <script>
        // Llamando los trabos de los puestos y renderizarlos
        const puestoSelecter = document.getElementById('puesto_id');
        const trabajosSelector = document.getElementById("trabajos")
        let puesto = "";

        // Ejecutar función inicial al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener el valor seleccionado del select
            let selectedValue = puestoSelecter.value;
            puesto = puestoSelecter.options[selectedValue].text
            // Verificar si el valor seleccionado no es el valor por defecto
            if (selectedValue !== 'default') {
                getJobsByPosition(selectedValue);
            }
        });

        puestoSelecter.addEventListener('change', (e) => {
            let id = e.target.value
            puesto = puestoSelecter.options[id].text
            document.getElementById("select_puesto").setAttribute("disabled", true);
            getJobsByPosition(id)
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
                      <input class="hidden peer" type="checkbox" ${puesto === trabajo.nombre ? "checked disabled" : ""}   name="trabajos[]"  wire:model="trabajos" value="${trabajo.id_trabajo}" />
                      ${puesto === trabajo.nombre ? `<input type="hidden" name="trabajos[]" value="${trabajo.id_trabajo}" />` : ""}
                      <div class="relative peer-checked:bg-blue-100 h-full p-2">
                          <h2 class="uppercase text-sm text-black">${trabajo.nombre}</h2>
                      </div>
                  </label>`
                    });
                    trabajosSelector.innerHTML = msg + `<div class='flex flex-wrap gap-3'>${trabajos}</div>`
                })
                .catch(err => {
                    console.log(err)
                })
        }



        //FUNCIONES PARA EL FORMULARIO POR PASOS 
        // Obtén los elementos del formulario y los botones de navegación
        //         const form = document.getElementById('multi-step-form');
        // const steps = Array.from(form.getElementsByClassName('step'));
        // const nextButtons = Array.from(form.getElementsByClassName('next-button'));
        // const previousButtons = Array.from(form.getElementsByClassName('previous-button'));
        // const num = $$('.num')

        // // Agrega eventos de clic a los botones de navegación
        // nextButtons.forEach(button => {
        //     button.addEventListener('click', () => {
        //         navigateToNextStep(button);
        //     });
        // });

        // previousButtons.forEach(button => {
        //     button.addEventListener('click', () => {
        //         navigateToPreviousStep(button);
        //     });
        // });

        // // Función para mostrar el siguiente paso
        // function navigateToNextStep(button) {
        //     const currentStep = button.closest('.step');
        //     const nextStep = currentStep.nextElementSibling;
        //     // Verificar la validez de los campos de entrada dentro del contenedor actual
        //     const inputs = currentStep.querySelectorAll('input, select, textarea');
        //     let isValid = true;
        //     inputs.forEach(input => {
        //         if (!input.checkValidity()) {
        //             isValid = false;
        //             // Agrega lógica para manejar el error en el campo de entrada si es necesario
        //         }
        //     });

        //     if (isValid) {
        //         currentStep.classList.remove('active');
        //         nextStep.classList.add('active');

        //         if (currentStep.getAttribute('data-step') == 1) {
        //             num[0].classList.add('checked')
        //         }
        //         if (currentStep.getAttribute('data-step') == 2) {
        //             num[1].classList.add('checked')
        //         }
        //         if (currentStep.getAttribute('data-step') == 3) {
        //             num[2].classList.add('checked')
        //         }
        //     }
        // }

        // // Función para mostrar el paso anterior
        // function navigateToPreviousStep(button) {
        //     const currentStep = button.closest('.step');
        //     const previousStep = currentStep.previousElementSibling;
        //     currentStep.classList.remove('active');
        //     previousStep.classList.add('active');
        //     // Eliminando el color verde de que ya completo ese paso
        //     if (previousStep.getAttribute('data-step') == 1) {
        //         num[0].classList.remove('checked')
        //     }
        //     if (previousStep.getAttribute('data-step') == 2) {
        //         num[1].classList.remove('checked')
        //     }
        //     if (previousStep.getAttribute('data-step') == 3) {
        //         num[2].classList.remove('checked')
        //     }


        // }
    </script>
</x-app>
