{{-- <x-app title="Actualizar {{ $sucursale->nombre }}"> --}}
    <div class="w-[80%]">
        <form action="{{ url('sucursales', [$sucursale]) }}" method="POST" class="formulario-actualizar">
            @csrf
            @method('PUT')
            <x-input-text nombre="nombre" text="Sucursal" :value="$sucursale->nombre" required />
            <x-input-text nombre="ciudad" text="Ciudad" :value="$sucursale->ciudad" required />

            <div class="form-group">
                <label for="description">Estatus de la Sucursal</label><br />
                <label class="radio-inline"><input type="radio" name="estado" value="1"
                        {{ $sucursale->estado == '1' ? 'checked' : '' }}>Sucursal Activa</label>
                <label class="radio-inline"><input type="radio" name="estado" value="0"
                        {{ $sucursale->estado == '0' ? 'checked' : '' }}>Sucursal Inactiva</label>
                @error('stestadoatus')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <x-input-submit text="Actualizar" />
        </form>
    </div>
{{-- </x-app> --}}