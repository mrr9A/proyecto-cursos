<!DOCTYPE html>
<html>

<head>
    @foreach($calificacionesCursos as $calificacionesCurso)
    <title>CERTIFICADO DE TERMINO: {{$calificacionesCurso['usuario']}} {{$calificacionesCurso['segundoNombre']}} {{$calificacionesCurso['apellidoP']}} {{$calificacionesCurso['apellidoM']}}</title>
    @endforeach
    <style>
        body {
            background-color: #fff;
            /* background-color: #063554; */
            font-family: "Roboto", sans-serif;
        }

        /* The card */
        .card {
            position: center;
            height: 90px;
            width: 800px;
            /* margin: 200px auto; */
            background-color: #fff;
            -webkit-box-shadow: 10px 10px 93px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 10px 10px 93px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 10px 10px 93px 0px rgba(0, 0, 0, 0.75);
        }

        /* Image on the left side */
        /* .thumbnail {
            float: left;
            position: relative;
            left: 30px;
            top: -30px;
            height: 320px;
            width: 530px;
            -webkit-box-shadow: 10px 10px 60px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 10px 10px 60px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 10px 10px 60px 0px rgba(0, 0, 0, 0.75);
            overflow: hidden;
        } */

        /*object-fit: cover;*/
        /*object-position: center;*/
        img.left {
            position: absolute;
            left: 50%;
            top: 50%;
            height: auto;
            width: 100%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        h1 {
            /* padding-top: 30px; */
            font-size: 5rem;
            color: #063554;
            position: center;
            text-align: center;
        }

        h2 {
            font-size: 1.2rem;
            color: #063554;
            text-align: center;
        }

        h3 {
            font-size: 0.9rem;
            color: #063554;
            text-align: center;
        }

        p {
            text-align: center;
            position: relative;
            font-size: 0.95rem;
            color: #08446c;
            font-style: italic;
            font-weight: bold;
        }

        h5 {
            font-size: 1.9rem;
            color: #01080d;
            text-align: center;
            font-family: serif;
            font-weight: bold;
        }

        h6 {
            font-size: 0.95rem;
            color: #01080d;
        }

        .footer {
            text-align: center;
            margin-top: 120px;
        }

        .footer1 {
            text-align: center;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        span {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <h1>CERTIFICADO</h1>
    <h2>LA EMPRESA AUTOMOTRIZ BONN S.A DE C.V</h2>
    <h3>OTORGA A:</h3>
    @foreach($calificacionesCursos as $calificacionesCurso)
    <h5>{{$calificacionesCurso['usuario']}} {{$calificacionesCurso['segundoNombre']}} {{$calificacionesCurso['apellidoP']}} {{$calificacionesCurso['apellidoM']}}</h5>
    <p>Por haber concluido satiscatoriamente el "{{$calificacionesCurso['progreso']}}%" del curso:</p>
    <p> "{{$calificacionesCurso['curso']->nombre}}", y haber obtenido la calificación del: "{{$calificacionesCurso['calificacion']}}%".</p>
    <div class="footer clearfix" style=" width: 100%; overflow: auto; margin-bottom: -1cm;">
        <span class="float-left" style="float: left; width: 50%; box-sizing: border-box;">AUTOMOTRIZ BONN S.A DE C.V</span>
        <span class="float-left" style="float: left; width: 50%; box-sizing: border-box;">{{$calificacionesCurso['usuario']}} {{$calificacionesCurso['segundoNombre']}} {{$calificacionesCurso['apellidoP']}} {{$calificacionesCurso['apellidoM']}}</span>
    </div>
    <div class="footer1 clearfix" style=" width: 100%; overflow: auto; margin-top: -1cm;">
        <h6 class="float-left" style="float: left; width: 50%; box-sizing: border-box;">Nombre y Firma de la empresa</h6>
        <h6 class="float-left" style="float: left; width: 50%; box-sizing: border-box;">Nombre y Firma del Trabajador</h6>
    </div>
    <p>Fecha de emisión: {{$calificacionesCurso['fechaImpresion']}}</p>
    @endforeach
</body>


</html>