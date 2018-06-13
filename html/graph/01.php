<?php

$coin = '비트코인';
$list = 12;

$conn = mysqli_connect("localhost", "root", qazaq123);
mysqli_select_db($conn, "wordpress");
$result = mysqli_query($conn, "SELECT * FROM cc WHERE name='".$coin."'");
$start_rows = mysqli_num_rows($result)-12;
$result = mysqli_query($conn, "SELECT * FROM cc WHERE name='".$coin."' LIMIT ".$start_rows.", 12");

?>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
       var data = google.visualization.arrayToDataTable([
          ['Time', 'Price']

        <?php
                for($i=0; $i<12; $i++)
                {
                echo ',';
                $row = mysqli_fetch_assoc($result);
                $row['date'] = str_replace('2017-', '', $row['date']);
                $row['date'] = str_replace('2018-', '', $row['date']);
                $row['date'] = str_replace(':', ' : ', $row['date']);
                echo '[\''.$row['date'].'\', ';
                $row['price'] = str_replace(',', '', $row['price']);
                $row['price'] = str_replace(' 원', '', $row['price']);
                echo $row['price'].']';
                }
          ?>
        ]);
      var options = {
          title : '<?php echo $row['name']; ?>',
          vAxis: {title: 'Price'},
          hAxis: {title: 'Time'},
          seriesType: 'Time',
          series: {12: {type: 'line'}}
        };
      var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>

  </head>
  <body>
    <div id="chart_div" style="width:1340px; height: 800px;"></div>
  </body>
</html>
