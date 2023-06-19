<form action="{{ route('modalidad.store') }}" method="POST" class="space-y-6">
  @method('POST')
  @csrf
  <x-input-text text="Modalidad" nombre="modalidad" placeholder="modalidad" required />
  <x-input-submit text="crear" />
</form>
