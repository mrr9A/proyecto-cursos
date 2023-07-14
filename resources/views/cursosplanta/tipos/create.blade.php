<form action="{{ route('tipos.store') }}" method="POST" class="space-y-6">
  @method('POST')
  @csrf
  <x-input-text text="Tipo curso" nombre="nombre" placeholder="nombre" required />
  <x-input-submit text="crear" />
</form>
