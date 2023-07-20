<form action="{{ route('tipos.store') }}" method="POST" class="space-y-6">
  @method('POST')
  @csrf
  <x-input-text text="Tipo curso" nombre="nombre" placeholder="nombre" required />
  <x-input-text type="number" text="Duración" nombre="duracion" placeholder="duración en meses" />
  <x-input-submit text="crear" />
</form>
