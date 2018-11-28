<?php
include "header.php";
?>

<html>
	<link rel="stylesheet" href="../css/profile.css">
	<body>
		<div class="profilebox">
			<h1> WELCOME :<?php echo $_GET['username']; ?><br/></h1>
			<a href="../media/gallery.php">Gallery</a><br/>
			<a href="../media/webcam.php">Webcam</a><br/>
			<a href="../media/image_upload.php">Image Upload</a><br/>
			<a href="../change/modify.php?username=<?PHP $a =$_GET['username']; echo $a; ?>&email=<?PHP $b =$_GET['email']; echo $b;?>&password=<?PHP $c =$_GET['password']; echo $c;?>">Profile Settings</a><br/>
			<a href="logout.php">Log Out</a><br/>
		</div>
	</body>
</html>