  <div class="w-full">
    <form action="{{ route('tipos.update', $tipo->id_tipo_curso) }}" method="POST" class="formulario-actualizar">
        @csrf
        @method('PUT')
        <x-input-text nombre="nombre" text="Nombre" :value="$tipo->nombre" required classLabel="text-base" />
        <x-input-text nombre="duracion" text="Duracion" :value="$tipo->duracion" required classLabel="text-base" />
        <br />
        <x-input-submit text="Actualizar" />
    </form>
</div>
