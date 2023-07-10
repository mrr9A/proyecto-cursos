<form action="{{ route('modalidad.update', $modalidad->id_modalidad) }}" method="POST" class="space-y-6">
  @method('PUT')
  @csrf
  <x-input-text text="Modalidad" nombre="modalidad" placeholder="modalidad" required  :value="$modalidad->modalidad"/>
  <x-input-submit text="actualizar" />
</form>
