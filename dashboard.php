<?php
session_start();

if (!isset($_SESSION['uname'])) {
    header("Location: ../login.php");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="shortcut icon" href="image/dashboard.png" type="image/x-icon">
</head>
<body>
    <h2 class="head">Dashboard</h2>
    <div class="logout"><a href="/Trail/logout.php" class="log">Logout</a></div>
    <div class="logout"></div>
    <!-- <ul>
        <li><a href="/Trail/Weather app/weather.html">Weather App</a></li>
        <li><a href="/Trail/Calculator/calculator.html">Calculator</a></li>
    </ul> -->
    <div class="section">
        <a href="/Trail/Weather app/weather.php" class="weather-url"><div class="weather">Weather App</div></a>
        <a href="/Trail/Calculator/calculator.php" class="calc-url"><div class="calculator">Calculator</div></a>
    </div>
</body>
</html>
