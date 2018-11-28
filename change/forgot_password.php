<?php
include 'header.php';
include "../config/setup.php";

try{
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);


    if (isset($_POST['lost']))
        {
            if (isset($_POST['recovery_mail']))
            {
                $email = $_POST['recovery_mail'];
                $new = "AbvjkdbvkHG123";
                $encrypt = md5($new);
                $insert = $conn->prepare("UPDATE users SET password = '$encrypt' WHERE email = '$email'");

    		    $insert->bindParam(':password', $encrypt);
                $insert->execute();

                mail($email, "Password Request", "Your new password is $new");
             }
        }
}
catch(PDOException $e){
	echo "Error: ".$e->getMessage();
}
?>

<html>
    <link rel="stylesheet" href="../css/login.css">
    <body>
        <div class="loginbox">
            <h1>Request Password</h1><br>
            <p>Enter Your Email Address<p>
            <form method="POST">
              <input class="button" type="email" name="recovery_mail" placeholder="Enter your email" required/><br/><br/>
              <input class="button" type="submit" name="lost"/>
            </form>
        </div>
    </body>
</html>