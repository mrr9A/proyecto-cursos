import { } from 'chart.js/helpers';
import Chart from "chart.js/auto";

(async () => {
  // Podemos tener varios conjuntos de datos. Comencemos con uno
  const { etiquetas, datos } = await getData();
  const ctx = document.getElementById("grafica").getContext('2d');

  const datosVentas2020 = {
    label: "numero de empleados",
    // Pasar los datos igualmente desde PHP
    data: datos, // <- Aquí estamos pasando el valor traído usando AJAX
    backgroundColor: [
      'rgba(163,221,203,0.2)',
      'rgba(232,233,161,0.2)',
      'rgba(230,181,102,0.2)',
      'rgba(229,112,126,0.2)',
    ],// Color de fondo
    borderColor: [
      'rgba(163,221,203,1)',
      'rgba(232,233,161,1)',
      'rgba(230,181,102,1)',
      'rgba(229,112,126,1)',
    ],// Color del borde
    borderWidth: 1, // Ancho del borde
    hoverOffset: 4
  };


  // Note: changes to the plugin code is not reflected to the chart, because the plugin is loaded at chart construction time and editor changes only trigger an chart.update().
  const plugin = {
    id: 'customCanvasBackgroundColor',
    beforeDraw: (chart, args, options) => {
      const { ctx } = chart;
      ctx.save();
      ctx.globalCompositeOperation = 'destination-over';
      ctx.fillStyle = options.color || '#99ffff';
      ctx.fillRect(0, 0, chart.width, chart.height);
      ctx.restore();
    }
  };


  const chart = new Chart(ctx, {
    type: 'pie', // Tipo de gráfica o pie
    data: {
      labels: etiquetas,
      datasets: [
        datosVentas2020,
        
        // Aquí más datos...
      ]
    },
    options: {
      plugins: {
        // customCanvasBackgroundColor: {
        //   // color: '#5500f8',
        // }
      },
      responsive: true
    },
    // plugins: [plugin]

  });



})();

async function getData() {
  // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
  const respuestaRaw = await fetch("http://localhost:8000/api/cursosplanta/trabajadores/datos");
  // Decodificar como JSON
  const respuesta = await respuestaRaw.json();
  // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
  // Obtener una referencia al elemento canvas del DOM
  const { etiquetas, datos } = respuesta; // <- Aquí estamos pasando el valor traído usando AJAX

  return { etiquetas, datos };
}