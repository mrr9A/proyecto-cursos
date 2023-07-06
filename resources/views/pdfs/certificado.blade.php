<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Certificado de Termino</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .content {
            margin-bottom: 30px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
        }

        .signature {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="">
            <h1 class="title">CERTIFICADO</h1>
        </div>

        <div class="content">
            <p>La empresa Automotriz Bonn S.A DE C.V certifica que:</p>
            @foreach($calificacionesCursos as $calificacionesCurso)
            <h3>{{$calificacionesCurso['usuario']}} {{$calificacionesCurso['segundoNombre']}} {{$calificacionesCurso['apellidoP']}} {{$calificacionesCurso['apellidoM']}}</</h3>
            <p>ha completado exitosamente el curso "{{$calificacionesCurso['curso']->nombre}}",obteniendo una calificación del "{{$calificacionesCurso['calificacion']}}%".</p>
            <p>Completando exitosamente el "{{$calificacionesCurso['progreso']}}%" del curso.</p>
        </div>
        @endforeach
        <div class="footer">
            <p>Firma de la empresa</p>
            <img class="signature">
            <p>Fecha de emisión: {{$calificacionesCurso['fechaImpresion']}}</p>
        </div>
    </div>
</body>

</html>