<?php
include "header.php";
include "../config/setup.php";

try{
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);


    $email = $_GET['email'];

    if (isset($_POST['lost_password']))
        {
            
            if (isset($_POST['new_username']))
            {
                $name = $_POST['new_username'];
                $insert = $conn->prepare("UPDATE users SET username = '$name' WHERE username = '$user'");

    		    $insert->bindParam(':username', $name);

                $insert->execute();
            }
        }
}
catch(PDOException $e){
	echo "Error: ".$e->getMessage();
}

?>

<html>
    <link rel="stylesheet" href="../css/profile.css">
    <body>
        <div class="profilebox">
            <h1>Enter Your New Email Address<h1>
            <form action="" method="post">
              <input class="button" type="email" name="new_email" placeholder="Enter your email" required/><br/><br/>
              <input class="button" type="submit" name="lost_passsword" value="Request new email"/>
            </form>
        </div>
    </body>
</html>