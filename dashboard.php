<?php
require "auth.php";
require "config.php";

$result = $conn->query("SELECT * FROM sensor_data ORDER BY id ASC LIMIT 6");
?>
<!DOCTYPE html>
<html>
<head>
    <title>IoT Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>IoT Device Monitoring Dashboard</h2>
    <p>
        <a href="simulate.php">Simulate New Data</a>
        <a href="logout.php">Logout</a>
    </p>

    <table>
        <tr>
            <th>ID</th>
            <th>Temperature</th>
            <th>Humidity</th>
            <th>Created At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
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
