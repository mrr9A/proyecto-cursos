<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$title ?? ""}}</title>
  <!-- ?? para poner un valor por default -->
  <!-- title es una variable que puede ser
recivida como atributo o encerrado en una etiqueta
slot con nombre
<x-slot name="title">Hola</x-slot>\
-->
<meta name="description" content="{{ $metaDescription ?? 'default meta description' }}" />
<!-- cargando css desde la carpeta public -->
<!-- <link href="/css/app.css" rel="stylesheet"/> -->
<!-- cargando css y js con vite, renderiza en tiempo real -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 text-white">
  <x-nav />
  @if(session('status'))
  <!-- verifica si existe un mensaje de sesion con la clave status -->
    <div class="status">
      {{session('status')}}
    </div>
  @endif
  <main class="mt-4">

    {{ $slot }}
  </main>
  <!-- slot es una variable definida que indica
donde se vacolocar el html dinamico -->

</body>
</html>