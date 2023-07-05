{{-- <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
  <span class="font-medium">Info alert!</span> Change a few things up and try submitting again.
</div> --}}

@if (session('success'))
    <!-- verifica si existe un mensaje de sesion con la clave status -->
    <div class="status">
      <div class="p-4 mb-4 -mt-4 text-base text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ session('success') }}</span> 
        </div>
    </div>
@endif
@if (session('error'))
    <!-- verifica si existe un mensaje de sesion con la clave status -->
    <div class="status">
      <div class="p-4 mb-4 -mt-4 text-base text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">{{ session('error') }}</span> 
        </div>
    </div>
@endif


{{-- <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
  <span class="font-medium">Warning alert!</span> Change a few things up and try submitting again.
</div>

<div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
  <span class="font-medium">Dark alert!</span> Change a few things up and try submitting again.
</div> --}}
