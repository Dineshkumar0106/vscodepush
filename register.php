<?php
require_once "db.php";
if(isset($_POST['register'])){
    $uname=$_POST['user'];
    $name=$_POST['name'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    // echo"$uname";

    // check whether the details is not empty

    if(empty($uname) || empty($name) || empty($pass) || empty($cpass)){
        header("Location: register.php?error=emptyfields"); // header creates a new line in html code  with the help of header message
        exit();
    }

    // Check whether the password and the confirm password where same or not
    if($pass==$cpass){
        // echo"Password matched";
        if(strlen($pass) < 8){ // Checks the password lenght is greater than 8 use strlen
            header("Location: register.php?error=weakpass");
            exit();
        }

        if(!preg_match("/[A-Z]/", $pass)){ // Check the password contain caps using preg_match
            header("Location: register.php?error=weakpass");
            exit();
        }

        if(!preg_match("/[a-z]/", $pass)){
            header("Location: register.php?error=weakpass");
            exit();
        }

        if(!preg_match("/[0-9]/", $pass)){
            header("Location: register.php?error=weakpass");
            exit();
        }

        if(!preg_match("/[@$!%*?&]/", $pass)){
            header("Location: register.php?error=weakpass");
            exit();
        }
        
        $hashedpass=password_hash($pass, PASSWORD_DEFAULT);
        // Check if username alreay exists

        $check= "SELECT username FROM user_details WHERE username = ?";
        $insert = "INSERT into user_details (name,username,password) values(?,?,?)";
        $stmt = $conn ->prepare($check);
        $stmt->bind_param("s",$uname);
        $stmt->execute();
        $stmt->bind_result($uname);
        $stmt->store_result();
        $rnum = $stmt->num_rows();



        if($rnum>0){ // Checks the username in the database 
            header("Location: register.php?error=userexists");
            exit();
        }
        if($rnum==0){
            $stmt->close();
            $stmt=$conn->prepare($insert);
            $stmt->bind_param("sss",$name,$uname,$hashedpass);
            $stmt->execute();
            // header("Location: register.php?success=")
        }

        header("Location: Weather app/weather.php?success=registered");
        exit();
    }
    else{
        header("Location: register.php?error=nomatch");
        exit();
        
    }
    
}

?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="icon" type="image/x-icon" href="register.jpg">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="card">
    <h2>Registration</h2>
    <?php if(isset($_GET['error']) && $_GET['error']=="nomatch"){ ?>
    <p  style='color: #ff0000; font-weight: 1000; text-shadow: 0 0 5px rgba(0, 0, 0, 0.6); background-color: rgb(255, 181, 181); border-radius:10px; text-align:center'>❌ Password does not match</p>
    <?php } ?>
    <?php if(isset($_GET['error']) && $_GET['error']=="userexists"){ ?>
    <p  style='color: #ff0000; font-weight: 1000; text-shadow: 0 0 5px rgba(0, 0, 0, 0.6); background-color: rgb(255, 181, 181); border-radius:10px; text-align:center'>❌ The username you enter is aldready exists, try new username.</p>
    <?php } ?>
    <?php if(isset($_GET['error']) && $_GET['error']=="emptyfields"){ ?>
    <p  style='color: #ff0000; font-weight: 1000; text-shadow: 0 0 5px rgba(0, 0, 0, 0.6); background-color: rgb(255, 181, 181); border-radius:10px; text-align:center'>❌ All the details are mandatory. Please fill all the details.</p>
    <?php } ?>
    <?php if(isset($_GET['error']) && $_GET['error']=="weakpass"){ ?>
    <p  style='color: #ff0000; font-weight: 1000; text-shadow: 0 0 5px rgba(0, 0, 0, 0.6); background-color: rgb(255, 181, 181); border-radius:10px; text-align:center'>❌ Password must be atleast 8 characters and include uppercase, lowercase, number, and special character.</p>
    <?php } ?>
    <?php if(isset($_GET['error']) && $_GET['error']=="dberror"){ ?>
    <p  style='color: #ff0000; font-weight: 1000; text-shadow: 0 0 5px rgba(0, 0, 0, 0.6); background-color: rgb(255, 181, 181); border-radius:10px; text-align:center'>❌ Database doesn't connect.</p>
    <?php } ?>
    <?php if(isset($_GET['success']) && $_GET['success']=="registered"){ ?>
    <p style="color:green;">✅ Registration Successful!</p>
    <?php } ?>
    <form method="POST" name="form1">
    <!-- <h2>hi</h2> -->
    <table>
        <tr>
            <td class="table tname main_table">Name</td>
            <td>
                <input type="text" name="name" autocomplete="off" id="" class="input" placeholder="Enter your name" >
            </td>
        </tr>
        <tr>
            <td class="table tuser main_table">Username</td>
            <td>
                <input type="text" name="user" autocomplete="off" id="" class="input" placeholder="Create user name" >
            </td>
        </tr>
        <tr>
            <td class="table tpass main_table">Create a password            </td>
            <td>
                <input type="password" name="password" autocomplete="off`" class="input" id="" placeholder="Create a password" pattern="(?=.*[a-z])(?=.&[A-Z](?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" title="Password must be at least 8 characters and include uppercase, lowercase, number, and special character">
            </td>
        </tr>
        <tr>
            <td class="table tpass main_table">Confirm a password            </td>
            <td>
                <input type="password" name="cpassword" autocomplete="off" class="input" id="" placeholder="Confirm a password" >
            </td>
        </tr>
    </table>
    
    <button type="submit" name="register">Register</button>
    <!-- <a href="index.html">Existing user</a> -->
    <!-- <form action="index.php" method="post">
        <button type="submit">Existing user</button>
    </form> -->
    <button type="button" onclick="window.location.href='login.php'">Existing user</button>

    </form>
</div>
</body>
</html>