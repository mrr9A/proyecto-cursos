<form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST" class="space-y-6">
  @method('PUT')
  @csrf
  <x-input-text text="Categoria" nombre="nombre" placeholder="categoria" required  :value="$categoria->nombre"/>
  <x-input-submit text="actualizar" />
</form>
