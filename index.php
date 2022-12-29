<?php

require 'db.php';
require "model/user.php";

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {

    $uname = $_POST['username'];
    $upass = $_POST['password'];

    $korisnik = new User(1,$uname, $upass);

    $odg = User::logInUser($korisnik, $conn);

    if ($odg->num_rows == 1) {
        $red = $odg->fetch_array();
        $_SESSION['user_id'] = $red["id"];
        $_SESSION['username'] = $korisnik->username;
        header('Location: home.php');
        exit();
    } else {
        echo `<script>

        console.log("Niste se prijavili!");
        
        </script>`;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title> Logovanje </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="form">
        <div class="content">
            <div class="loginbox">
                <img src="img/avatar.jpg" class="avatar">
                <h1>Login</h1>
                <form action="#" method="post">
                    <p>Username</p>
                    <input type="text" name="username" placeholder="Enter username" required>
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Enter password" required>
                    <input type="submit" name="login" value="Login">
                </form>


            </div>
            
        </div>
    </div>

</body>

</html>