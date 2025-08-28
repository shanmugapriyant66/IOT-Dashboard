<?php
require "auth.php";
require "config.php";

// generate random IoT data
$temp = rand(20, 35);
$hum  = rand(40, 80);

$conn->query("INSERT INTO sensor_data (temperature, humidity) VALUES ($temp, $hum)");

header("Location: dashboard.php");
exit;
?>
