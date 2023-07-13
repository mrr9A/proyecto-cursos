<form action="{{ route('sucursales.store') }}" method="POST" class="flex flex-col gap-5">
    @csrf

    <x-input-text nombre="nombre" text="Sucursal" placeholder="plaza del valle..." required/>
    <x-input-text nombre="ciudad" text="Cuidad" placeholder="Oaxaca de juarez..." required/>
    <x-input-text nombre="codigo" text="Codigo" placeholder="123as-a" required/>

    <div class="mt-3">

        <x-input-submit text="enviar"/>
    </div>
</form>
