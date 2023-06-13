<!DOCTYPE html>
<html>

<head>
    <title>Gráfica con Plotly</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  </head>
  
  <body>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <div id="chart"></div>
    <script>
        var data = [{
            values: [35, 20, 15, 10, 20],
            labels: ['Etiqueta 1', 'Etiqueta 2', 'Etiqueta 3', 'Etiqueta 4', 'Etiqueta 5'],
            type: 'pie'
        }, {
            values: [20, 20, 5, 45, 10],
            labels: ['Etiqueta 1', 'Etiqueta 2', 'Etiqueta 3', 'Etiqueta 4', 'Etiqueta 5'],
            type: 'pie'
        }];

        var layout = {
            height: 400, // Cambia el valor aquí para ajustar el tamaño de la gráfica
            width: 600, // Cambia el valor aquí para ajustar el tamaño de la gráfica
            showlegend: true, // Mostrar leyenda
            legend: {
                x: 0,
                y: 1
            }, // Posición de la leyenda (0: izquierda, 1: arriba)
            annotations: [{
                font: {
                    size: 12
                },
                showarrow: false,
                text: 'trabajadores', // Título de las etiquetas
                x: 0.5, // Posición horizontal de las etiquetas
                y: 0.5 // Posición vertical de las etiquetas
            }],
            pie: {
                textposition: 'outside', // Ubicación de las etiquetas dentro del pastel (inside: dentro, outside: fuera)
                textinfo: 'label+percent' // Información a mostrar en las etiquetas (label: etiqueta, percent: porcentaje)
            },

            animate: true, // Habilitar animaciones
            animation: {
                duration: 3000, // Duración de la animación en milisegundos
                easing: 'easeOutQuad' // Función de interpolación para la animación
            }
        };

        Plotly.newPlot('chart', data, layout);
    </script>
</body>

</html>
