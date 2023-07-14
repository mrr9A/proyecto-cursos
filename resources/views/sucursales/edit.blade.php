{{-- <x-app title="Actualizar {{ $sucursale->nombre }}"> --}}
<div class="w-full ">
    <form action="{{ url('sucursales', [$sucursale]) }}" method="POST" class="formulario-actualizar  flex flex-col gap-5">
        @csrf
        @method('PUT')
        <input name="id_sucursal" value="{{$sucursale->id_sucursal}}" class="hidden" />
        <x-input-text nombre="nombre" text="Sucursal" :value="$sucursale->nombre" required classLabel="text-base"  required/>
        <x-input-text nombre="ciudad" text="Ciudad" :value="$sucursale->ciudad" required classLabel="text-base" required />
        <x-input-text nombre="codigo" text="Codigo" :value="$sucursale->codigo" required classLabel="text-base"  required/>

        <div class="form-group">
            <label for="" class="text-base font-semi-bold mt-3 inline-block">Estatus de la Sucursal</label>
            <div class="flex gap-5 items-center lowercase">
                <div class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="estado" value="1" class="inline-block pl-2 " id="estado-a"
                        {{ $sucursale->estado == '1' ? 'checked' : '' }} />
                    <label class="inline-block " for="estado-a">
                        Sucursal Activa
                    </label>
                </div>
                <div class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="estado" value="0" class="inline-block pl-2 " id="estado-i"
                        {{ $sucursale->estado == '0' ? 'checked' : '' }} />
                    <label class="inline-block " for="estado-i">
                        Sucursal inactiva
                    </label>
                </div>
            </div>
            @error('stestadoatus')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <x-input-submit text="Actualizar" />
    </form>
</div>
{{-- </x-app> --}}
