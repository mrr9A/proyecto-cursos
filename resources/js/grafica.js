import { } from 'chart.js/helpers';
import Chart from "chart.js/auto";

var ctx = document.getElementById("myChart");

ctx.fillStyle = '#990000';
ctx.width = 500;
ctx.height = 300;

(async () => {
  const {
    etiquetas,
    datos
  } = await getData();


  const datosVentas2020 = {
    label: "numero de empleados",
    data: datos, // <- Aquí estamos pasando el valor traído usando AJAX
    backgroundColor: ['#3B009A', '#36A2EB', '#560BAD', '#4BC0C0'],
    borderWidth: 1, // Ancho del borde
    hoverOffset: 4
  };

  const tooltipsPlugin = {
    id: 'customTooltips',
    afterLabel: function (tooltipItem, data) {
      console.log(data)
      const dataIndex = tooltipItem.dataIndex;
      const empleados = datos[dataIndex];
      return 'Empleados: ' + empleados;
    }
  };

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: etiquetas,
      datasets: [datosVentas2020]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          title: {
            text: 'Puestos',
            display: true,
            position: 'start',
            font: {
              family: 'Arial, sans-serif',
              size: 16,
              weight: 'bold'
            },
            color: '#333333'
          },
          position: 'left',
          labels: {
            // generateLabels: function (chart) {
            //   const originalGenerateLabels = Chart.defaults.plugins.legend.labels.generateLabels;
            //   const labels = originalGenerateLabels.call(this, chart);

            //   // labels.forEach(function (label) {
            //   //   label.text = 'Puesto: ' + label.text;
            //   // });

            //   return labels;
            // }
          }
        },
        title: {
          display: true,
          text: 'Total de empleados por cada puesto',
          font: {
            family: 'Arial, sans-serif',
            size: 16,
            weight: 'bold'
          },
          color: '#333333'
        },
        datalabels: {
          color: '#ffffff', // Color del texto de los labels
          font: {
            size: 18,
            weight: 'bold', // Estilo del texto de los labels (negrita)
            family: 'Arial, sans-serif'
          },
        },
        layout: {
          padding: {
            left: 0, // Espacio a la izquierda
            right: 0, // Espacio a la derecha
            top: 0, // Espacio en la parte superior
            bottom: 0 // Espacio en la parte inferior
          }
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              // var label = context.label || '';
              // if (label) {
              //   label += ':';
              // }
              var label = "empleados: "
              label += context.raw.toLocaleString(); // Agrega el número de empleados
              return label;
            }
          }
        },
        // customTooltips: tooltipsPlugin
      }
    }
  });
})()


async function getData() {
  // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
  const respuestaRaw = await fetch("http://localhost:8000/api/cursosplanta/trabajadores/datos");
  // Decodificar como JSON
  const respuesta = await respuestaRaw.json();
  // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
  // Obtener una referencia al elemento canvas del DOM
  const {
    etiquetas,
    datos
  } = respuesta; // <- Aquí estamos pasando el valor traído usando AJAX

  return {
    etiquetas,
    datos
  };
}