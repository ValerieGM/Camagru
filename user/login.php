<?php
include "../config/setup.php";
include "header.php";
include "login.html";

if (isset($_POST['SignIn'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    try {
        $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
       
        $select = $conn->prepare("SELECT * FROM users WHERE username='$username' and password='$password'");
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute();

        $data = $select->fetch();
        
        
        if ($data['verify'] == 0){
            header("location:nologin.php");
        }
        else{
        $select = $conn->prepare("SELECT * FROM users WHERE username='$username' and password='$password'");
        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute();

        $data = $select->fetch();
        if ($data['username'] != $username && $data['password'] != $password)
            echo "Invalid Username or Password";
        else if ($data['username'] == $username && $data['password'] == $password) {
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['email'] = $data['email'];
            $email = $data['email'];
            header("location:profile.php?username=$username&email=$email&password=$password");
        }
    }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="../css/login.css">
		<body>
			<form method="post">  
            <div class="loginbox">
                <h1>Login</h1>
                <div class="textbox">
                    <input type="text" placeholder="Username"  name="username" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <input class="button" type="submit" name="SignIn">
                <a href="../change/forgot_password.php" style="padding-left: 30%; color: skyblue;">Forgot Password?</a>
            </div>
			</form>
        </body>
</html>