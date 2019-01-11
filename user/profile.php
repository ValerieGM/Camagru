<?php
include "header.php";
include "../config/setup.php";

$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

$query="SELECT * FROM users where username ='".$_SESSION['username'] ."' LIMIT 1";

$select = $conn->prepare($query);
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

$data = $select->fetch();

?>

<html>
	<head>
		<meta charset="UTF-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	</head>
	<link rel="stylesheet" href="../css/profile.css">
	<body>
		<div class="profilebox">
			<h1> WELCOME :<?php echo $_GET['username']; ?><br/></h1>
			<a href="../media/gallery.php?username=<?PHP echo $data['users_id'] ?>">Gallery</a><br/>
			<a href="../media/webcam.php">Media</a><br/>
			<a href="../change/modify.php?username=<?PHP $a = $_GET['username'];
																																									echo $a; ?>&email=<?PHP $b = $_GET['email'];
																																																																																								echo $b; ?>&password=<?PHP $c = $_GET['password'];
																																																																																																																																						echo $c; ?>">Profile Settings</a><br/>
			<a href="logout.php">Log Out</a><br/>
		</div>
	</body>
</html>