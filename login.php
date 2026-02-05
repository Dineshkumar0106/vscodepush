<?php
session_start();
require_once "db.php";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

if(isset($_POST['login'])){
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    // Empty check
    if(empty($uname)||empty($pass)){
        header("Location: login.php?error=emptyfields");
        exit();
    }
    $hashedpass=password_hash($pass,PASSWORD_DEFAULT);
    // echo $hashedpass;
    $check = "SELECT password FROM  user_details where username = ?";
    $stmt=$conn->prepare($check);
    $stmt->bind_param("s",$uname);
    $stmt->execute();
    $stmt->store_result();
    $rnum=$stmt->num_rows();

    if ($rnum === 0){
        echo $rnum;
        header("Location: login.php?error=invalid");
        exit();
    }
    // Fetch hashed password, validate password

    $stmt->bind_result($hashedpass);
    $stmt->fetch();

    // Verify pasword
    if(password_verify($pass,$hashedpass)){
        $_SESSION['uname'] = $uname;
        header("Location: dashboard.php");
        exit();
    }
    else{
        header("Location: login.php?error=invalid");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="login.jpg">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="card">
    <h2>Login</h2>
    <?php if(isset($_GET['error'])){
        if($_GET['error']=='emptyfields'){
            echo"<p style='color: #ff0000; font-weight: 1000; text-shadow: 0 0 5px rgba(0, 0, 0, 0.6); background-color: rgb(255, 181, 181); border-radius:10px; text-align:center'>❌ Username and password must not be empty</p>";

        }
        if($_GET['error']=='invalid'){
            echo"<p style='color: #ff0000; font-weight: 1000; text-shadow: 0 0 5px rgba(0, 0, 0, 0.6); background-color: rgb(255, 181, 181); border-radius:10px; text-align:center'>❌ Invalid username or password.</p>"; 
        }

    }
    ?>
    <form method="POST" >
        <table>
            <tr><td class="table tuser main_table">Username</td>
            <td class="main_table"><input type="text" name="uname" id="" class="input" placeholder="Enter your username" autocomplete="off"></td></tr>
            <tr><td class="table tpass main_table">Password</td>
            <td class="main_table"><input type="password" name="pass" id="" class="input" placeholder="Enter your password" autocomplete="off"></td></tr>
        </table>
        <button type="submit" name="login">Login</button>
        <button type="button" onclick="window.location.href='register.php'">New user</button>
    </form>
    </div>
</body>
</html>