<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data->nombre}}</title>

    @vite(['resources/js/app.js'])
</head>
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap'); */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        margin: 20mm 20mm;
    }

    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 1em;
        font-family: sans-serif;
        min-width: 450px;
        border-radius: 8px;
    }

    .styled-table thead tr {
        /* background-color: #5064ff; */
        /* color: #ffffff; */
        text-align: middle;
        text-transform: uppercase
    }

    .styled-table tbody tr td {
        text-transform: capitalize;
        /* padding: 5px 10px; */
        position: relative;
        padding-top: 0px;
        height: 50px;
    }

    .styled-table tbody tr td ul {
        /* list-style-type: none; */
        /* position: absolute;
        top: 0px; */
        text-transform: uppercase;
        font-size: 12px;
        margin-top: 5px;
        padding: 0px 20px 0px 15px;
    }

    .styled-table tbody tr td ul li {
        /* list-style-type: none; */
        padding: 5px 0px;
    }

    .container{
        margin: 20px 0px;
    }

    .reprovado {
        color: red;
    }

    .aprovado {
        color: green;
    }

    .title-section {
        margin: 5px 0px;
        font-weight: bold;
        text-transform: capitalize;

    }

    .check {
        display: inline-block;
        width: 10px;
        height: 10px;
        background-color: red;
    }

    .check-completado {
        background-color: green
    }
    .container-check > span{
        margin-right: 10px;
    }
    .title{
        text-transform: capitalize;
    }
    .container-resumen{
        margin: 10px 0;
    }
    .container-resumen >span{
        margin-right: 15px;
    }
    .subtitle{
        text-transform: capitalize;
        font-style: italic;
        font-weight: 400;
    }
</style>

<body>
    <h1 class="title">{{ $data->nombre }}</h1>
    <h2 class="subtitle">{{ $data->puesto }}</h2>
    <main class="container">

        <div class="container-resumen">
            <h3>Resumen</h3>
            <span>Total de cursos: <span>{{$data->totalCursos}}</span></span>
            <span>Cursos pasados: <span>{{$data->cursosPasados}}</span></span>
            <span>Progreso: <span>{{$data->progreso}} %</span></span>
        </div>



        <div>
            <h3 class="title-section">Cursos</h3>

            <div class="container-check">
                <span>
                    <span class="check"></span>
                    <small>Sin completar</small>
                </span>
                <span>
                    <span class="check check-completado"></span>
                    <small>Completado</small>
                </span>

            </div>
            <div>
                @foreach ($data->trabajos as $trabajo)
                    <?php
                    $keys = array_keys($trabajo['cursos']->toArray());
                    ?>
                    <table class="styled-table">
                        <caption style="text-align: left;">Trabajo: {{$trabajo['trabajo']}}</caption>
                        <thead>
                            <tr>
                                @foreach ($trabajo['cursos'] as $cursos)
                                    <td>{{ $cursos[0]->tipo }}</td>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($keys as $key)
                                    <td>
                                        <ul>
                                            @foreach ($trabajo['cursos'][$key] as $cursos)
                                                <li
                                                    class="@if ($cursos->calificacion == 'aprovado') aprovado @else reprovado @endif">
                                                    {{ $cursos->curso }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </main>
</body>

</html>
