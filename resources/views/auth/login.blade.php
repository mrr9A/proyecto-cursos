<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIAR SESIÓN</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="min-w-screen h-full min-h-screen bg-gray-200  px-5 py-5 flex justify-center shadow-all">
        <div class=" text-gray-500 rounded-2xl shadow-xl w-full h-5/6 overflow-hidden flex items-center m-auto  "
            style="max-width:1000px">
            <div class="md:flex w-1/2">
                <img class="object-contain rounded-2xl"
                    src="./img/loginimage-min.png" />
            </div>
            <div class="h-full w-1/2 py-10 px-5  bg-gray-100 md:px-10">
                <div class="text-center mb-10">
                    <h1 class="font-bold text-3xl text-title text-gray-900">Iniciar Sesion</h1>
                    <h1 class="font-bold text-3xl text-section-subtitle text-gray-600">LMS BOON</h1><br>
                    <p>Porfavor Ingresa tus credenciales para iniciar sesión</p>
                </div>
                <x-messages.messages />
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-bold px-1">Correo Electronico:</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-email-outline text-gray-800 text-lg"></i>
                                    </div>
                                    <input type="email" id="email" name="email"
                                        class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 text-gray-900  border-gray-200 outline-none focus:border-indigo-500 placeholder:text-gray-600" 
                                        placeholder="johnsmith@example.com" autofocus autocomplete="email"
                                        value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-12">
                                <label for="" class="text-xs font-bold px-1">Contraseña:</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-lock-outline text-gray-800 text-lg"></i>
                                    </div>
                                    <input type="password"
                                        class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 text-gray-900  border-gray-200 outline-none focus:border-indigo-500 placeholder:text-gray-600" 
                                        placeholder="************" name="password" autocomplete="current-password">
                                </div>
                            </div>
                        </div>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <button type="submit"
                                    class="block w-full max-w-xs mx-auto bg-input hover:bg-input-buscador focus:bg-input-buscador text-white rounded-lg px-3 py-3 font-bold">Iniciar
                                    Sesión</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
