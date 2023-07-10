<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->nombre }}</title>

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
        margin: 10mm 20mm;
    }

    h4 {
        text-transform: uppercase;
        font-weight: 400;
    }

    th,
    td {
        text-align: left;
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

    .check-progreso {
        background-color: purple
    }

    .container-check>span {
        margin-right: 10px;
    }

    .title {
        text-transform: capitalize;
        margin: 0;
    }

    .container-resumen {
        margin: 0 0 10px 0;
    }

    .container-resumen>span {
        margin-right: 15px;
    }

    .subtitle {
        font-style: italic;
        font-weight: 600;
        font-size: 20px;
    }


    /*  =====================================================*/

    .trabajo {
        margin-bottom: 20px;
        margin-top: 10px;
    }

    .trabajo h3 {
        font-weight: 400;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .contenedor-cursos {
        /* border: 1px solid gray; */
        overflow: auto;
    }

    .cursos-tipo {
        width: 100%;
        overflow: auto;
        background-color: blue;
        color: white;
    }

    .cursos-tipo-item {
        float: left;
        /* Ajusta el ancho según el número de elementos */
        box-sizing: border-box;
        margin-top: 5px;
        /* padding: px; */
    }

    .cursos {
        width: 100%;
        overflow: auto;
        background-color: #f1f1f1;
    }

    .cursos-columna {
        float: left;
        margin-top: 5px;
        /* padding: 5px; */
        box-sizing: border-box;
    }

    .calificacion {
        margin: 0px 2px;
        margin-bottom: 8px;
    }

    .aprovado {
        color: green;
    }

    .progreso {
        color: orange;
    }

    .reprovado {
        color: red;
    }
</style>

<body>
    <header class="header clearfix">
        <table style="width: 100%;">
            <tr>
                <th class="title">{{ $data->nombre }}</th>
                <th class="title">Resumen</th>
            </tr>
            <tr>
                <td>{{ $data->puesto }}</td>
                <td>
                    <p>Total de cursos: <span>{{ $data->totalCursos }}</span></p>
                    <p>Cursos pasados: <span>{{ $data->cursosPasados }}</p></p>
                    <p>Progreso: <span>{{ $data->progreso }} %</span></p>
                </td>
            </tr>
        </table>


        <div class="container-check">
            <h3 class="title-section">Cursos</h3>
            <span>
                <span class="check"></span>
                <small>Sin completar</small>
            </span>
            <span>
                <span class="check check-completado"></span>
                <small>Completado</small>
            </span>
            <span>
                <span class="check check-progreso"></span>
                <small>En progreso</small>
            </span>

        </div>
    </header>




    <main class="container">
        <div>
            @foreach ($data->trabajos as $trabajo)
                <?php
                // iniciales, especialidad,..etc
                $keys = array_keys($trabajo['cursos']->toArray());
                ?>
                <div class="trabajo" style="page-break-after: always">
                    <h3>Trabajo: {{ $trabajo['trabajo'] }}</h3>
                    <div class="contenedor-cursos">
                        <div class="cursos-tipo clearfix">
                            @foreach ($trabajo['cursos'] as $cursos)
                                <h4 class="cursos-tipo-item" style="width: {{ 100 / count($keys) }}%">
                                    {{ $cursos[0]->tipo }}</h4>
                            @endforeach
                        </div>

                        <div class="cursos clearfix">
                            @foreach ($keys as $key)
                                <div class="cursos-columna" style="width: {{ 100 / count($keys) }}%">
                                    @foreach ($trabajo['cursos'][$key] as $cursos)
                                        <div>

                                            <p
                                                class="calificacion @if ($cursos->calificacion == '100') aprovado @endif @if ($cursos->calificacion > '0' && $cursos->calificacion < '100') progreso @endif @if ($cursos->calificacion <= '0') reprovado @endif">
                                                <span
                                                    style="display: inline-block; width: 8px; height: 8px; background-color: green; border-radius: 50%; margin-right:2px ;"></span>{{ $cursos->curso }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        </div>
    </main>
</body>

</html>
