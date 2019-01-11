<?php
include "modify.php";

$email = $_GET['email'];

$to = $email;
$subject = "Password Change";
$c = $_GET['password'];
$message = "
Please click this link to change your password:
http://localhost:8080/Camagru/change/change_password.php?&password=$c";

$headers = 'From:noreply@camagru.com';
mail($to, $subject, $message, $headers);
echo "Please click on the link sent to your email to change your password.";
?>