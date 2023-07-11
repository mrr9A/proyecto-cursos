<x-app title="matrices">
    <div class="flex justify-between my-2 items-center">
        <p>Para calificar a un empleado seleccione el curso a calificar y en el boton de enviar.
            <br>En caso de solo indicar el procentaje que lleva por curso ir al detalle de cada usuario
        </p>

        <x-search.search-input route="matrices.index" />
    </div>


    <x-tables.table :empleados="$data" />
</x-app>
