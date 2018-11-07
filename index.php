<?php
include "config/setup.php";

session_start();

try{
        $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

        if (isset($_POST['register'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $insert = $conn->prepare("INSERT INTO users(username, email, password) values(:username, :email, :password)");

                $insert->bindParam(':username', $username);
                $insert->bindParam(':email', $email);
                $insert->bindParam(':password', $password);

                $insert->execute();
	}
	if (isset($_POST['signin'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$select = $conn->prepare("SELECT * FROM users WHERE email='$email' and password='$password'");
		$select->setFetchMode(PDO::FETCH_ASSOC);
		$select->execute();

		$data=$select->fetch();
		if ($data['email'] != $email and $data['password'] != $password)
			echo "Invalid Email or Password";
		else if ($data['email'] == $email and $data['password'] == $password)
		{
			$_SESSION['email']=$data['email'];
			$_SESSION['username']=$data['username'];
			header("location:profile.php");
		}

	}
}
catch(PDOException $e){
        echo "Error: ".$e->getMessage();
}
?>
<html>
        <head>
                <title>Register</title>
                        <link rel="stylesheet" href="css/register.css">
                        <body>
                                <form method="post">
                        <div class="registerbox">
                                <h1>Register</h1>
                                <div class="textbox">
                                        <input type="text" name="username" placeholder="Username">
				</div>
                                <div class="textbox">
                                        <input type="text" name="email" placeholder="example@example.com">
                                </div>
                                <div class="textbox">
                                        <input type="password" name="password" placeholder="Password">
                                </div>
                                        <input class="button" type="submit" name="register" value="Register">
                        </div>
                        </form>
                        </body>
</html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
                <link rel="stylesheet" href="css/login.css">
                <body>
            <div class="loginbox">
                <h1>Login</h1>
                <div class="textbox">
                    <input type="text" placeholder="Username"  name="" value="">
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" name="" value="">
                </div>
                <input class="button" type="button" name="signin" value="Sign In">
            </div>
        </body>
</html>

