<canvas id="pie-chart" width="600" height="400"></canvas>
<script>
var datos = <?= json_encode($data,
    JSON_NUMERIC_CHECK | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
) ?>;
var mensajes = <?= json_encode($label,
    JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
) ?>;
var texto = <?= json_encode($text,
    JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
) ?>;
var popCanvas = document.getElementById("pie-chart");
var barChart = new Chart(popCanvas, {
  type: 'pie',
  data: {
      labels: mensajes,
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ['#e64a19',"#0d47a1","#43a047","#aa00ff","#0288d1","#6d4c41","#d84315","#6200ea"],
        data: datos
      }]
    },
    options: {
      title: {
        display: true,
        text: texto
      }
    }
});
</script>