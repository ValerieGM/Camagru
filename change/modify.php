<?php
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form method="post">
			<div class="registerbox">
				<h1>Update</h1>
				<link rel="stylesheet" href="../css/images/modify.css">
				<a href="change_username.php?username=<?PHP $a =$_GET['username']; echo $a;?>">Change Username</a><br/>
				<a href="change_email.php?email=<?PHP $b =$_GET['email']; echo $b;?>">Change Email</a><br/>
				<a href="notification.php?email=<?PHP $b =$_GET['email']; echo $b;?>">Notification Preference</a><br/>
				<a href="password_email.php?email=<?PHP $b =$_GET['email']; echo $b;?>&password=<?PHP $b =$_GET['password']; echo $b;?>">Change Password</a><br/>
				<a href="../user/logout.php">Log Out</a><br/>
			</div>
</form>
</body>
</html>