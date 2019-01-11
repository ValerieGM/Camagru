<?php
include "register.php";

$email = $_GET['email'];

$to = $email;
$subject = "Account Verification";
$message = '
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
Please click this link to activate your account:
http://localhost:8080/Camagru/user/verify.php?email='.$email.'
';

$headers = 'From:noreply@camagru.com';
mail($to, $subject, $message, $headers);
echo "Please click on the link sent to your email to verify account.";
?>