<?php
require "auth.php";
require "config.php";

// fetch latest 10 sensor values
$result = $conn->query("SELECT * FROM (SELECT * FROM sensor_data ORDER BY id DESC LIMIT 10) AS sub ORDER BY id ASC");

// prepare data for chart
$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = [$row['created_at'], $row['temperature'], $row['humidity']];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>IoT Dashboard</title>
    <link rel="stylesheet" href="style.css">

    <!-- Load Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Time', 'Temperature (°C)', 'Humidity (%)'],
                <?php
                foreach ($data as $d) {
                    echo "['".$d[0]."', ".$d[1].", ".$d[2]."],";
                }
                ?>
            ]);

            var options = {
                title: 'IoT Sensor Data',
                curveType: 'function',
                legend: { position: 'bottom' },
                height: 400,
                width: '100%'
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div class="container">
    <h2>IoT Device Monitoring Dashboard</h2>
    <p>
        <a href="simulate.php">Simulate New Data</a>
        <a href="logout.php">Logout</a>
    </p>

    <!-- Graph Section -->
    <div id="chart_div"></div>

    <!-- Table Section -->
    <table>
        <tr>
            <th>ID</th>
            <th>Temperature</th>
            <th>Humidity</th>
            <th>Created At</th>
        </tr>
        <?php
        // re-run query for table
        $result = $conn->query("SELECT * FROM (SELECT * FROM sensor_data ORDER BY id DESC LIMIT 10) AS sub ORDER BY id ASC");
        while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['temperature'] ?> °C</td>
            <td><?= $row['humidity'] ?> %</td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
