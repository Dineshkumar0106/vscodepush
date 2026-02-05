<?php
session_start();

if (!isset($_SESSION['uname'])) {
    header("Location: /Trail/login.php");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="calculator.css">
    <link rel="icon" type="image/x-icon" href="calc_icon.jpg">
    <script>
        if (!document.cookie.includes("PHPSESSID")) {
        window.location.replace("/Trail/login.php");
        }
    </script>

</head>
<body>
    <h2 class="head">Calculator</h2>
    <div class="logout"><a href="/Trail/logout.php" class="log">Logout</a></div>
    <div class="weather"><a href="/Trail/Weather app/weather.php" class="weather_link">Weather</a></div>
    <div class="dash"><a href="/Trail/dashboard.php" class="dash_link">Dashboard</a></div>
    <div class="calculator">
        <div class="display" id="display">0</div>
        <div class="keypad">
            <button class="clear" onclick="clearDisplay()">C</button>
            <button class="operator" onclick="backspace()">←</button>
            
            <button class="operator" onclick="inputOperator('*')">×</button>
            
            <button class="number" onclick="inputNumber('7')">7</button>
            <button class="number" onclick="inputNumber('8')">8</button>
            <button class="number" onclick="inputNumber('9')">9</button>
            <button class="operator" onclick="inputOperator('-')">-</button>
            
            <button class="number" onclick="inputNumber('4')">4</button>
            <button class="number" onclick="inputNumber('5')">5</button>
            <button class="number" onclick="inputNumber('6')">6</button>
            <button class="operator" onclick="inputOperator('+')">+</button>
            
            <button class="number" onclick="inputNumber('1')">1</button>
            <button class="number" onclick="inputNumber('2')">2</button>
            <button class="number" onclick="inputNumber('3')">3</button>
            <button class="operator" onclick="inputOperator('/')">÷</button>
            
            
            <button class="number" onclick="inputNumber('0')" >0</button>
            <button class="operator" onclick="inputOperator('.')">.</button>
            <button class="equals" onclick="calculate()">=</button>
        </div>
    </div>
    <script src="calculator.js"></script>
</body>
</html>