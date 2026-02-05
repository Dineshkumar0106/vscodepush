<?php
session_start();

if (!isset($_SESSION['uname'])) {
    header("Location: /Trail/login.php");
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
    <title>Weather app</title>
    <link rel="stylesheet" href="weather.css">
    <link rel="stylesheet" href="map.css">
    <!-- <link rel="icon" type="image/x-icon" href="weather.jpg"> -->
    <link rel="shortcut icon" href="image/weather.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
    
    <h2 class="head">Weather app</h2>
    <div class="logout"><a href="/Trail/logout.php" class="log">Logout</a></div>
    <div class="dash"><a href="/Trail/dashboard.php" class="dash_link">Dashboard</a></div>
    <div class="calc"><a href="/Trail/Calculator/calculator.php" class="calc_link">Calculator</a></div>
        <div class="search">
            <input type="text" name="" class="city_name" placeholder="Enter your city name" spellcheck="false">
            <button type="submit" class="search_button" >Search</button>
        </div>
        <div class="card">
        
        <div class="weather">
            <p class="pd">Date</p><br><p class="pdate"></p>
            <p class="pt">Time</p><br><p class="ptime"></p>
            <img src="image/clear.png" class="weather_icon">
            <div class="temp">0 c</div>
            <div class="city">abc</div>
            <div class="details">
                <div class="col">
                    <img src="image/humidity.png" alt="" class="humidity-icon icon">
                    <div class="humidity-div">
                        <p class="humidity">0%</p>
                        <p class="">Humidity</p>
                    </div>
                </div>  
                <div class="col">
                    <img src="image/wind.png" alt="" class="wind-icon icon">
                    <div class="wind-div">
                        <p class="wind">50km/hr</p>
                        <p class="">Wind</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map-card">
        <iframe src="" class="map" frameborder="0" loading="lazy"></iframe>
    </div>
    <div class="error"><p>Invalid city name</p></div>
    <script src="weather.js"></script>
    <script src="map.js"></script>
</body>
</html>