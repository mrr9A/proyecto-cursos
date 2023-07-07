<form action="{{ route('sucursales.store') }}" method="POST">
    @csrf

    <x-input-text nombre="nombre" text="Sucursal" placeholder="plaza del valle..."/>
    <x-input-text nombre="ciudad" text="Cuidad" placeholder="Oaxaca de juarez..."/>

    <div class="mt-3">

        <x-input-submit text="enviar"/>
    </div>
</form>
