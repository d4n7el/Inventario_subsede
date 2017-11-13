<canvas id="bar_double" width="400" height="400"></canvas>
<script>
  var datosA = <?= json_encode($dataA,
      JSON_NUMERIC_CHECK | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
  ) ?>;
  var datosB = <?= json_encode($dataB,
      JSON_NUMERIC_CHECK | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
  ) ?>;
  var mensajes = <?= json_encode($label,
      JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
  ) ?>;
  var texto = <?= json_encode($text,
      JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS
  ) ?>;
  var ctx = document.getElementById("bar_double").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: mensajes,
      datasets: [{
        label: 'Ingresos',
        data: datosA,
        backgroundColor: 'rgb(0,112,137)',
      }, {
        label: 'Salidas',
        data: datosB,
        backgroundColor: 'rgb(56,21,63)',
      }]
    }
  });
</script>