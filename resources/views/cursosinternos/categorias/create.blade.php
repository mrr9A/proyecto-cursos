<form action="{{ route('categorias.store') }}" method="POST" class="space-y-6">
  @method('POST')
  @csrf
  <x-input-text text="Nombre" nombre="nombre" placeholder="nombre" required />
  <x-input-submit text="crear" />
</form>
