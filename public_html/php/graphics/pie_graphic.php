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
        backgroundColor: ['rgb(91,160,148)',"rgb(0,174,106)","rgb(186,189,68)","rgb(25,43,56)","rgb(56,119,105)","rgb(249,85,87)","rgb(228,182,61)","#d84315","#6200ea","rgb(141,84,58)", "rgb(255,74,33)", "rgb(129,167,53)"],
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