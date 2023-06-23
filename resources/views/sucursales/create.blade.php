<form action="{{ route('sucursales.store') }}" method="POST">
    @csrf
    <h6 class="heading-small text-muted mb-4">Datos Generales</h6>

    <x-input-text nombre="nombre" text="Sucursal" placeholder="plaza del valle..."/>
    <x-input-text nombre="ciudad" text="Cuidad" placeholder="Oaxaca de juarez..."/>

    <x-input-submit text="enviar"/>
</form>
