<?php
include 'header.php';
include "../config/setup.php";

session_start();
$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

if(isset($_POST['btn-add'])){

	$users_name = $_SESSION['username'];
	$images = $_FILES['profile']['name'];
	$tmp_dir = $_FILES['profile']['tmp_name'];
	$imageSize = $_FILES['profile']['size'];

	$upload_dir = 'uploads/';
	$imgExt = strtolower(pathinfo($images,PATHINFO_EXTENSION));
	$valid_extensions = array('jpej, jpg, png, gif, pdf,');
	$picProfile = rand(1000, 1000000).".".$imgExt;

	$insert = $conn->prepare("INSERT INTO pictures (pictures, users_name) VALUE (:pictures, :users_name)");
	$insert->bindParam(':pictures', $picProfile);
	$insert->bindParam(':users_name', $users_name);
	$insert->execute();

	if (move_uploaded_file($tmp_dir, $upload_dir.$picProfile)) {
		header("location: msg1.php");
	}else{
		header("location; msg.php");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Media</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/images/webcam.css">
</head>
<body>
<br/>
		<strong>Webcam Upload</strong>
		<hr/>
		<form method="post" enctype="multipart/form-data">
			<input type="file" name="profile" id="try_this" class="form-control" onchange="showImage.call(this)" accept=*/image>
			<button type="submit" name="btn-add">upload</button>
		</form>
<script>
function showImage()
{
	if (this.files && this.files[0])
	{
		var obj = new FileReader();
		obj.onload = function(data){
			var image = document.getElementById("image");
			image.src = data.target.result;
			image.style.display = "block";
		}
		obj.readAsDataURL(this.files[0]);
	}
}
</script>
			<br/>
			<br/>
	<!--------------------the webcam------------------------------------->
		<div class="video-container">
			<video id="video" style="width:100%">Stream not available!</video>
		</div>
		<br/>
		<div class="controllers" id="upload_2">
			<button id="photo-button" class="btn btn-dark">Take a pic</button>
			<button type="submit" class="btn btn-dark" id="save">Save</button>
		</div>
		<canvas id="canvas" style="display: none"></canvas>
	</div>
	<!-----------------middle container--------------------->
		<strong>Captured Picture</strong>
			<hr/>
		<div class="empty" id="upload">
			<div id="photos" style="width:100%"></div>
		<br/>
</div>
	<script src="upload.js"></script>
	<script src="webcam.js"></script>
</body>
</html>
