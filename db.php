<?php

$servername="localhost";
$username="root";
$password="";
$bdname="register";
$conn = new mysqli($servername,$username,$password,$bdname);
if(!$conn){
            // header("Location: register.php?error=dberror");
            // exit();
    die("Database connection failed: " . mysqli_connect_error());
}

?>