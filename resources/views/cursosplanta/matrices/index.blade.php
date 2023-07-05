<x-app title="matrices">
    <div class="flex justify-between my-2 items-center">
        <p>Para cambiar la calificacion del usuario solo seleccione los cursos a calificar como aprovado y a
            enviar<br>Si desea calificar los cursos del usuario por porgreso tiene que ir al detalle</p>


        <x-search.search-input route="matrices.index" />
    </div>


    <x-tables.table :empleados="$data" />
</x-app>
