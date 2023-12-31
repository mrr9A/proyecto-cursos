<!-- Modal toggle -->
<button data-modal-target="{{ $id }}" data-modal-toggle="{{ $id }}"
    class="{{ $class ?? '' ? $class : 'flex items-center gap-2 text-gray-50 bg-blue-800 border-b-2 border-2 rounded-md  focus:outline-none  font-medium text-sm px-2 py-2  hover:bg-blue-900 hover:text-gray-200 hover:rounded-t-md' }} boton_modal "
    type="button" id="boton_modal">
    @if ($icon ?? '')
        <i class='{{ $icon ?? '' ? $icon : 'bx bxs-plus-circle' }}'></i>
    @endif
    @if ($edit ?? '')
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="m14.06 9l.94.94L5.92 19H5v-.92L14.06 9m3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75Z" />
        </svg>
    @endif
    @if ($textButton ?? '')
        <span>{{ $textButton }}</span>
    @endif
</button>

<!-- Main modal -->
<div id="{{ $id }}" tabindex="-1" aria-hidden="true"
    class="bg-[rgba(0,0,0,.3)] fixed top-0 left-0 right-0 bottom-0 z-[100] hidden w-full p-4 overflow-x-hidden overflow-y-auto  h-[100vh]">
    <div class="relative w-full max-w-md max-h-vh m-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="{{ $id }}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
                @include($vistaContenidoModal, ['modalidad', 'tipo', 'sucursale', 'categoria'])
            </div>
        </div>
    </div>
</div>


