<canvas id="densityChart" width="400" height="400"></canvas>
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
  var densityCanvas = document.getElementById("densityChart");
  Chart.defaults.global.defaultFontFamily = "Lato";
  Chart.defaults.global.defaultFontSize = 18;

  var densityData = {
    label: texto,
    data: datos,
    backgroundColor: ['rgba(91,160,148,1)',"rgb(0,174,106)","rgba(186,189,68,1)","rgba(25,43,56,1)","rgba(56,119,105,1)","rgba(249,85,87,1)","rgba(228,182,61,1)","#d84315","#6200ea","rgb(141,84,58)", "rgb(255,74,33)", "rgb(129,167,53)"],
    borderColor: ['rgb(91,160,148)',"rgb(0,174,106)","rgb(186,189,68)","rgb(25,43,56)","rgb(56,119,105)","rgb(249,85,87)","rgb(228,182,61)","#d84315","#6200ea","rgb(141,84,58)", "rgb(255,74,33)", "rgb(129,167,53)"],
    borderWidth: 1,
    hoverBorderWidth: 0
  };

  var chartOptions = {
    scales: {
      yAxes: [{
        barPercentage: .5,
        maxBarThickness: .1
      }]
    },
    elements: {
      rectangle: {
        borderSkipped: 'right',
      }
    }
  };

  var barChart = new Chart(densityCanvas, {
    type: 'horizontalBar',
    data: {
      labels: mensajes,
      datasets: [densityData],
    },
    options: chartOptions
  });
</script>