<div class="relative bg-white text-black rounded-md  px-2.5 pb-3.5">
    <p class="mt-2">{{ $curso->nombre }}</p>
    <span class="text-sm ">{{ $curso->codigo }}</span>

    <div class="flex gap-2 absolute bottom-0 right-2">
      <button id="{{$curso->id_curso}}" class="cursos text-blue-600 text-sm hover:text-blue-800 hover:font-bold">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
              <path fill="currentColor"
                  d="m14.06 9l.94.94L5.92 19H5v-.92L14.06 9m3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75Z" />
          </svg>
        </button>
        <form method="post" action="{{route('cursos.destroy', $curso->id_curso)}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-600 hover:text-red-900 hover:font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32"><path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z"/><path fill="currentColor" d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z"/></svg>
          </button>
        </form>
    </div>
</div>
