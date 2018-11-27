<?php
include "../config/setup.php";

try{
	$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

	if (isset($_POST['register'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$hashed_password = md5($password);

		$insert = $conn->prepare("INSERT INTO users(username, email, password) values(:username, :email, :password)");

		$insert->bindParam(':username', $username);
		$insert->bindParam(':email', $email);
		$insert->bindParam(':password', $hashed_password);

		$insert->execute();

		header("location:verify.php?email=$email");
	}
}
catch(PDOException $e){
	echo "Error: ".$e->getMessage();
}
?>
<html>
	<head>
		<title>Register</title>
			<link rel="stylesheet" href="../css/register.css">
			<?php include "header.php";?>
			<body>
				<form method="post">
			<div class="registerbox">
				<h1>Register</h1>
				<div class="textbox">		
					<input type="text" name="username" placeholder="Username" required>
				</div>
				<div class="textbox">
					<input type="email" name="email" placeholder="example@example.com" required>
				</div>
				<div class="textbox">
					<input type="password" name="password" placeholder="Password" required>
			</div>
					<input class="button" type="submit" name="register" value="Register">
			</div>
			</form>
			</body>
</html>