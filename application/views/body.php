<!-- <body> template -->
<!-- Except for login and registration -->

<body style="margin:0px; background-image: url(<?php echo base_url('assets/images/groovepaper.png'); ?>);">
  <?php echo $menu ?>
  <?php echo $content ?>
  
  
    <script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-3.3.4-dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-dialog/js/bootstrap-dialog.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-date-range/js/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-date-range/js/daterangepicker.js'); ?>"></script>
    <script src="<?php echo base_url('assets/knob/jquery.knob.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-slider/js/plugin.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-slider/js/main.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/validator.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/controls.js'); ?>"></script>
    <script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/custom-knob.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-table/bootstrap-table.js'); ?>"></script>
    <script>
      $(function () {
      $('#timeline').highcharts({
          chart: {
              type: 'line'
          },
          title: {
              text: ''
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              type: 'datetime',
              dateTimeLabelFormats: { // don't display the dummy year
                  month: '%e. %b',
                  year: '%b'
              },
              title: {
                  text: 'Date'
              }
          },
          yAxis: {
              title: {
                  text: 'Experience'
              },
              min: 0
          },
          tooltip: {
              headerFormat: '<b>{series.name}</b><br>',
              pointFormat: '{point.x:%e. %b}: {point.y:.2f}',
              crosshairs: true
          },

          plotOptions: {
              spline: {
                  marker: {
                      enabled: true
                  }
              }
          },

          series: [{
              showInLegend: false,
              name: 'Activities',
              // Define the data points. All series have a dummy year
              // of 1970/71 in order to be compared on the same x axis. Note
              // that in JavaScript, months start at 0 for January, 1 for February etc.
              color: '#c33131',
              data: [
                  [Date.UTC(1970,  9, 27), 0],
                  [Date.UTC(1970, 10, 10), 4],
                  [Date.UTC(1970, 10, 18), 5],
                  [Date.UTC(1970, 11,  2), 12],
                  [Date.UTC(1970, 11,  9), 14],
                  [Date.UTC(1970, 11, 16), 15],
                  [Date.UTC(1970, 11, 28), 19],
                  [Date.UTC(1971,  0,  1), 28],
                  [Date.UTC(1971,  0,  8), 30],
                  [Date.UTC(1971,  0, 12), 33],
                  [Date.UTC(1971,  0, 27), 36],
                  [Date.UTC(1971,  1, 10), 39],
                  [Date.UTC(1971,  1, 18), 41],
                  [Date.UTC(1971,  1, 24), 42],
                  [Date.UTC(1971,  2,  4), 44],
                  [Date.UTC(1971,  2, 11), 45],
                  [Date.UTC(1971,  2, 15), 46],
                  [Date.UTC(1971,  2, 25), 49],
                  [Date.UTC(1971,  3,  2), 50],
                  [Date.UTC(1971,  3,  6), 58],
                  [Date.UTC(1971,  3, 13), 61 ],
                  [Date.UTC(1971,  4,  3), 66 ],
                  [Date.UTC(1971,  4, 26), 67 ],
                  [Date.UTC(1971,  5,  9), 68],
                  [Date.UTC(1971,  5, 12), 69]
              ]
          }]
      });
  });
    </script>
</body>