<form action="{{ route('tipos.store') }}" method="POST" class="space-y-6">
  @method('POST')
  @csrf
  <x-input-text text="Nombre" nombre="nombre" placeholder="nombre" required />
  <x-input-text text="Duracion" nombre="duracion" placeholder="duracion " />
  <x-input-submit text="crear" />
</form>
