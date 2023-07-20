<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumen por empleado</title>

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

    tbody {
        text-transform: uppercase;
        font-size: 12px;
    }

    th {
        text-align: left;
    }

    td {
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
    .check-pendiente {
        background-color: blue
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

    .pendiente {
        color: blue;
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
            @foreach ($datosUsuarios as $usuario)
            <h3>Resumen:</h3>
            <p>Total de cursos: {{count($usuario['cursos'])}}<span></span></p>
            </p>
            <p>Progreso total: <span>{{$usuario['progresoTotal']}}%</span></p>
            @endforeach
        </div>


        <div class="container-check">
            <h4 class="title-section">Cursos</h4>
            @foreach ($datosUsuarios as $usuario)
            <span>
                <span class="check"></span>
                <small>Reprobados: {{$usuario['reprobados']}}</small>
            </span>
            <span>
                <span class="check check-completado"></span>
                <small>Completados: {{$usuario['aprobado']}}</small>
            </span>
            <span>
                <span class="check check-progreso"></span>
                <small>En progreso: {{$usuario['encurso']}}</small>
            </span>
            <span>
                <span class="check check-pendiente"></span>
                <small>Pendiente por iniciar: {{$usuario['pendientes']}}</small>
            </span>
            @endforeach
        </div>

    </header><br>

    <main>
        @foreach ($datosUsuarios as $usuario)
        @if(count($usuario['cursos']) > 0)
        <table>
            <thead>
                <tr>
                    <th>NOMBRE DE LOS CURSOS</th>
                    <th>CALIFICACIÓN</th>
                    <th>progreso</th>
                    <th style="text-align: center;">estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuario['cursos'] as $curso)
                <tr style="border: 1px solid gray; padding: 3mm 0mm;" class="@if($curso['calificacion'] < 80 && $curso['progreso_curso'] == 100) reprovado @endif @if ($curso['calificacion'] >= 80) aprovado @else bg-blue-50 @endif @if ($curso['calificacion'] > 0 && $curso['calificacion'] < 80 && $curso['progreso_curso'] < 100) progreso @endif @if($curso['progreso_curso'] < 100 && $curso['calificacion'] == 0) pendiente @endif ">
                    <td>{{$curso['curso']}}</td>
                    <td>{{$curso['calificacion']}}</td>
                    <td>{{$curso['progreso_curso']}}%</td>
                    @if($curso['calificacion'] >= 80)
                    <td>
                        Aprobado
                    </td>
                    @elseif($curso['calificacion'] < 80 && $curso['progreso_curso'] == 100)
                    <td>
                        Reprobado
                    </td>
                    @elseif($curso['progreso_curso'] < 100 && $curso['calificacion'] == 0)
                    <td>
                        Pendiente por iniciar
                    </td>
                    @elseif($curso['calificacion'] < 80 && $curso['progreso_curso'] < 100)
                    <td>
                        Progreso
                    </td>
                    @endif
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