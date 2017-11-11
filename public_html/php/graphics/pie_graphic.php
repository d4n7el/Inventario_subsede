<canvas id="pie-chart" width="600" height="600"></canvas>
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
  type: 'bar',
  data: {
      labels: mensajes,
      datasets: [{
        label: texto,
        backgroundColor: ['rgba(91,160,148,1)',"rgb(0,174,106)","rgba(186,189,68,1)","rgba(25,43,56,1)","rgba(56,20,20,1)","rgba(249,85,87,1)","rgba(228,182,61,1)","#d84315","#6200ea","rgb(141,84,58)", "rgb(255,74,33)", "rgb(129,167,53)"],
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