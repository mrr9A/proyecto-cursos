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


    @page {
        margin: 0cm 0cm;
        font-family: Arial;
    }

    body {
        margin: 10mm 10mm;
        padding-top: 4cm;

    }

    h4 {
        text-transform: uppercase;
        font-weight: 400;
    }

    thead {
        text-transform: uppercase;
        text-align: left;
        font-weight: 400;
        font-family: 'poppins';
        background-color: rgb(17, 17, 17);
        color: white;
    }

    th {
        text-align: left;
    }

    tr {
        padding: 2mm;

    }

    tr>td:last-child() {
        text-align: center;
    }

    .header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 4cm;
        line-height: 30px;
        overflow: hidden;
        padding: 5mm 10mm 0mm 10mm;
    }

    .container {
        margin-top: 3.5cm;
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
        background-color: orange
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


    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>

<body>
    <header class="header">
        <div style="float: right;">
            <h3>Resumen</h3>
            <p>Total de cursos: <span>{{ $data->totalCursos }}</span></p>
            <p>Cursos pasados: <span>{{ $data->cursosPasados }}</p>
            </p>
            <p>Progreso: <span>{{ $data->progreso }} %</span></p>
        </div>

        <div>
            <h1>{{ $data->nombre }}</h1>
            <h2>{{ $data->puesto }}</h2>
        </div>

        <div class="container-check">
            <h4 class="title-section">Cursos</h4>
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

    <main>
        @foreach ($data->trabajos as $trabajo)
            <h3 style="margin:0mm 0mm 2mm 0mm;">Trabajo: {{ $trabajo['trabajo'] }}</h3>
            <?php
            // iniciales, especialidad,..etc
            $keys = array_keys($trabajo['cursos']->toArray());
            
            $nuevoArreglo = [];
            
            foreach ($keys as $key) {
                foreach ($trabajo['cursos'][$key] as $cursos) {
                    array_push($nuevoArreglo, $cursos);
                }
            }
            ?>
            @if (count($trabajo['cursos']) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Cursos</th>
                            <th>tipo</th>
                            <th>progreso</th>
                            <th>estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nuevoArreglo as $curso)
                            <tr style="border: 1px solid gray; padding: 3mm 0mm;" class="@if($curso->estado === 0) reprovado @endif @if ($curso->calificacion == '100' && $curso->estado == 1) aprovado @else bg-blue-50 @endif @if ($curso->calificacion > '0' && $curso->calificacion < '100' && $curso->estado == 2) progreso @else bg-blue-50 @endif ">
                                <td>{{ $curso->curso }}</td>
                                <td>{{ $curso->tipo }}</td>
                                <td>{{ $curso->calificacion ?? 0 }}</td>
                                <td>
                                    @if($curso->estado == 0) Reprovado @endif
                                    @if($curso->estado == 1) Aprovado @endif
                                    @if($curso->estado == 2) En progreso @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                Sin cursos...
            @endif
        @endforeach
    </main>
</body>

</html>

{{-- @foreach ($data->trabajos as $trabajo)
            <?php
            // iniciales, especialidad,..etc
            $keys = array_keys($trabajo['cursos']->toArray());
            ?>
            <div class="trabajo">
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
        @endforeach --}}
