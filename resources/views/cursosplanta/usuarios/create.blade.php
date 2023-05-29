<x-app>
    <form method="POST" action="{{ route('usuarios.store') }}"
    class="w-[400px] bg-blue-800 flex flex-col gap-2 p-4 rounded"
    >
        @csrf
        <x-input-text nombre="nombre" placeholder="nombre" />
        <x-input-text nombre="segundo_nombre" placeholder="segundo nombre" />
        <x-input-text nombre="apellido_paterno" placeholder="apellido paterno" />
        <x-input-text nombre="apellido_materno" placeholder="apellido materno" />

        <x-input-select :puestos=$puestos />

        <div id="trabajos" class="">

        </div>
        <x-input-submit text="Enviar" />
    </form>
    <script>
        const puestoSelecter = document.getElementById('puesto_id');
        const trabajosSelector = document.getElementById("trabajos")

        puestoSelecter.addEventListener('change', (e)=>{
            let id = e.target.value
            getJobsByPosition(id)
        })

        function getJobsByPosition(id) {
            fetch(`http://localhost:8000/api/puesto/${id}/trabajos`)
                .then(res => res.json())
                .then(data => {
                    let trabajos = ""
                    let msg = "<p>Selecciona los trabajos para el usuario</p>"
                    if(data.length < 1){
                        trabajos = "sin trabajos para el puesto, solo seleccion el puesto del usuario"
                        trabajosSelector.innerHTML = trabajos
                        return ;
                    }
                    data.forEach(trabajo => {
                        trabajos+=
                        `<label
                            class="cursor-pointer block w-52 h-auto rounded-lg shadow-[0_1px_5px_1px_rgba(150,50,200,0.4)] bg-gray-400 border-fuchsia-400 mb-4 overflow-hidden">
                            <input class="hidden peer" type="checkbox" name="trabajos[]" value="${trabajo.id_trabajo}" />
    
                            <div class="relative peer-checked:bg-fuchsia-50 h-full p-2">
                                <h2 class="uppercase text-sm text-black">${trabajo.nombre}</h2>
                            </div>
                        </label>`
                    });
                    trabajosSelector.innerHTML = msg + trabajos
                })
                .catch(err => console.log(err))
        }
    </script>
    </x-app>
